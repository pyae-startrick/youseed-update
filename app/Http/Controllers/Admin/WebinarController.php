<?php

namespace App\Http\Controllers\Admin;

use App\Exports\WebinarsExport;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\File;
use App\Models\Filter;
use App\Models\Quiz;
use App\Models\Reward;
use App\Models\RewardAccounting;
use App\Models\Role;
use App\Models\SpecialOffer;
use App\Models\Tag;
use App\Models\Ticket;
use App\Models\Translation\WebinarTranslation;
use App\Models\WebinarFilterOption;
use App\Models\WebinarPartnerTeacher;
use App\User;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Sale;
use App\Models\Session;
use App\Models\Translation\SessionTranslation;
use App\Models\Translation\WebinarChapterTranslation;
use App\Models\WebinarChapter;
use App\WebinarsQuiz;
use DateTime;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Str;
class WebinarController extends Controller
{

    public function index(Request $request)
    {
        $this->authorize('admin_webinars_list');

        removeContentLocale();

        $type = $request->get('type', 'webinar');
        $query = Webinar::where('webinars.type', $type);

        $totalWebinars = $query->count();
        $totalPendingWebinars = deepClone($query)->where('webinars.status', 'pending')->count();
        $totalDurations = deepClone($query)->sum('duration');
        $totalSales = deepClone($query)->join('sales', 'webinars.id', '=', 'sales.webinar_id')
            ->select(DB::raw('count(sales.webinar_id) as sales_count'))
            ->whereNotNull('sales.webinar_id')
            ->whereNull('sales.refund_at')
            ->first();

        $categories = Category::where('parent_id', null)
            ->with('subCategories')
            ->with('filters')
            ->get();

        $inProgressWebinars = 0;
        if ($type == 'webinar') {
            $inProgressWebinars = $this->getInProgressWebinarsCount();
        }

        $query = $this->filterWebinar($query, $request)
            ->with([
                'category' => function ($query) {
                    $query->with(['filters' => function ($query) {
                        $query->with('options');
                    }]);
                },
                'getCategoryOptions' => function ($q) {
                    $q->with('options');
                },
                'filterOptions',
                'teacher' => function ($qu) {
                    $qu->select('id', 'full_name');
                },
                'sales' => function ($query) {
                    $query->whereNull('refund_at');
                },
            ]);

        $webinars = $query->paginate(10);

        if ($request->get('status', null) == 'active_finished') {
            foreach ($webinars as $key => $webinar) {
                if ($webinar->last_date > time()) { // is in progress
                    unset($webinars[$key]);
                }
            }
        }

        $level = Filter::where('category_id', $categories[0]->id)->with('options')->get();
        // dd($level);

        $data = [
            'pageTitle' => 'Online Class List',
            'webinars' => $webinars,
            'totalWebinars' => $totalWebinars,
            'totalPendingWebinars' => $totalPendingWebinars,
            'totalDurations' => $totalDurations,
            'totalSales' => !empty($totalSales) ? $totalSales->sales_count : 0,
            'categories' => $categories,
            'inProgressWebinars' => $inProgressWebinars,
            'classesType' => $type,
        ];

        $teacher_ids = $request->get('teacher_ids', null);
        if (!empty($teacher_ids)) {
            $data['teachers'] = User::select('id', 'full_name')->whereIn('id', $teacher_ids)->get();
        }

        return view('admin.webinars.lists', $data);
    }

    private function filterWebinar($query, $request)
    {
        $from = $request->get('from', null);
        $to = $request->get('to', null);
        $title = $request->get('title', null);
        $class_id = $request->get('class_id', null);
        $teacher_ids = $request->get('teacher_ids', null);
        $category_id = $request->get('category_id', null);
        $status = $request->get('status', null);
        $sort = $request->get('sort', null);

        $query = fromAndToDateFilter($from, $to, $query, 'created_at');

        if (!empty($title)) {
            $query->whereTranslationLike('title', '%' . $title . '%');
        }

        if (!empty($class_id)) {
            $query->where('id', $class_id);
        }

        if (!empty($teacher_ids) and count($teacher_ids)) {
            $query->whereIn('teacher_id', $teacher_ids);
        }

        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }

