@extends(getTemplate() . '.panel.layouts.panel_layout')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
@endpush

@section('content')

    <section class="mt-md-25 mt-50">
        <div style="background-color: #43d477 !important;">

            <div style="padding: 20px 50px;"
                class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
                {{-- <h2 class="section-title">{{ trans('panel.my_webinars') }}</h2> --}}
                <h2 class="section-title" style="color: #fff">My Class</h2>

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

        <div class="webinar-mobile-padding" style="padding: 30px 50px;">
            <div class="row">

                @if (!empty($webinars) and !$webinars->isEmpty())
                    @foreach ($webinars as $webinar)
                        @php
                            $lastSession = $webinar->lastSession();
                            $nextSession = $webinar->nextSession();
                            $isProgressing = false;
                            
                            if ($webinar->start_date <= time() and !empty($lastSession) and $lastSession->date > time()) {
                                $isProgressing = true;
                            }
                        @endphp

                        <div class="col-12 col-xl-4 col-lg-4 col-md-6 mt-30">
                            {{-- <div class="webinar-card webinar-list d-flex"> --}}
                            <div class="gradient-card" style="height: 620px!important;">
                                <div class="image-box" style="position: relative;">
                                    <img src="{{ $webinar->getImage() }}" class="img-cover" alt="">
                                    <div class="d-flex justify-content-between">
                                        @switch($webinar->status)
                                            @case(\App\Models\Webinar::$active)
                                                @if ($webinar->isWebinar())
                                                    @if ($webinar->start_date > time())
                                                        <span style="position: absolute;top: 17px;"
                                                            class="badge badge-secondary">{{ trans('panel.not_conducted') }}</span>
                                                    @elseif($webinar->isProgressing())
                                                        <span style="position: absolute;top: 17px;"
                                                            class="badge badge-primary">{{ trans('webinars.in_progress') }}</span>
                                                    @else
                                                        <span style="position: absolute;top: 17px;"
                                                            class="badge badge-secondary">{{ trans('public.finished') }}</span>
                                                    @endif
                                                @else
                                                    <span style="position: absolute;top: 17px;"
                                                        class="badge badge-secondary">{{ trans('webinars.' . $webinar->type) }}</span>
                                                @endif
                                            @break

                                            @case(\App\Models\Webinar::$isDraft)
                                                <span style="position: absolute;top: 17px;"
                                                    class="badge badge-danger">{{ trans('public.draft') }}</span>
                                            @break

                                            @case(\App\Models\Webinar::$pending)
                                                <span style="position: absolute;top: 17px;"
                                                    class="badge badge-warning">{{ trans('public.waiting') }}</span>
                                            @break

                                            @case(\App\Models\Webinar::$inactive)
                                                <span style="position: absolute;top: 17px;"
                                                    class="badge badge-danger">{{ trans('public.rejected') }}</span>
                                            @break
                                        @endswitch

                                        <div style="position: absolute;top: 17px;right: 17px;">
                                            <span
                                                class="badge badge-white ml-10 status-badge-white">{{ trans('webinars.' . $webinar->type) }}</span>


                                                {{--  --}}

                                                @if($authUser->id == $webinar->creator_id or $authUser->id == $webinar->teacher_id)
                                                <div class="btn-group dropdown table-actions">
                                                    <button style="color: #46aa52;" type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i data-feather="more-vertical" height="20"></i>
                                                    </button>
                                                    <div class="dropdown-menu" style="top: -83px!important;">
        
                                                        <a href="/panel/webinars/{{ $webinar->id }}/step/4" class="webinar-actions d-block mt-10">Upload Files</a>
                                                        <a href="/panel/webinars/{{ $webinar->id }}/step/1" class="webinar-actions d-block mt-10">Edit Class</a>
                                                        <a href="/panel/webinars/{{ $webinar->id }}/delete" class="webinar-actions d-block mt-10">Delete Class</a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                    </div>

                                    {{-- @if ($webinar->isWebinar())
                                        <div class="progress">
                                            <span class="progress-bar"
                                                style="width: {{ $webinar->getProgress() }}%"></span>
                                        </div>
                                    @endif --}}
                                </div>

                                <div style="padding: 0 20px;" class="webinar-card-body w-100 d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="{{ $webinar->getUrl() }}" target="_blank">
                                            <h3 style="color: #43d477" class="font-18 font-weight-bold">
                                                {{ $webinar->title }}
                                            </h3>
                                        </a>


                                    </div>

                                    {{-- @include(getTemplate() . '.includes.webinar.rate', [
                                        'rate' => $webinar->getRate(),
                                    ]) --}}

                                    {{-- <div class="webinar-price-box mt-15">
                                        @if ($webinar->price > 0)
                                            @if ($webinar->bestTicket() < $webinar->price)
                                                <span class="real">{{ handlePrice($webinar->bestTicket()) }}</span>
                                                <span class="off ml-10">{{ handlePrice($webinar->price) }}</span>
                                            @else
                                                <span class="real">{{ handlePrice($webinar->price) }}</span>
                                            @endif
                                        @else
                                            <span class="real">{{ trans('public.free') }}</span>
                                        @endif
                                    </div> --}}

                                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-auto">
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span
                                                class="stat-title font-weight-bold font-15">Class ID:</span>
                                            <span class="stat-value">{{ $webinar->id }}</span>
                                        </div>

                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span
                                                class="stat-title font-weight-bold font-15">Subject:</span>
                                            <span
                                                class="stat-value">{{ !empty($webinar->category_id) ? $webinar->category->title : '' }}</span>
                                        </div>

                                        @if ($webinar->isProgressing() and !empty($nextSession))
                                            {{-- <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">{{ trans('webinars.next_session_duration') }}:</span>
                                            <span class="stat-value">{{ convertMinutesToHourAndMinute($nextSession->duration) }} Hrs</span>
                                        </div> --}}

                                            @if ($webinar->isWebinar())
                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span
                                                        class="stat-title font-weight-bold font-15">{{ trans('webinars.next_session_start_date') }}:</span>
                                                    <span
                                                        class="stat-value">{{ dateTimeFormat($nextSession->date, 'j M Y') }}</span>
                                                </div>
                                            @endif
                                        @else
                                            {{-- <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">{{ trans('public.duration') }}:</span>
                                            <span class="stat-value">{{ convertMinutesToHourAndMinute($webinar->duration) }} Hrs</span>
                                        </div> --}}

                                            @if ($webinar->isWebinar())
                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span
                                                        class="stat-title font-weight-bold font-15">{{ trans('public.start_date') }}:</span>
                                                    <span
                                                        class="stat-value">{{ dateTimeFormat($webinar->start_date, 'j M Y') }}</span>
                                                </div>
                                            @endif
                                        @endif

                                        @if ($webinar->isTextCourse() or $webinar->isCourse())
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span
                                                    class="stat-title font-weight-bold font-15">{{ trans('public.files') }}:</span>
                                                <span class="stat-value">{{ $webinar->files->count() }}</span>
                                            </div>
                                        @endif

                                        @if ($webinar->isTextCourse())
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span
                                                    class="stat-title font-weight-bold font-15">{{ trans('webinars.text_lessons') }}:</span>
                                                <span class="stat-value">{{ $webinar->textLessons->count() }}</span>
                                            </div>
                                        @endif

                                        @if ($webinar->isCourse())
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span
                                                    class="stat-title font-weight-bold font-15">{{ trans('home.downloadable') }}:</span>
                                                <span
                                                    class="stat-value">{{ $webinar->downloadable ? trans('public.yes') : trans('public.no') }}</span>
                                            </div>
                                        @endif

                                        {{-- <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                        <span class="stat-title">{{ trans('panel.sales') }}:</span>
                                        <span class="stat-value">{{ count($webinar->sales) }} ({{ (!empty($webinar->sales) and count($webinar->sales)) ? addCurrencyToPrice($webinar->sales->sum('amount')) : 0 }})</span>
                                    </div> --}}

                                        @if (!empty($webinar->partner_instructor) and $webinar->partner_instructor and $authUser->id != $webinar->teacher_id and $authUser->id != $webinar->creator_id)
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span
                                                    class="stat-title font-weight-bold font-15">{{ trans('panel.invited_by') }}:</span>
                                                <span class="stat-value">{{ $webinar->teacher->full_name }}</span>
                                            </div>
                                        @elseif($authUser->id != $webinar->teacher_id and $authUser->id != $webinar->creator_id)
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span
                                                    class="stat-title font-weight-bold font-15">{{ trans('webinars.teacher_name') }}:</span>
                                                <span class="stat-value">{{ $webinar->teacher->full_name }}</span>
                                            </div>
                                        @elseif($authUser->id == $webinar->teacher_id and $authUser->id != $webinar->creator_id and $webinar->creator->isOrganization())
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span
                                                    class="stat-title font-weight-bold font-15">{{ trans('webinars.organization_name') }}:</span>
                                                <span class="stat-value">{{ $webinar->creator->full_name }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div style="margin: 15px 0px">
                                        <span class="stat-title font-weight-bold font-15">Description</span>
                                        
                                        <p>
                                            {!! $webinar->description !!}
    
                                           </p>
                                    </div>
                                    <div
                                        style="
                                        background-color: #43d477 !important;
                                        text-align: center;
                                        color: #fff;
                                        padding: 10px;
                                        border-radius: 20px;
                                        position: absolute;
                                        bottom: 17px;
                                        width: 80%;
                                        left: 37px;"
                                    >
                                        <a href="{{ $webinar->getLearningPageUrl() }}" target="_blank">Go to Class</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>

            <div class="my-30">
                {{ $webinars->appends(request()->input())->links('vendor.pagination.panel') }}
            </div>
        @else
            @include(getTemplate() . '.includes.no-result', [
                'file_name' => 'webinar.png',
                'title' => 'No available class',
                'hint' => trans('panel.no_result_hint'),
                'btn' => ['url' => '#', 'text' => 'Wait for class assign from admin'],
            ])
            @endif

    </section>

    @include('web.default.panel.webinar.make_next_session_modal')
    </div>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>

    <script>
        var undefinedActiveSessionLang = '{{ trans('webinars.undefined_active_session') }}';
        var saveSuccessLang = '{{ trans('webinars.success_store') }}';
    </script>

    <script src="/assets/default/js/panel/make_next_session.min.js"></script>

    <script>
        (function($) {
            "use strict";

            @if (session()->has('sweetalert'))
                Swal.fire({
                    icon: "{{ session()->get('sweetalert')['status'] ?? 'success' }}",
                    html: '<h3 class="font-20 text-center text-dark-blue py-25">{{ session()->get('sweetalert')['msg'] ?? '' }}</h3>',
                    showConfirmButton: true,
                    width: '25rem',
                });
            @endif
        })(jQuery)
    </script>
@endpush
