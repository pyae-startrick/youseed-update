<?php

namespace App\Http\Controllers\Admin;

use App\AssignStudentToTeacher;
use App\Bitwise\UserLevelOfTraining;
use App\Exports\OrganizationsExport;
use App\Exports\StudentsExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Models\BecomeInstructor;
use App\Models\Category;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Region;
use App\Models\Role;
use App\Models\Sale;
use App\Models\UserBadge;
use App\Models\UserMeta;
use App\Models\UserOccupation;
use App\Models\UserRegistrationPackage;
use App\Models\Webinar;
use App\User;
use App\Users;
use App\Userss;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function staffs(Request $request)
    {
        $this->authorize('admin_staffs_list');

        $staffsRoles = Role::where('is_admin', true)->get();
        $staffsRoleIds = $staffsRoles->pluck('id')->toArray();


        $query = User::whereIn('role_id', $staffsRoleIds);
        $query = $this->filters($query, $request);

        $users = $query->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = [
            'pageTitle' => 'Admin List',
            'users' => $users,
            'staffsRoles' => $staffsRoles,
        ];

        return view('admin.users.staffs', $data);
    }

    // public function organizations(Request $request, $is_export_excel = false)
    // {
    //     $this->authorize('admin_organizations_list');

    //     $query = User::where('role_name', Role::$organization);

    //     $totalOrganizations = deepClone($query)->count();
    //     $verifiedOrganizations = deepClone($query)->where('verified', true)
    //         ->count();
    //     $totalOrganizationsTeachers = User::where('role_name', Role::$teacher)
    //         ->whereNotNull('organ_id')
    //         ->count();
    //     $totalOrganizationsStudents = User::where('role_name', Role::$user)
    //         ->whereNotNull('organ_id')
    //         ->count();
    //     $userGroups = Group::where('status', 'active')
    //         ->orderBy('created_at', 'desc')
    //         ->get();


    //     $query = $this->filters($query, $request);

    //     if ($is_export_excel) {
    //         $users = $query->orderBy('created_at', 'desc')->get();
    //     } else {
    //         $users = $query->orderBy('created_at', 'desc')
    //             ->paginate(10);
    //     }


    //     $users = $this->addUsersExtraInfo($users);

    //     if ($is_export_excel) {
    //         return $users;
    //     }

    //     $data = [
    //         'pageTitle' => trans('admin/main.organizations'),
    //         'users' => $users,
    //         'totalOrganizations' => $totalOrganizations,
    //         'verifiedOrganizations' => $verifiedOrganizations,
    //         'totalOrganizationsTeachers' => $totalOrganizationsTeachers,
    //         'totalOrganizationsStudents' => $totalOrganizationsStudents,
    //         'userGroups' => $userGroups,
    //     ];

    //     return view('admin.users.organizations', $data);
    // }

    public function students(Request $request, $is_export_excel = false)
    {
        $this->authorize('admin_users_list');

        $query = User::where('role_name', Role::$user);
        $datalists = User::where('role_name', Role::$user)->get();


        $totalStudents = deepClone($query)->count();
        $inactiveStudents = deepClone($query)->where('status', 'inactive')
            ->count();
        $pendingStudents = deepClone($query)->where('status', 'pending')->count();

        $totalOrganizationsStudents = User::where('role_name', Role::$user)
            ->count();
        $userGroups = Group::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        $organizations = User::select('id', 'full_name', 'created_at')
            ->where('role_name', Role::$organization)
            ->orderBy('created_at', 'desc')
            ->get();


        $query = $this->filters($query, $request);

        if ($is_export_excel) {
            $users = $query->orderBy('id', 'desc')->get();
        } else {
            $users = $query->orderBy('id', 'desc')
                ->paginate(20);
        }

        $users = $this->addUsersExtraInfo($users);

        if ($is_export_excel) {
            return $users;
        }

        $data = [
            'pageTitle' => 'Student List',
            'users' => $users,
            'datalists' => $datalists,
            'totalStudents' => $totalStudents,
            'inactiveStudents' => $inactiveStudents,
            'pendingStudents' => $pendingStudents,
            'totalOrganizationsStudents' => $totalOrganizationsStudents,
            'userGroups' => $userGroups,
            'organizations' => $organizations,
        ];

        return view('admin.users.students', $data);
    }

    public function assignedStudents(Request $request)
    {
        $this->authorize('admin_users_list');
        $query = AssignStudentToTeacher::query();

        $datalists = AssignStudentToTeacher::get();

        $query = $this->filtersAssignStudent($query, $request);

        $assignStudents = $query->orderBy('id', 'desc')
            ->paginate(20);
        // dd($assignStudents);
        $data = [
            'pageTitle' => 'Teacher\'s Student List',
            'assignStudents' => $assignStudents,
            'datalists' => $datalists,
        ];

        return view('admin.users.assigned_students', $data);
    }

    public function assignedStudentsDelete($id)
    {
        $this->authorize('admin_users_delete');

        $assignStudent = AssignStudentToTeacher::find($id);

        if ($assignStudent) {
            $assignStudent->delete();
        }

        return redirect()->back();
    }

    public function deleteMultipleAssignStudent(Request $request)
    {
        // $this->authorize('admin_webinars_delete');
        $students = $request->id;

        if(!empty($students)) {
            foreach ($students as $student) {
                AssignStudentToTeacher::where('id',$student)->delete();
            }
        }
        

        return redirect()->back();
    }

    private function filtersAssignStudent($query, $request)
    {
        $full_name = $request->get('full_name');

        if (!empty($full_name)) {
            $query->where('student_name', 'like', "%$full_name%");
        }

        return $query;
    }

    public function instructors(Request $request, $is_export_excel = false)
    {
        $this->authorize('admin_instructors_list');

        $query = User::where('role_name', Role::$teacher);
        $datalists = User::where('role_name', Role::$teacher)->get();

        $totalInstructors = deepClone($query)->count();
        $inactiveInstructors = deepClone($query)->where('status', 'inactive')
            ->count();
        $pendingInstructors = deepClone($query)->where('status', 'pending')
            ->count();

        $totalOrganizationsInstructors = User::where('role_name', Role::$teacher)
            ->count();
        $userGroups = Group::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->get();

        $organizations = User::select('id', 'full_name', 'created_at')
            ->where('role_name', Role::$organization)
            ->orderBy('created_at', 'desc')
            ->get();


        $query = $this->filters($query, $request);

        if ($is_export_excel) {
            $users = $query->orderBy('created_at', 'desc')->get();
        } else {
            $users = $query->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        $users = $this->addUsersExtraInfo($users);

        if ($is_export_excel) {
            return $users;
        }

        $data = [
            'pageTitle' => 'Teacher List',
            'users' => $users,
            'datalists' => $datalists,
            'totalInstructors' => $totalInstructors,
            'inactiveInstructors' => $inactiveInstructors,
            'pendingInstructors' => $pendingInstructors,
            'totalOrganizationsInstructors' => $totalOrganizationsInstructors,
            'userGroups' => $userGroups,
            'organizations' => $organizations,
        ];

        return view('admin.users.instructors', $data);
    }

    private function addUsersExtraInfo($users)
    {
        foreach ($users as $user) {
            $salesQuery = Sale::where('seller_id', $user->id)
                ->whereNull('refund_at');

            $classesSaleQuery = deepClone($salesQuery)->whereNotNull('webinar_id')
                ->whereNull('meeting_id')
                ->whereNull('promotion_id')
                ->whereNull('subscribe_id');

            $user->classesSalesCount = $classesSaleQuery->count();
            $user->classesSalesSum = $classesSaleQuery->sum('total_amount');

            $meetingsSaleQuery = deepClone($salesQuery)->whereNotNull('meeting_id')
                ->whereNull('webinar_id')
                ->whereNull('promotion_id')
                ->whereNull('subscribe_id');

            $user->meetingsSalesCount = $meetingsSaleQuery->count();
            $user->meetingsSalesSum = $meetingsSaleQuery->sum('total_amount');


            $purchasedQuery = Sale::where('buyer_id', $user->id)
                ->whereNull('refund_at');

            $classesPurchasedQuery = deepClone($purchasedQuery)->whereNotNull('webinar_id')
                ->whereNull('meeting_id')
                ->whereNull('promotion_id')
                ->whereNull('subscribe_id');

            $user->classesPurchasedsCount = $classesPurchasedQuery->count();
            $user->classesPurchasedsSum = $classesPurchasedQuery->sum('total_amount');

            $meetingsPurchasedQuery = deepClone($purchasedQuery)->whereNotNull('meeting_id')
                ->whereNull('webinar_id')
                ->whereNull('promotion_id')
                ->whereNull('subscribe_id');

            $user->meetingsPurchasedsCount = $meetingsPurchasedQuery->count();
            $user->meetingsPurchasedsSum = $meetingsPurchasedQuery->sum('total_amount');
        }

        return $users;
    }

    private function filters($query, $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $full_name = $request->get('full_name');
        $sort = $request->get('sort');
        // $group_id = $request->get('group_id');
        $status = $request->get('status');
        $role_id = $request->get('role_id');
        $organization_id = $request->get('organization_id');

        $query = fromAndToDateFilter($from, $to, $query, 'created_at');

        if (!empty($full_name)) {
            $query->where('full_name', 'like', "%$full_name%");
        }

        if (!empty($sort)) {
            switch ($sort) {
                case 'sales_classes_asc':
                    $query->join('sales', 'users.id', '=', 'sales.seller_id')
                        ->select('users.*', 'sales.seller_id', 'sales.webinar_id', 'sales.refund_at', DB::raw('count(sales.seller_id) as sales_count'))
                        ->whereNotNull('sales.webinar_id')
                        ->whereNull('sales.refund_at')
                        ->groupBy('sales.seller_id')
                        ->orderBy('sales_count', 'asc');
                    break;
                case 'sales_classes_desc':
                    $query->join('sales', 'users.id', '=', 'sales.seller_id')
                        ->select('users.*', 'sales.seller_id', 'sales.webinar_id', 'sales.refund_at', DB::raw('count(sales.seller_id) as sales_count'))
                        ->whereNotNull('sales.webinar_id')
                        ->whereNull('sales.refund_at')
                        ->groupBy('sales.seller_id')
                        ->orderBy('sales_count', 'desc');
                    break;
                case 'purchased_classes_asc':
                    $query->join('sales', 'users.id', '=', 'sales.buyer_id')
                        ->select('users.*', 'sales.buyer_id', 'sales.refund_at', DB::raw('count(sales.buyer_id) as purchased_count'))
                        ->whereNull('sales.refund_at')
                        ->groupBy('sales.buyer_id')
                        ->orderBy('purchased_count', 'asc');
                    break;
                case 'purchased_classes_desc':
                    $query->join('sales', 'users.id', '=', 'sales.buyer_id')
                        ->select('users.*', 'sales.buyer_id', 'sales.refund_at', DB::raw('count(sales.buyer_id) as purchased_count'))
                        ->groupBy('sales.buyer_id')
                        ->whereNull('sales.refund_at')
                        ->orderBy('purchased_count', 'desc');
                    break;
                case 'purchased_classes_amount_asc':
                    $query->join('sales', 'users.id', '=', 'sales.buyer_id')
                        ->select('users.*', 'sales.buyer_id', 'sales.amount', 'sales.refund_at', DB::raw('sum(sales.amount) as purchased_amount'))
                        ->groupBy('sales.buyer_id')
                        ->whereNull('sales.refund_at')
                        ->orderBy('purchased_amount', 'asc');
                    break;
                case 'purchased_classes_amount_desc':
                    $query->join('sales', 'users.id', '=', 'sales.buyer_id')
                        ->select('users.*', 'sales.buyer_id', 'sales.amount', 'sales.refund_at', DB::raw('sum(sales.amount) as purchased_amount'))
                        ->groupBy('sales.buyer_id')
                        ->whereNull('sales.refund_at')
                        ->orderBy('purchased_amount', 'desc');
                    break;
                case 'sales_appointments_asc':
                    $query->join('sales', 'users.id', '=', 'sales.seller_id')
                        ->select('users.*', 'sales.seller_id', 'sales.meeting_id', 'sales.refund_at', DB::raw('count(sales.seller_id) as sales_count'))
                        ->whereNotNull('sales.meeting_id')
                        ->whereNull('sales.refund_at')
                        ->groupBy('sales.seller_id')
                        ->orderBy('sales_count', 'asc');
                    break;
                case 'sales_appointments_desc':
                    $query->join('sales', 'users.id', '=', 'sales.seller_id')
                        ->select('users.*', 'sales.seller_id', 'sales.meeting_id', 'sales.refund_at', DB::raw('count(sales.seller_id) as sales_count'))
                        ->whereNotNull('sales.meeting_id')
                        ->whereNull('sales.refund_at')
                        ->groupBy('sales.seller_id')
                        ->orderBy('sales_count', 'desc');
                    break;
                    break;
                case 'purchased_appointments_asc':
                    $query->join('sales', 'users.id', '=', 'sales.buyer_id')
                        ->select('users.*', 'sales.buyer_id', 'sales.meeting_id', 'sales.refund_at', DB::raw('count(sales.buyer_id) as purchased_count'))
                        ->whereNotNull('sales.meeting_id')
                        ->whereNull('sales.refund_at')
                        ->groupBy('sales.buyer_id')
                        ->orderBy('purchased_count', 'asc');
                    break;
                case 'purchased_appointments_desc':
                    $query->join('sales', 'users.id', '=', 'sales.buyer_id')
                        ->select('users.*', 'sales.buyer_id', 'sales.meeting_id', 'sales.refund_at', DB::raw('count(sales.buyer_id) as purchased_count'))
                        ->whereNotNull('sales.meeting_id')
                        ->whereNull('sales.refund_at')
                        ->groupBy('sales.buyer_id')
                        ->orderBy('purchased_count', 'desc');
                    break;
                case 'purchased_appointments_amount_asc':
                    $query->join('sales', 'users.id', '=', 'sales.buyer_id')
                        ->select('users.*', 'sales.buyer_id', 'sales.amount', 'sales.meeting_id', 'sales.refund_at', DB::raw('sum(sales.amount) as purchased_amount'))
                        ->whereNotNull('sales.meeting_id')
                        ->whereNull('sales.refund_at')
                        ->groupBy('sales.buyer_id')
                        ->orderBy('purchased_amount', 'asc');
                    break;
                case 'purchased_appointments_amount_desc':
                    $query->join('sales', 'users.id', '=', 'sales.buyer_id')
                        ->select('users.*', 'sales.buyer_id', 'sales.amount', 'sales.meeting_id', 'sales.refund_at', DB::raw('sum(sales.amount) as purchased_amount'))
                        ->whereNotNull('sales.meeting_id')
                        ->whereNull('sales.refund_at')
                        ->groupBy('sales.buyer_id')
                        ->orderBy('purchased_amount', 'desc');
                    break;
                case 'register_asc':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'register_desc':
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }

        if (!empty($group_id)) {
            $userIds = GroupUser::where('group_id', $group_id)->pluck('user_id')->toArray();

            $query->whereIn('id', $userIds);
        }

        if (!empty($status)) {
            switch ($status) {
                case 'active_verified':
                    $query->where('status', 'active')
                        ->where('verified', true);
                    break;
                case 'active_notVerified':
                    $query->where('status', 'active')
                        ->where('verified', false);
                    break;
                case 'inactive':
                    $query->where('status', 'inactive');
                    break;
                case 'ban':
                    $query->where('ban', true)
                        ->whereNotNull('ban_end_at')
                        ->where('ban_end_at', '>', time());
                    break;
            }
        }

        if (!empty($role_id)) {
            $query->where('role_id', $role_id);
        }

        // if (!empty($organization_id)) {
        //     $query->where('organ_id', $organization_id);
        // }

        //dd($query->get());
        return $query;
    }

    public function create()
    {
        $this->authorize('admin_users_create');

        $roles = Role::orderBy('created_at', 'desc')->get();
        $userGroups = Group::orderBy('created_at', 'desc')->where('status', 'active')->get();

        $data = [
            'pageTitle' => 'Create User',
            'roles' => $roles,
            'userGroups' => $userGroups,
        ];


        return view('admin.users.create', $data);
    }

    private function username($data)
    {
        $email_regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";

        $username = 'mobile';
        if (preg_match($email_regex, request('username', null))) {
            $username = 'email';
        }

        return $username;
    }

    public function store(Request $request)
    {
        $this->authorize('admin_users_create');
        $data = $request->all();

        // $username = $this->username($data);
        // $data[$username] = $data['username'];
        // $request->merge([$username => $data['username']]);
        // unset($data['username']);

        $this->validate($request, [
            // 'email' => 'required|string|email|max:255|unique:users',
            'email' => 'required|string|email|max:255',
            'full_name' => 'required|min:3|max:128',
            'role_id' => 'required|exists:roles,id',
            'password' => 'required|string|min:6',
            // 'status' => 'required',
        ]);

        if (!empty($data['role_id'])) {
            $role = Role::find($data['role_id']);

            if (!empty($role)) {
                $referralSettings = getReferralSettings();
                $usersAffiliateStatus = (!empty($referralSettings) and !empty($referralSettings['users_affiliate_status']));
                // dd($role->name);


                if ($role->name == 'admin' || $role->name == 'teacher') {
                    $studentID = null;

                    $user = User::where('email', $data['email'])->first();

                    if ($user) {
                        $toastData = [
                            'title' => 'Error',
                            'msg' => 'Teacher email already exist!',
                            'status' => 'error'
                        ];
                        return back()->with(['toast' => $toastData]);
                    }
                } else {
                    $studentID = mt_rand(1000, 9999);
                }
                
                $user = User::create([
                    'full_name' => $data['full_name'],
                    'role_name' => $role->name,
                    'role_id' => $data['role_id'],
                    'email' => $data['email'],
                    'student_id' => $studentID,
                    'password' => User::generatePassword($data['password']),
                    'status' => 'active',
                    'affiliate' => $usersAffiliateStatus,
                    'verified' => true,
                    'created_at' => time(),
                ]);

                Log::info('User created with name' .' '. $user->full_name);

                if (!empty($data['group_id'])) {
                    $group = Group::find($data['group_id']);

                    if (!empty($group)) {
                        GroupUser::create([
                            'group_id' => $group->id,
                            'user_id' => $user->id,
                            'created_at' => time(),
                        ]);
                    }
                }

                return redirect('/admin/users/' . $user->id . '/edit');
            }
        }

        $toastData = [
            'title' => '',
            'msg' => 'Role not find!',
            'status' => 'error'
        ];
        return back()->with(['toast' => $toastData]);
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('admin_users_edit');

        $user = User::where('id', $id)
            ->with([
                'customBadges' => function ($query) {
                    $query->with('badge');
                },
                'occupations' => function ($query) {
                    $query->with('category');
                },
                'organization' => function ($query) {
                    $query->select('id', 'full_name');
                },
                'userRegistrationPackage'
            ])
            ->first();

        if (empty($user)) {
            abort(404);
        }

        if (!empty($user->location)) {
            $user->location = \Geo::getST_AsTextFromBinary($user->location);

            $user->location = \Geo::get_geo_array($user->location);
        }

        $userMetas = $user->userMetas;

        if (!empty($userMetas)) {
            foreach ($userMetas as $meta) {
                $user->{$meta->name} = $meta->value;
            }
        }

        $becomeInstructor = null;
        if (!empty($request->get('type')) and $request->get('type') == 'check_instructor_request') {
            $becomeInstructor = BecomeInstructor::where('user_id', $user->id)
                ->first();
        }

        $categories = Category::where('parent_id', null)
            ->with('subCategories')
            ->get();

        $occupations = $user->occupations->pluck('category_id')->toArray();

        $userBadges = $user->getBadges(false);

        $roles = Role::all();
        $badges = Badge::all();

        $userLanguages = getGeneralSettings('user_languages');
        if (!empty($userLanguages) and is_array($userLanguages)) {
            $userLanguages = getLanguages($userLanguages);
        } else {
            $userLanguages = [];
        }


        $provinces = null;
        $cities = null;
        $districts = null;

        $countries = Region::select(DB::raw('*, ST_AsText(geo_center) as geo_center'))
            ->where('type', Region::$country)
            ->get();

        if (!empty($user->country_id)) {
            $provinces = Region::select(DB::raw('*, ST_AsText(geo_center) as geo_center'))
                ->where('type', Region::$province)
                ->where('country_id', $user->country_id)
                ->get();
        }

        if (!empty($user->province_id)) {
            $cities = Region::select(DB::raw('*, ST_AsText(geo_center) as geo_center'))
                ->where('type', Region::$city)
                ->where('province_id', $user->province_id)
                ->get();
        }

        if (!empty($user->city_id)) {
            $districts = Region::select(DB::raw('*, ST_AsText(geo_center) as geo_center'))
                ->where('type', Region::$district)
                ->where('city_id', $user->city_id)
                ->get();
        }
        $students = User::where('role_name', Role::$user)->get();
        $sales = Sale::where('seller_id', $id)->get();

        $assignStudents = AssignStudentToTeacher::where('teacher_id', $id)->get();
        // ddd($assignStudents);
        $title = '';
        if ($user->isAdmin()) {
            $title = 'Edit Admin';
        } else if ($user->isTeacher()) {
            $title = 'Edit Teacher';
        } else {
            $title = 'Edit Student';
        }

        $data = [
            'pageTitle' => $title,
            'user' => $user,
            'userBadges' => $userBadges,
            'roles' => $roles,
            'badges' => $badges,
            'categories' => $categories,
            'occupations' => $occupations,
            'becomeInstructor' => $becomeInstructor,
            'userLanguages' => $userLanguages,
            'userRegistrationPackage' => $user->userRegistrationPackage,
            'countries' => $countries,
            'provinces' => $provinces,
            'cities' => $cities,
            'districts' => $districts,
            'students' => $students,
            'sales' => $sales,
            'assignStudents' => $assignStudents,
        ];
        return view('admin.users.edit', $data);
    }


    public function update(Request $request, $id)
    {


        try {

            $this->authorize('admin_users_edit');

            $user = User::findOrFail($id);
            $role = Role::where('id', $request['role_id'])->first();

            $this->validate($request, [
                'full_name' => 'required|min:3|max:128',
                'role_id' => 'required|exists:roles,id',
                'email' => (!empty($user->email) && $role->name == 'admin' || $role->name == 'teacher') ? 'required|email|unique:users,email,' . $user->id . ',id,deleted_at,NULL' : 'nullable|email',
                // 'email' => (!empty($user->email)) ? 'required|email' : 'nullable|email',
                // 'student_id' => (!empty($user->student_id)) ? 'required|numeric|unique:users,student_id,' . $user->id . ',id,deleted_at,NULL' : 'nullable|numeric|unique:users',
                // 'mobile' => (!empty($user->mobile)) ? 'required|numeric|unique:users,mobile,' . $user->id . ',id,deleted_at,NULL' : 'nullable|numeric|unique:users',
                // 'password' => 'nullable|string',
                // 'bio' => 'nullable|string|min:3|max:48',
                // 'about' => 'nullable|string|min:3',
                // 'status' => 'required|' . Rule::in(User::$statuses),
            ]);

            $data = $request->all();

            if (empty($role)) {
                $toastData = [
                    'title' => trans('public.request_failed'),
                    'msg' => 'Selected role not exist',
                    'status' => 'error'
                ];
                return back()->with(['toast' => $toastData]);
            }

            if ($user->role_id != $role->id and $role->name == Role::$teacher) {
                $becomeInstructor = BecomeInstructor::where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->first();

                if (!empty($becomeInstructor)) {
                    $becomeInstructor->update([
                        'status' => 'accept'
                    ]);
                }
            }

            // if($role->name == 'admin' || $role->name == 'teacher') {

            //     $user = User::where('email', $data['email'])->get();

            //    if($user) {
            //         $toastData = [
            //             'title' => 'Error',
            //             'msg' => 'Teacher email already exist!',
            //             'status' => 'error'
            //         ];
            //         return back()->with(['toast' => $toastData]);
            //    }
            // }

            $user->full_name = !empty($data['full_name']) ? $data['full_name'] : null;
            $user->role_name = $role->name;
            $user->role_id = $role->id;
            $user->timezone = $data['timezone'] ?? null;
            // $user->organ_id = !empty($data['organ_id']) ? $data['organ_id'] : null;
            $user->email = !empty($data['email']) ? $data['email'] : null;
            $user->student_id = !empty($data['student_id']) ? $data['student_id'] : null;
            $user->mobile = !empty($data['mobile']) ? $data['mobile'] : null;
            $user->bio = !empty($data['bio']) ? $data['bio'] : null;
            $user->about = !empty($data['about']) ? $data['about'] : null;
            $user->status = !empty($data['status']) ? $data['status'] : null;
            // $user->language = !empty($data['language']) ? $data['language'] : null;
            $user->age = !empty($data['age']) ? $data['age'] : null;
            $user->parent_name = !empty($data['parent_name']) ? $data['parent_name'] : null;


            if (!empty($data['password'])) {
                $user->password = User::generatePassword($data['password']);
            }

            // if (!empty($data['ban']) and $data['ban'] == '1') {
            //     $ban_start_at = strtotime($data['ban_start_at']);
            //     $ban_end_at = strtotime($data['ban_end_at']);

            //     $user->ban = true;
            //     $user->ban_start_at = $ban_start_at;
            //     $user->ban_end_at = $ban_end_at;
            // } else {
            //     $user->ban = false;
            //     $user->ban_start_at = null;
            //     $user->ban_end_at = null;
            // }

            $user->verified = (!empty($data['verified']) and $data['verified'] == '1');

            // $user->affiliate = (!empty($data['affiliate']) and $data['affiliate'] == '1');


            if (!empty($data['student'])) {
                $students = $data['student'];

                // dd($students);
                AssignStudentToTeacher::where('teacher_id',$user->id)->whereNotIn('student_id', $students)->delete();

                if ($user->role_name == 'teacher') {
                    foreach ($students as $student) {
                        // User::where('id', $student)->update(['teacher_id' => $user->id]);
                        $studentsName = User::where('id', $student)->get();


                        foreach ($studentsName as $studentName) {
                            AssignStudentToTeacher::updateOrCreate([
                                'student_id' => $student,
                                'teacher_id' => $user->id
                            ], [
                                'student_id' => $student,
                                'teacher_id' => $user->id,
                                'teacher_name' => $user->full_name,
                                'student_name' => $studentName->full_name,
                            ]);
                        }
                    }
                }
            }


            $user->save();

            Log::info('User updated with name' .' '. $user->full_name);

            $sweetAlertData = [
                'msg' => 'User successfully updated',
                'status' => 'success'
            ];
            return redirect()->back()->with(['sweetalert' => $sweetAlertData]);
        } catch (\Throwable $th) {
            // dd($th);
            $sweetAlertData = [
                'msg' => 'Somethings went wrong!',
                'status' => 'error'
            ];
            return redirect()->back()->with(['sweetalert' => $sweetAlertData]);
        }
    }

    public function updateImage(Request $request, $id)
    {
        $this->authorize('admin_users_edit');

        $user = User::findOrFail($id);

        $user->avatar = $request->get('avatar', null);

        if (!empty($request->get('cover_img', null))) {
            $user->cover_img = $request->get('cover_img', null);
        }

        $user->save();

        $sweetAlertData = [
            'msg' => 'Profile Image successfully updated',
            'status' => 'success'
        ];

        return redirect()->back()->with(['sweetalert' => $sweetAlertData]);
    }

    public function financialUpdate(Request $request, $id)
    {
        $this->authorize('admin_users_edit');

        $user = User::findOrFail($id);
        $data = $request->all();

        $user->update([
            'account_type' => $data['account_type'],
            'iban' => $data['iban'],
            'account_id' => $data['account_id'],
            'identity_scan' => $data['identity_scan'],
            'address' => $data['address'],
            'commission' => $data['commission'] ?? null,
            'financial_approval' => (!empty($data['financial_approval']) and $data['financial_approval'] == 'on')
        ]);

        return redirect()->back();
    }

    public function occupationsUpdate(Request $request, $id)
    {
        $this->authorize('admin_users_edit');

        $user = User::findOrFail($id);
        $data = $request->all();

        UserOccupation::where('user_id', $user->id)->delete();
        if (!empty($data['occupations'])) {

            foreach ($data['occupations'] as $category_id) {
                UserOccupation::create([
                    'user_id' => $user->id,
                    'category_id' => $category_id
                ]);
            }
        }

        return redirect()->back();
    }

    public function badgesUpdate(Request $request, $id)
    {
        $this->authorize('admin_users_edit');

        $this->validate($request, [
            'badge_id' => 'required'
        ]);

        $data = $request->all();
        $user = User::findOrFail($id);
        $badge = Badge::findOrFail($data['badge_id']);

        UserBadge::create([
            'user_id' => $user->id,
            'badge_id' => $badge->id,
            'created_at' => time()
        ]);

        sendNotification('new_badge', ['[u.b.title]' => $badge->title], $user->id);

        return redirect()->back();
    }

    public function deleteBadge(Request $request, $id, $badge_id)
    {
        $this->authorize('admin_users_edit');

        $user = User::findOrFail($id);

        $badge = UserBadge::where('id', $badge_id)
            ->where('user_id', $user->id)
            ->first();

        if (!empty($badge)) {
            $badge->delete();
        }

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('admin_users_delete');

        $user = User::find($id);

        if ($user) {
            $user->delete();
            Log::info('User deleted with name' .' '. $user->full_name);
        }

        return redirect()->back();
    }

    public function acceptRequestToInstructor($id)
    {
        $this->authorize('admin_users_edit');

        $user = User::findOrFail($id);

        $becomeInstructors = BecomeInstructor::where('user_id', $user->id)->first();

        if (!empty($becomeInstructors)) {
            $role = Role::where('name', $becomeInstructors->role)->first();

            if (!empty($role)) {
                $user->update([
                    'role_id' => $role->id,
                    'role_name' => $role->name,
                ]);

                $becomeInstructors->update([
                    'status' => 'accept'
                ]);
            }

            return redirect('/admin/users/' . $user->id . '/edit')->with(['msg' => trans('admin/pages/users.user_role_updated')]);
        }

        abort(404);
    }

    public function search(Request $request)
    {
        $term = $request->get('term');
        $option = $request->get('option');

        $users = User::select('id', 'full_name as name')
            //->where('role_name', Role::$user)
            ->where(function ($query) use ($term) {
                $query->where('full_name', 'like', '%' . $term . '%');
            });

        if ($option === "for_user_group") {
            $users->whereNotIn('id', GroupUser::all()->pluck('user_id'));
        }

        if ($option === "just_teacher_role") {
            $users->where('role_name', Role::$teacher);
        }

        if ($option === "just_student_role") {
            $users->where('role_name', Role::$user);
        }

        if ($option === "just_organization_role") {
            $users->where('role_name', Role::$organization);
        }

        if ($option === "consultants") {
            $users->whereHas('meeting', function ($query) {
                $query->where('disabled', false)
                    ->whereHas('meetingTimes');
            });
        }

        return response()->json($users->get(), 200);
    }

    public function impersonate($user_id)
    {
        $this->authorize('admin_users_impersonate');

        $user = User::findOrFail($user_id);

        if ($user->isAdmin()) {
            return redirect('/admin');
        }

        session()->put(['impersonated' => $user->id]);

        return redirect('/panel');
    }

    public function exportExcelOrganizations(Request $request)
    {
        $this->authorize('admin_users_export_excel');

        $users = $this->organizations($request, true);

        $usersExport = new OrganizationsExport($users);

        return Excel::download($usersExport, 'organizations.xlsx');
    }

    public function exportExcelInstructors(Request $request)
    {
        $this->authorize('admin_users_export_excel');

        $users = $this->instructors($request, true);

        $usersExport = new OrganizationsExport($users);

        return Excel::download($usersExport, 'instructors.xlsx');
    }

    public function exportExcelStudents(Request $request)
    {
        $this->authorize('admin_users_export_excel');

        $users = $this->students($request, true);

        $usersExport = new StudentsExport($users);

        return Excel::download($usersExport, 'students.xlsx');
    }

    public function userRegistrationPackage(Request $request, $id)
    {
        $this->authorize('admin_update_user_registration_package');

        $this->validate($request, [
            'instructors_count' => 'nullable|numeric',
            'students_count' => 'nullable|numeric',
            'courses_capacity' => 'nullable|numeric',
            'courses_count' => 'nullable|numeric',
            'meeting_count' => 'nullable|numeric',
        ]);

        $user = User::findOrFail($id);

        if ($user->isOrganization() or $user->isTeacher()) {
            $data = $request->all();

            UserRegistrationPackage::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'instructors_count' => $data['instructors_count'] ?? null,
                'students_count' => $data['students_count'] ?? null,
                'courses_capacity' => $data['courses_capacity'] ?? null,
                'courses_count' => $data['courses_count'] ?? null,
                'meeting_count' => $data['meeting_count'] ?? null,
                'status' => $data['status'],
                'created_at' => time(),
            ]);

            return redirect()->back();
        }

        abort(404);
    }

    public function meetingSettings(Request $request, $id)
    {
        $this->authorize('admin_update_user_meeting_settings');

        $user = User::findOrFail($id);

        if ($user->isOrganization() or $user->isTeacher()) {
            $data = $request->all();

            $user->update([
                "level_of_training" => !empty($data['level_of_training']) ? (new UserLevelOfTraining())->getValue($data['level_of_training']) : null,
                "meeting_type" => $data['meeting_type'] ?? null,
                "group_meeting" => (!empty($data['group_meeting']) and $data['group_meeting'] == 'on'),
                "country_id" => $data['country_id'] ?? null,
                "province_id" => $data['province_id'] ?? null,
                "city_id" => $data['city_id'] ?? null,
                "district_id" => $data['district_id'] ?? null,
                "location" => (!empty($data['latitude']) and !empty($data['longitude'])) ? DB::raw("POINT(" . $data['latitude'] . "," . $data['longitude'] . ")") : null,
            ]);

            $updateUserMeta = [
                "gender" => $data['gender'] ?? null,
                "age" => $data['age'] ?? null,
                "address" => $data['address'] ?? null,
            ];

            foreach ($updateUserMeta as $name => $value) {
                $checkMeta = UserMeta::where('user_id', $user->id)
                    ->where('name', $name)
                    ->first();

                if (!empty($checkMeta)) {
                    if (!empty($value)) {
                        $checkMeta->update([
                            'value' => $value
                        ]);
                    } else {
                        $checkMeta->delete();
                    }
                } else if (!empty($value)) {
                    UserMeta::create([
                        'user_id' => $user->id,
                        'name' => $name,
                        'value' => $value
                    ]);
                }
            }

            return redirect()->back();
        }

        abort(404);
    }
}