        if (!empty($status)) {
            $time = time();

            switch ($status) {
                case 'active_not_conducted':
                    $query->where('webinars.status', 'active')
                        ->where('start_date', '>', $time);
                    break;
                case 'active_in_progress':
                    $query->where('webinars.status', 'active')
                        ->where('start_date', '<=', $time)
                        ->join('sessions', 'webinars.id', '=', 'sessions.webinar_id')
                        ->select('webinars.*', 'sessions.date', DB::raw('max(`date`) as last_date'))
                        ->groupBy('sessions.webinar_id')
                        ->where('sessions.date', '>', $time);
                    break;
                case 'active_finished':
                    $query->where('webinars.status', 'active')
                        ->where('start_date', '<=', $time)
                        ->join('sessions', 'webinars.id', '=', 'sessions.webinar_id')
                        ->select('webinars.*', 'sessions.date', DB::raw('max(`date`) as last_date'))
                        ->groupBy('sessions.webinar_id');
                    break;
                default:
                    $query->where('webinars.status', $status);
                    break;
            }
        }

        if (!empty($sort)) {
            switch ($sort) {
                case 'has_discount':
                    $now = time();
                    $webinarIdsHasDiscount = [];

                    $tickets = Ticket::where('start_date', '<', $now)
                        ->where('end_date', '>', $now)
                        ->get();

                    foreach ($tickets as $ticket) {
                        if ($ticket->isValid()) {
                            $webinarIdsHasDiscount[] = $ticket->webinar_id;
                        }
                    }

                    $specialOffersWebinarIds = SpecialOffer::where('status', 'active')
                        ->where('from_date', '<', $now)
                        ->where('to_date', '>', $now)
                        ->pluck('webinar_id')
                        ->toArray();

                    $webinarIdsHasDiscount = array_merge($specialOffersWebinarIds, $webinarIdsHasDiscount);

                    $query->whereIn('id', $webinarIdsHasDiscount)
                        ->orderBy('created_at', 'desc');
                    break;
                case 'sales_asc':
                    $query->join('sales', 'webinars.id', '=', 'sales.webinar_id')
                        ->select('webinars.*', 'sales.webinar_id', 'sales.refund_at', DB::raw('count(sales.webinar_id) as sales_count'))
                        ->whereNotNull('sales.webinar_id')
                        ->whereNull('sales.refund_at')
                        ->groupBy('sales.webinar_id')
                        ->orderBy('sales_count', 'asc');
                    break;
                case 'sales_desc':
                    $query->join('sales', 'webinars.id', '=', 'sales.webinar_id')
                        ->select('webinars.*', 'sales.webinar_id', 'sales.refund_at', DB::raw('count(sales.webinar_id) as sales_count'))
                        ->whereNotNull('sales.webinar_id')
                        ->whereNull('sales.refund_at')
                        ->groupBy('sales.webinar_id')
                        ->orderBy('sales_count', 'desc');
                    break;

                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;

                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;

                case 'income_asc':
                    $query->join('sales', 'webinars.id', '=', 'sales.webinar_id')
                        ->select('webinars.*', 'sales.webinar_id', 'sales.total_amount', 'sales.refund_at', DB::raw('(sum(sales.total_amount) - (sum(sales.tax) + sum(sales.commission))) as amounts'))
                        ->whereNotNull('sales.webinar_id')
                        ->whereNull('sales.refund_at')
                        ->groupBy('sales.webinar_id')
                        ->orderBy('amounts', 'asc');
                    break;

                case 'income_desc':
                    $query->join('sales', 'webinars.id', '=', 'sales.webinar_id')
                        ->select('webinars.*', 'sales.webinar_id', 'sales.total_amount', 'sales.refund_at', DB::raw('(sum(sales.total_amount) - (sum(sales.tax) + sum(sales.commission))) as amounts'))
                        ->whereNotNull('sales.webinar_id')
                        ->whereNull('sales.refund_at')
                        ->groupBy('sales.webinar_id')
                        ->orderBy('amounts', 'desc');
                    break;

                case 'created_at_asc':
                    $query->orderBy('created_at', 'asc');
                    break;

                case 'created_at_desc':
                    $query->orderBy('created_at', 'desc');
                    break;

                case 'updated_at_asc':
                    $query->orderBy('updated_at', 'asc');
                    break;

                case 'updated_at_desc':
                    $query->orderBy('updated_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }


        return $query;
    }

    private function getInProgressWebinarsCount()
    {
        $count = 0;
        $webinars = Webinar::where('type', 'webinar')
            ->where('status', 'active')
            ->where('start_date', '<=', time())
            ->whereHas('sessions')
            ->get();

        foreach ($webinars as $webinar) {
            if ($webinar->isProgressing()) {
                $count += 1;
            }
        }

        return $count;
    }

    public function create()
    {
        $this->authorize('admin_webinars_create');

        removeContentLocale();

        $teachers = User::where('role_name', Role::$teacher)->get();
        $categories = Category::where('parent_id', null)->get();
        $students = User::where('role_name', Role::$user)->get();

        $data = [
            'pageTitle' => !empty($webinar) ? 'Edit Online Class' : 'Create Online Class',
            'teachers' => $teachers,
            'categories' => $categories,
            'students' => $students,
        ];

        return view('admin.webinars.create', $data);
    }
    public function student(Request $request)
    {
        $student_id = $request->get('student_id');
        $course_id = $request->get('course_id');
        $full_name = $request->get('full_name');

        $sale = Sale::where('ticket_id', null)->with('webinar', 'buyer')->orderBy('id', 'desc');

        // $webinar = Webinar::where('status', 'active')->orderBy('id', 'desc');
        if (!empty($student_id)) {
            $sale->where('buyer_id', $student_id);
        }
        if (!empty($course_id)) {
            $sale->where('webinar_id', $course_id);
        }
        if (!empty($full_name)) {
            $user = User::where('full_name', 'Like', "%$full_name%")->first();
            // dd($user);
            $sale->where('buyer_id', $user ? $user->id : null);
        }

        $query =  $sale->paginate(10);

        $data = [
            'pageTitle' => 'Student Class List',
            'query' => $query,
        ];

        return view('admin.webinars.student', $data);
    }

    public function record(Request $request)
    {
        $class_id = $request->get('class_id');
        $sessions = Session::where('session_api', 'big_blue_button')
            // ->where('status', Session::$Active)
            ->orderBy('id', 'desc');

        if (!empty($class_id)) {
            $sessions->where('id', $class_id);
        }
        $query = $sessions->paginate(10);
        // dd($query);

        $meetingID = [];
        $webinarID = [];
        // $className = [];
        foreach ($query as $session) {
            array_push($meetingID, $session->id);
            array_push($webinarID, $session->webinar_id);
        }
        // dd($slug_name[2]);


        // $className = Webinar::where('id', $webinarID)
        // dd($meetingID);
        $meetingsData = \Bigbluebutton::getRecordings([
            'meetingID' => [implode(',', $meetingID)],
            //'meetingID' => ['tamku','xyz'], //pass as array if get multiple recordings 
            //'recordID' => 'a3f1s',
            //'recordID' => ['xyz.1','pqr.1'] //pass as array note :If a recordID is specified, the meetingID is ignored.
            'state' => 'any' // It can be a set of states separate by commas  
        ]);
        // dd(implode(',',$meetingID));
        // $meetings = [];
        // foreach ($meetingsData as $meeting) {
        //     rsort($meeting->startTime);
        // }
        $array = collect($meetingsData)->sortBy('startTime')->reverse();
        // dd($array[0]);
        $get_meetings = json_decode($array);

        $data = [
            'pageTitle' => 'Class Recording List',
            'get_meetings' => $get_meetings,
            'meetingID' => $meetingID,
        ];


        return view('admin.webinars.class_record', $data);
    }

    public static function formatBytes($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public function deleteStudent($id)
    {
        $this->authorize('admin_webinars_delete');

        Sale::find($id)->delete();


        return redirect('/admin/webinars/student');
    }
    public function deleteMultipleStudent(Request $request)
    {
        // $this->authorize('admin_webinars_delete');
        $students = $request->id;

        foreach ($students as $student) {
            Sale::where('id',$student)->delete();
        }

        return redirect('/admin/webinars/student');
    }
    public function deleteMultipleClass(Request $request)
    {
        // $this->authorize('admin_webinars_delete');
        $classes = $request->id;

        foreach ($classes as $class) {
            Webinar::where('id',$class)->delete();
        }

        return redirect('/admin/webinars?type=webinar');
    }

    public function deleteRecord($id)
    {
        $this->authorize('admin_webinars_delete');

        \Bigbluebutton::deleteRecordings([
            'recordID' => $id,
            // 'recordID' => ['a3f1s','a4ff2'] //pass array if multiple delete recordings
        ]);

        return redirect('/admin/webinars/records');
    }
    public function deleteMultipleRecord(Request $request)
    {
        // $this->authorize('admin_webinars_delete');
        $records = $request->id;
        // dd(implode(', ',$records));
        \Bigbluebutton::deleteRecordings([
            'recordID' => $records,
            // 'recordID' => ['a3f1s','a4ff2'] //pass array if multiple delete recordings
        ]);

        return redirect('/admin/webinars/records');
    }

    public function store(Request $request)
    {
        $this->authorize('admin_webinars_create');

        // dd('hey');
        $this->validate($request, [
            'type' => 'required|in:webinar,course,text_lesson',
            'title' => 'required|max:255|unique:webinar_translations,title',
            'slug' => 'max:255|unique:webinars,slug',
            'thumbnail' => 'required',
            // 'image_cover' => 'required',
            'description' => 'required',
            'teacher_id' => 'required|exists:users,id',
            'category_id' => 'required',
            'start_date' => 'required_if:type,webinar',
            'capacity' => 'required',
            'student' => 'required',
        ],[
            'category_id.required' => 'Subject Field is required.',
            'capacity.required' => 'Capacity Field is required.',
        ]);

        $data = $request->all();


        if ($data['type'] != Webinar::$webinar) {
            $data['start_date'] = null;
        }
        if (!empty($data['start_date']) and $data['type'] == Webinar::$webinar) {
            if (empty($data['timezone']) or !getFeaturesSettings('timezone_in_create_webinar')) {
                $data['timezone'] = getTimezone();
            }

            $startDate = convertTimeToUTCzone($data['start_date'], "Asia/Kuala_Lumpur");

            $data['start_date'] = $startDate->getTimestamp();
            // dd($data['timezone']);

        }

        if (empty($data['slug'])) {
            // $data['slug'] = Webinar::makeSlug($data['title']);
            $data['slug'] = Str::slug($data['title']);
        }

        // if (empty($data['video_demo'])) {
        //     $data['video_demo_source'] = null;
        // }

        // if (!empty($data['video_demo_source']) and !in_array($data['video_demo_source'], ['upload', 'youtube', 'vimeo', 'external_link'])) {
        //     $data['video_demo_source'] = 'upload';
        // }

        $webinar = Webinar::create([
            'type' => $data['type'],
            'slug' => $data['slug'],
            'teacher_id' => $data['teacher_id'],
            'creator_id' => $data['teacher_id'],
            'thumbnail' => $data['thumbnail'],
            'image_cover' => 'https://www.youseed.com.my/store/1/YouSeed%20-final%20logo%20-%20white%20bg-01.png',
            'video_demo' => null,
            'video_demo_source' => null,
            'capacity' => $data['capacity'] ?? null,
            'start_date' => (!empty($data['start_date'])) ? $data['start_date'] : null,
            'timezone' => 'Asia/Kuala_Lumpur',
            'duration' => 0,
            'support' => !empty($data['support']) ? true : false,
            'downloadable' => !empty($data['downloadable']) ? true : false,
            'partner_instructor' => !empty($data['partner_instructor']) ? true : false,
            'subscribe' => !empty($data['subscribe']) ? true : false,
            'price' => 0,
            'category_id' => $data['category_id'],
            'status' => Webinar::$pending,
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        Log::info('Class created with name' .' '. $data['title']);

        if ($webinar) {
            WebinarTranslation::updateOrCreate([
                'webinar_id' => $webinar->id,
                'locale' => 'en',
            ], [
                'title' => $data['title'],
                'description' => $data['description'],
                'seo_description' => null,
            ]);
        }

        $filters = $request->get('filters', null);
        if (!empty($filters) and is_array($filters)) {
            WebinarFilterOption::where('webinar_id', $webinar->id)->delete();
            foreach ($filters as $filter) {
                WebinarFilterOption::create([
                    'webinar_id' => $webinar->id,
                    'filter_option_id' => $filter
                ]);
            }
        }

        if (!empty($data['student'])) {
            $students = $data['student'];
            // dd($students);

            foreach ($students as $student) {
                Sale::create([
                    'buyer_id' => $student,
                    'seller_id' => $data['teacher_id'],
                    'webinar_id' => $webinar->id,
                    'type' => Sale::$webinar,
                    'payment_method' => Sale::$credit,
                    'amount' => 0,
                    'total_amount' => 0,
                    'created_at' => time(),
                ]);
                // User::where('id', $student)->update(['teacher_id' => $data['teacher_id']]);
            }
        }






        if (!empty($request->get('tags'))) {
            $tags = explode(',', $request->get('tags'));
            Tag::where('webinar_id', $webinar->id)->delete();

            foreach ($tags as $tag) {
                Tag::create([
                    'webinar_id' => $webinar->id,
                    'title' => $tag,
                ]);
            }
        }

        if (!empty($request->get('partner_instructor')) and !empty($request->get('partners'))) {
            WebinarPartnerTeacher::where('webinar_id', $webinar->id)->delete();

            foreach ($request->get('partners') as $partnerId) {
                WebinarPartnerTeacher::create([
                    'webinar_id' => $webinar->id,
                    'teacher_id' => $partnerId,
                ]);
            }
        }
        // --------Auto create section

        $teacher = $webinar->creator;
        $chapter = WebinarChapter::create([
            'user_id' => $teacher->id,
            'webinar_id' => $webinar->id,
            'type' => 'session',
            'title' => $data['title'],
            'status' => 'active',
            'created_at' => time(),
        ]);
        WebinarChapter::create([
            'user_id' => $teacher->id,
            'webinar_id' => $webinar->id,
            'type' => 'file',
            'title' => $data['title'] . ' ' . 'Material',
            'status' => 'active',
            'created_at' => time(),
        ]);

        if (!empty($chapter)) {
            WebinarChapterTranslation::updateOrCreate([
                'webinar_chapter_id' => $chapter->id,
                'locale' => 'en',
            ], [
                'title' => $data['title'],
            ]);
        }
        // dd($data['start_date']);

        // --------Auto create session

        $session = Session::create([
            'creator_id' => $teacher->id,
            'webinar_id' => $webinar->id,
            'chapter_id' => $chapter->id,
            'date' => $data['start_date'],
            'duration' => '0',
            'link' => $data['link'] ?? '',
            'session_api' => 'big_blue_button',
            'api_secret' => 'youseed',
            'moderator_secret' => 'youseedmoderator',
            'status' => Session::$Active,
            'created_at' => time()
        ]);

        if (!empty($session)) {
            SessionTranslation::updateOrCreate([
                'session_id' => $session->id,
                'locale' => 'en',
            ], [
                'title' => $data['title'],
                'description' => $data['description'],
            ]);
            $this->handleBigBlueButtonApi($session, $teacher);
        }
        setcookie('chapter_id', $chapter->id);

        return redirect('/admin/webinars/' . $webinar->id . '/edit?locale=' . 'en' . '#chapter');
    }
    private function handleBigBlueButtonApi($session, $user)
    {
        $createMeeting = \Bigbluebutton::initCreateMeeting([
            'meetingID' => $session->id,
            'meetingName' => $session->title,
            'attendeePW' => $session->api_secret,
            'moderatorPW' => $session->moderator_secret,
        ]);



        // $createMeeting->setDuration($session->duration);
        \Bigbluebutton::create($createMeeting);

        return true;
    }

    public function edit(Request $request, $id)
    {
        $this->authorize('admin_webinars_edit');

        $webinar = Webinar::where('id', $id)
            ->with([
                'tickets',
                'sessions',
                'files',
                'chapters' => function ($query) {
                    $query->orderBy('order', 'asc');
                },
                'faqs',
                'category' => function ($query) {
                    $query->with(['filters' => function ($query) {
                        $query->with('options');
                    }]);
                },
                'filterOptions',
                'prerequisites',
                'quizzes',
                'webinarPartnerTeacher' => function ($query) {
                    $query->with(['teacher' => function ($query) {
                        $query->select('id', 'full_name');
                    }]);
                },
                'tags',
                'sales',
                'textLessons'
            ])
            ->first();

        if (empty($webinar)) {
            abort(404);
        }

        $locale = $request->get('locale', app()->getLocale());
        storeContentLocale('en', $webinar->getTable(), $webinar->id);

        $teachers = User::where('role_name', Role::$teacher)->get();
        $categories = Category::where('parent_id', null)
            ->with('subCategories')
            ->get();

        $teacherQuizzes = Quiz::where('webinar_id', null)
            ->where('creator_id', $webinar->teacher_id)
            ->get();
        $sales = Sale::where('webinar_id', $id)->get();

        //here1
        $students = User::where('role_name', Role::$user)->get();

        $tags = $webinar->tags->pluck('title')->toArray();

// dd($webinar->category->filters);
        $data = [
            'pageTitle' => trans('admin/main.edit') . ' | ' . $webinar->title,
            'teachers' => $teachers,
            'categories' => $categories,
            'webinar' => $webinar,
            'students' => $students,
            'sales' => $sales,
            'webinarCategoryFilters' => !empty($webinar->category->filters) ? $webinar->category->filters : null,
            'webinarFilterOptions' => $webinar->filterOptions->pluck('filter_option_id')->toArray(),
            'tickets' => $webinar->tickets,
            'chapters' => $webinar->chapters,
            'sessions' => $webinar->sessions,
            'files' => $webinar->files,
            'textLessons' => $webinar->textLessons,
            'faqs' => $webinar->faqs,
            'teacherQuizzes' => $teacherQuizzes,
            'prerequisites' => $webinar->prerequisites,
            'webinarQuizzes' => $webinar->quizzes,
            'webinarPartnerTeacher' => $webinar->webinarPartnerTeacher->keyby('teacher_id'),
            'webinarTags' => $tags,
        ];

        return view('admin.webinars.create', $data);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin_webinars_edit');
        $data = $request->all();

        $webinar = Webinar::find($id);
        $isDraft = (!empty($data['draft']) and $data['draft'] == 1);
        $reject = (!empty($data['draft']) and $data['draft'] == 'reject');
        $publish = (!empty($data['draft']) and $data['draft'] == 'publish');

        $rules = [
            'type' => 'required|in:webinar,course,text_lesson',
            'title' => 'required|max:255',
            'slug' => 'max:255|unique:webinars,slug,' . $webinar->id,
            'thumbnail' => 'required',
            // 'image_cover' => 'required',
            'description' => 'required',
            'teacher_id' => 'required|exists:users,id',
            'category_id' => 'required',
        ];

        if ($webinar->isWebinar()) {
            $rules['start_date'] = 'required|date';
            // $rules['duration'] = 'required';
            $rules['capacity'] = 'required|integer';
        }

        $this->validate($request, $rules);

        if (!empty($data['teacher_id'])) {
            $teacher = User::find($data['teacher_id']);
            $creator = $webinar->creator;

            if (empty($teacher) or ($creator->isOrganization() and ($teacher->organ_id != $creator->id and $teacher->id != $creator->id))) {
                $toastData = [
                    'title' => trans('public.request_failed'),
                    'msg' => trans('admin/main.is_not_the_teacher_of_this_organization'),
                    'status' => 'error'
                ];
                return back()->with(['toast' => $toastData]);
            }
        }


        if (empty($data['slug'])) {
            // $data['slug'] = Webinar::makeSlug($data['title']);
            $data['slug'] = Str::slug($data['title']);
        }

        $data['status'] = $publish ? Webinar::$active : ($reject ? Webinar::$inactive : ($isDraft ? Webinar::$isDraft : Webinar::$pending));
        $data['updated_at'] = time();

        if (!empty($data['start_date']) and $webinar->type == 'webinar') {
            if (empty($data['timezone']) or !getFeaturesSettings('timezone_in_create_webinar')) {
                $data['timezone'] = getTimezone();
            }

            $startDate = convertTimeToUTCzone($data['start_date'], $data['timezone']);

            $data['start_date'] = $startDate->getTimestamp();
        } else {
            $data['start_date'] = null;
        }

        $data['private'] = (!empty($data['private']) and $data['private'] == 'on');
        $data['support'] = !empty($data['support']) ? true : false;
        $data['downloadable'] = !empty($data['downloadable']) ? true : false;
        $data['partner_instructor'] = !empty($data['partner_instructor']) ? true : false;
        $data['subscribe'] = !empty($data['subscribe']) ? true : false;

        if (empty($data['partner_instructor'])) {
            WebinarPartnerTeacher::where('webinar_id', $webinar->id)->delete();
            unset($data['partners']);
        }

        if ($data['category_id'] !== $webinar->category_id) {
            WebinarFilterOption::where('webinar_id', $webinar->id)->delete();
        }

        $filters = $request->get('filters', null);
        if (!empty($filters) and is_array($filters)) {
            WebinarFilterOption::where('webinar_id', $webinar->id)->delete();
            foreach ($filters as $filter) {
                WebinarFilterOption::create([
                    'webinar_id' => $webinar->id,
                    'filter_option_id' => $filter
                ]);
            }
        }

        if (!empty($request->get('tags'))) {
            $tags = explode(',', $request->get('tags'));
            Tag::where('webinar_id', $webinar->id)->delete();

            foreach ($tags as $tag) {
                Tag::create([
                    'webinar_id' => $webinar->id,
                    'title' => $tag,
                ]);
            }
        }

        if (!empty($request->get('partner_instructor')) and !empty($request->get('partners'))) {
            WebinarPartnerTeacher::where('webinar_id', $webinar->id)->delete();

            foreach ($request->get('partners') as $partnerId) {
                WebinarPartnerTeacher::create([
                    'webinar_id' => $webinar->id,
                    'teacher_id' => $partnerId,
                ]);
            }
        }
        unset(
            $data['_token'],
            $data['current_step'],
            $data['draft'],
            $data['get_next'],
            $data['partners'],
            $data['tags'],
            $data['filters'],
            $data['ajax']
        );

        // if (empty($data['video_demo'])) {
        //     $data['video_demo_source'] = null;
        // }

        // if (!empty($data['video_demo_source']) and !in_array($data['video_demo_source'], ['upload', 'youtube', 'vimeo', 'external_link'])) {
        //     $data['video_demo_source'] = 'upload';
        // }

            // dd($data['slug']);
        $webinar->updateOrCreate(['id' => $id],[
            'slug' => $data['slug'],
            'teacher_id' => $data['teacher_id'],
            'type' => $data['type'],
            'thumbnail' => $data['thumbnail'],
            'image_cover' => 'https://www.youseed.com.my/store/1/YouSeed%20-final%20logo%20-%20white%20bg-01.png',
            'video_demo' => null,
            'video_demo_source' => null,
            'capacity' => $data['capacity'] ?? null,
            'start_date' => $data['start_date'],
            'timezone' => $data['timezone'] ?? null,
            'duration' => 0,
            'support' => $data['support'],
            'private' => $data['private'],
            'downloadable' => $data['downloadable'],
            'partner_instructor' => $data['partner_instructor'],
            'subscribe' => $data['subscribe'],
            'price' => 0,
            'category_id' => $data['category_id'],
            'points' => $data['points'] ?? null,
            'status' => $data['status'],
            'updated_at' => time(),
        ]);
        Log::info('Class updated with name' .' '. $data['title']);

        if (!empty($data['student'])) {
            $students = $data['student'];

            foreach ($students as $student) {
                // dd($data['teacher_id']);
                Sale::updateOrCreate(['buyer_id' => $student, 'webinar_id' => $webinar->id], [
                    'buyer_id' => $student,
                    'seller_id' => $data['teacher_id'],
                    'webinar_id' => $webinar->id,
                    'type' => Sale::$webinar,
                    'payment_method' => Sale::$credit,
                    'amount' => 0,
                    'total_amount' => 0,
                    'created_at' => time(),
                ]);
                // User::updateOrCreate(['id' => $student], ['teacher_id' => $data['teacher_id']]);
            }
        }

        // dd($students);




        Session::where('webinar_id', $webinar->id)->update(['date' => $data['start_date'], 'updated_at' => time()]);

        if ($webinar) {
            WebinarTranslation::updateOrCreate([
                'webinar_id' => $webinar->id,
                'locale' => 'en',
            ], [
                'title' => $data['title'],
                'description' => $data['description'],
                'seo_description' => null,
            ]);
        }

        if ($publish) {
            sendNotification('course_approve', ['[c.title]' => $webinar->title], $webinar->teacher_id);

            $createClassesReward = RewardAccounting::calculateScore(Reward::CREATE_CLASSES);
            RewardAccounting::makeRewardAccounting(
                $webinar->creator_id,
                $createClassesReward,
                Reward::CREATE_CLASSES,
                $webinar->id,
                true
            );
        } elseif ($reject) {
            sendNotification('course_reject', ['[c.title]' => $webinar->title], $webinar->teacher_id);
        }

        removeContentLocale();

        $sweetAlertData = [
            'msg' => 'Online Class has successfully created',
            'status' => 'success'
        ];
        return redirect('/admin/webinars?type=webinar')->with(['sweetalert' => $sweetAlertData]);
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('admin_webinars_delete');

        Webinar::find($id)->delete();

        $webinar = Webinar::find($id);

        Log::info('Class created with name' .' '. $webinar['slug']);


        return redirect('/admin/webinars?type=webinar');
    }

    public function search(Request $request)
    {
        $term = $request->get('term');

        $option = $request->get('option', null);

        $query = Webinar::select('id')
            ->whereTranslationLike('title', "%$term%");

        if (!empty($option) and $option == 'just_webinar') {
            $query->where('type', Webinar::$webinar);
            $query->where('status', Webinar::$active);
        }

        $webinar = $query->get();

        return response()->json($webinar, 200);
    }

    public function exportExcel(Request $request)
    {
        $this->authorize('admin_webinars_export_excel');

        $query = Webinar::query();

        $query = $this->filterWebinar($query, $request)
            ->with(['teacher' => function ($qu) {
                $qu->select('id', 'full_name');
            }, 'sales']);

        $webinars = $query->get();

        $webinarExport = new WebinarsExport($webinars);

        return Excel::download($webinarExport, 'webinars.xlsx');
    }
}
