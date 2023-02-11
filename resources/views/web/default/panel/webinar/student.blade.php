@extends(getTemplate() .'.panel.layouts.panel_layout')

@push('libraries_top')
@endpush

@section('content')

<div style="background-color: #43d477 !important;">

    <div style="padding: 20px 50px;"
        class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
        {{-- <h2 class="section-title">{{ trans('panel.my_webinars') }}</h2> --}}
        <h2 class="section-title" style="color: #fff">{{$pageTitle}}</h2>

        {{-- <form action="" method="get">
            <div
                class="d-flex align-items-center flex-row-reverse flex-md-row justify-content-start justify-content-md-center mt-20 mt-md-0">
                <label class="cursor-pointer mb-0 mr-10 font-weight-500 font-14 text-white"
                    for="conductedSwitch">{{ trans('panel.only_not_conducted_webinars') }}</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" name="not_conducted" @if (request()->get('not_conducted', '') == 'on') checked @endif
                        class="custom-control-input" id="conductedSwitch">
                    <label class="custom-control-label" for="conductedSwitch"></label>
                </div>
            </div>
        </form> --}}
    </div>
</div>
    {{-- <section class="card">
        <div class="card-body">
            <form method="get" class="mb-0">
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="input-label">Search by Student Name</label>
                            <input placeholder="Enter Student Name" name="full_name" type="text" class="form-control"
                                value="{{ request()->get('full_name') }}">
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
    </section>--}}
    <section class="section webinar-mobile-padding" style="padding: 30px 50px;"> 

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
                                <table class="table table-striped font-14 ">
                                    <tr>
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
                                                <td>{{ $sale->id }}</td>
                                                <td class="text-left">{{ $sale->buyer_id }}</td>
                                                <td class="text-left">
                                                    {{ isset($sale->buyer['full_name']) ? $sale->buyer['full_name'] : 'null' }}
                                                </td>
                                                <td class="text-left">{{ $sale->webinar_id }}</td>
                                                <td class="text-left">
                                                    {{ isset($sale->webinar['slug']) ? str_replace('-', ' ', $sale->webinar['slug']) : 'null' }}
                                                </td>
                                                <td class="text-left">{{\Carbon\Carbon::createFromTimestamp($sale->created_at) }}</td>


                                                <td width="120" class="btn-sm">
                                                    {{-- @can('admin_webinars_delete') --}}
                                                        @include('admin.includes.delete_button', [
                                                            'url' =>
                                                                '/admin/webinars/student/' . $sale->id . '/delete',
                                                            'btnClass' => 'btn-sm mt-1',
                                                            'btnText' => 'Delete'
                                                        ])
                                                    {{-- @endcan --}}
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
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            {{ $query->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
@endpush
