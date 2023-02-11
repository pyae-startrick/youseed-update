@extends('admin.layouts.app')

@push('libraries_top')
@endpush

@section('content')
    <section class="card">
        <div class="card-body">
            <form method="get" class="mb-0">

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Search By Student Name</label>
                            <input name="full_name" type="text" class="form-control" placeholder="Enter your student name" value="{{ request()->get('full_name') }}" list="studentname">
                            <datalist id='studentname'>
                                @foreach ($datalists as $name)
                                    <option value="{{$name->full_name}}" />
                                @endforeach
                            </datalist>
                        </div>
                    </div>

                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">{{ trans('admin/main.start_date') }}</label>
                            <div class="input-group">
                                <input type="date" id="from" class="text-center form-control" name="from" value="{{ request()->get('from') }}" placeholder="Start Date">
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">{{ trans('admin/main.end_date') }}</label>
                            <div class="input-group">
                                <input type="date" id="to" class="text-center form-control" name="to" value="{{ request()->get('to') }}" placeholder="End Date">
                            </div>
                        </div>
                    </div> --}}


                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">{{ trans('admin/main.filters') }}</label>
                            <select name="sort" data-plugin-selectTwo class="form-control populate">
                                <option value="">{{ trans('admin/main.filter_type') }}</option>
                                <option value="purchased_classes_asc" @if(request()->get('sort') == 'purchased_classes_asc') selected @endif>{{ trans('admin/main.purchased_classes_ascending') }}</option>
                                <option value="purchased_classes_desc" @if(request()->get('sort') == 'purchased_classes_desc') selected @endif>{{ trans('admin/main.purchased_classes_descending') }}</option>

                                <option value="purchased_classes_amount_asc" @if(request()->get('sort') == 'purchased_classes_amount_asc') selected @endif>{{ trans('admin/main.purchased_classes_amount_ascending') }}</option>
                                <option value="purchased_classes_amount_desc" @if(request()->get('sort') == 'purchased_classes_amount_desc') selected @endif>{{ trans('admin/main.purchased_classes_amount_descending') }}</option>


                                <option value="purchased_appointments_asc" @if(request()->get('sort') == 'purchased_appointments_asc') selected @endif>{{ trans('admin/main.purchased_appointments_ascending') }}</option>
                                <option value="purchased_appointments_desc" @if(request()->get('sort') == 'purchased_appointments_desc') selected @endif>{{ trans('admin/main.purchased_appointments_descending') }}</option>

                                <option value="purchased_appointments_amount_asc" @if(request()->get('sort') == 'purchased_appointments_amount_asc') selected @endif>{{ trans('admin/main.purchased_appointments_amount_ascending') }}</option>
                                <option value="purchased_appointments_amount_desc" @if(request()->get('sort') == 'purchased_appointments_amount_desc') selected @endif>{{ trans('admin/main.purchased_appointments_amount_descending') }}</option>

                                <option value="register_asc" @if(request()->get('sort') == 'register_asc') selected @endif>{{ trans('admin/main.register_date_ascending') }}</option>
                                <option value="register_desc" @if(request()->get('sort') == 'register_desc') selected @endif>{{ trans('admin/main.register_date_descending') }}</option>
                            </select>
                        </div>
                    </div> --}}


                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">{{ trans('admin/main.organization') }}</label>
                            <select name="organization_id" data-plugin-selectTwo class="form-control populate">
                                <option value="">{{ trans('admin/main.select_organization') }}</option>
                                @foreach($organizations as $organization)
                                    <option value="{{ $organization->id }}" @if(request()->get('organization_id') == $organization->id) selected @endif>{{ $organization->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    {{-- <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">{{ trans('admin/main.users_group') }}</label>
                            <select name="group_id" data-plugin-selectTwo class="form-control populate">
                                <option value="">{{ trans('admin/main.select_users_group') }}</option>
                                @foreach($userGroups as $userGroup)
                                    <option value="{{ $userGroup->id }}" @if(request()->get('group_id') == $userGroup->id) selected @endif>{{ $userGroup->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}


                    <div class="col-md-3">
                        <div class="form-group mt-1">
                            <label class="input-label mb-4"> </label>
                            <input type="submit" class="text-center btn btn-primary w-100" value="{{ trans('admin/main.show_results') }}">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="section">
        <div class="section-header">
            <h1>{{ $pageTitle }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/admin/">{{ trans('admin/main.dashboard') }}</a>
                </div>
                <div class="breadcrumb-item">Users</div>

                <div class="breadcrumb-item">Teacher's Student List </div>
            </div>
        </div>
        <div class="section-body">

            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            @can('admin_webinars_export_excel')
                                <div class="text-right">
                                    <a href="/admin/webinars/excel?{{ http_build_query(request()->all()) }}" class="btn btn-primary">{{ trans('admin/main.export_xls') }}</a>
                                </div>
                            @endcan
                        </div> --}}

                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="{{ url('/admin/assigned-students/studentmultiassigndelete') }}" method="post">
                                    @csrf
                                    <input class="btn btn-primary" type="submit" name="submit"
                                        value="Remove Selected Assigned Students from Teacher" />
                                    <br />
                                    <br />
                                    <table id="tableList" class="table table-striped font-14 ">
                                        <tr>
                                            <th class="text-left"> <input type="checkbox" name="deletecheck" id="checkAll"> Select All</th>
                                            <th>{{ trans('admin/main.id') }}</th>
                                            <th class="text-left">Student Name</th>
                                            <th class="text-left">Teacher Name</th>
                                            <th class="text-left">Created Date</th>
                                            {{-- <th class="text-left">{{trans('admin/main.instructor')}}</th> --}}
                                            {{-- <th>{{trans('admin/main.price')}}</th> --}}
                                            {{-- <th>{{trans('admin/main.sales')}}</th> --}}
                                            {{-- <th>{{trans('admin/main.income')}}</th> --}}
                                            {{-- <th>{{trans('admin/main.created_at')}}</th> --}}
                                            {{-- @if ($classesType == 'webinar') --}}
                                            {{-- <th>{{trans('admin/main.start_date')}}</th> --}}
                                            {{-- @else
                                            <th>{{trans('admin/main.updated_at')}}</th>
                                        @endif --}}
                                            {{-- <th>{{trans('admin/main.status')}}</th> --}}
                                            <th width="120">{{ trans('admin/main.actions') }}</th>
                                        </tr>
                                        {{-- {{dd($query[0])}} --}}
                                        @if (!empty($assignStudents))
                                            {{-- {{var_dump($query[1]->buyer['full_name'])}} --}}
                                            @foreach ($assignStudents as $student)
                                                <tr class="text-center">
                                                    <td class="text-center"><input name='id[]' type="checkbox"
                                                            id="checkItem" value="{{ $student->id }}">
                                                    </td>
                                                    <td>{{ $student->id}}</td>
                                                    <td class="text-left">{{ $student->student_name }}</td>
                                                    <td class="text-left">{{ $student->teacher_name }}</td>
                                                    <td class="text-left">
                                                        {{ \Carbon\Carbon::createFromTimestamp($student->created_at) }}</td>


                                                    <td width="120" class="btn-sm">
                                                        @can('admin_webinars_delete')
                                                            @include('admin.includes.delete_button', [
                                                                'url' =>
                                                                    '/admin/assigned-students/' .
                                                                    $student->id .
                                                                    '/delete',
                                                                'btnClass' => 'btn-sm mt-1',
                                                            ])
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        @if ($assignStudents == null)
                                            <tr class="text-center">
                                                <td class="text-center">No Data !</td>
                                            </tr>
                                        @endif

                                    </table>
                                </form>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $assignStudents->appends(request()->input())->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
    <script language="javascript">
        $("#checkAll").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endpush
