@extends('admin.layouts.app')

@push('libraries_top')
@endpush

@section('content')
    <section class="card">
        <div class="card-body">
            <form method="get" class="mb-0">
                {{-- <input type="hidden" name="type" value="{{ request()->get('type') }}"> --}}
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Search by Name</label>
                            <input placeholder="Enter Student Name" name="full_name" type="text" class="form-control"
                                value="{{ request()->get('full_name') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Search by Student ID</label>
                            <input placeholder="Enter Student ID" name="student_id" type="number" class="form-control"
                                value="{{ request()->get('student_id') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Search by Class ID</label>
                            <input placeholder="Enter Class ID" name="course_id" type="number" class="form-control"
                                value="{{ request()->get('course_id') }}">
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="form-group mt-1">
                            <label class="input-label mb-4"> </label>
                            <input type="submit" class="text-center btn btn-primary w-100"
                                value="{{ trans('admin/main.show_results') }}">
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
                <div class="breadcrumb-item">Classes</div>

                <div class="breadcrumb-item">Student</div>
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
                                <form action="{{ url('/admin/webinars/studentmultidelete') }}" method="post">
                                    @csrf
                                    <input class="btn btn-primary" type="submit" name="submit"
                                        value="Remove Selected Students from class" />
                                    <br />
                                    <br />
                                    <table id="tableList" class="table table-striped font-14 ">
                                        <tr>
                                            <th class="text-left"> <input type="checkbox" id="checkAll"> Select All</th>
                                            <th>{{ trans('admin/main.id') }}</th>
                                            <th class="text-left">Student ID</th>
                                            <th class="text-left">Student Name</th>
                                            <th class="text-left">Class ID</th>
                                            <th class="text-left">Class Name</th>
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
                                        @if (!empty($query))
                                            {{-- {{var_dump($query[1]->buyer['full_name'])}} --}}
                                            @foreach ($query as $key => $sale)
                                                <tr class="text-center">
                                                    <td class="text-center"><input name='id[]' type="checkbox"
                                                            id="checkItem" value="{{ $sale->id }}">
                                                    </td>
                                                    <td>{{ $sale->id }}</td>
                                                    <td class="text-left">{{ $sale->buyer_id }}</td>
                                                    <td class="text-left">
                                                        {{ isset($sale->buyer['full_name']) ? $sale->buyer['full_name'] : 'null' }}
                                                    </td>
                                                    <td class="text-left">{{ $sale->webinar_id }}</td>
                                                    <td class="text-left">
                                                        {{ isset($sale->webinar['slug']) ? str_replace('-', ' ', $sale->webinar['slug']) : 'null' }}
                                                    </td>
                                                    <td class="text-left">
                                                        {{ \Carbon\Carbon::createFromTimestamp($sale->created_at) }}</td>


                                                    <td width="120" class="btn-sm">
                                                        @can('admin_webinars_delete')
                                                            @include('admin.includes.delete_button', [
                                                                'url' =>
                                                                    '/admin/webinars/student/' .
                                                                    $sale->id .
                                                                    '/delete',
                                                                'btnClass' => 'btn-sm mt-1',
                                                            ])
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        @if ($query[0] == null)
                                            <tr class="text-center">
                                                <td class="text-center">No Data !</td>
                                            </tr>
                                        @endif

                                    </table>
                                </form>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $query->appends(request()->input())->links() }}
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
