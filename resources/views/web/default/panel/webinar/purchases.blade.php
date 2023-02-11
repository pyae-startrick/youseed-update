@extends(getTemplate() . '.panel.layouts.panel_layout')

@push('styles_top')
@endpush

@section('content')

    <section class="mt-md-25 mt-50">
        <div style="background-color: #43d477 !important;">

            <div style="padding: 20px 50px;"
                class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
                {{-- <h2 class="section-title">{{ trans('panel.my_purchases') }}</h2> --}}
                <h2 class="section-title" style="color: #fff">My Class</h2>

                {{-- <form action="" method="get">
                    <div
                        class="d-flex align-items-center flex-row-reverse flex-md-row justify-content-start justify-content-md-center mt-20 mt-md-0">
                        <label class="mb-0 mr-10 text-white font-14 font-weight-500"
                            for="conductedSwitch">{{ trans('panel.only_not_conducted_webinars') }}</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" name="not_conducted" @if (request()->get('not_conducted', '') == 'on') checked @endif
                                class="custom-control-input" id="conductedSwitch">
                            <label class="custom-control-label cursor-pointer" for="conductedSwitch"></label>
                        </div>
                    </div>
                </form> --}}
            </div>
        </div>
        <div class="webinar-mobile-padding" style="padding: 30px 50px;">
            <div class="row ">

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
                            <div class="gradient-card" style="height: 620px!important;background-image: linear-gradient(#282828, white max(0rem, 26vh))!important;">

                                <div class="image-box" style="position: relative;">
                                    @if (!empty($webinar->getImage()))
                                    <img src="{{ $webinar->getImage() }}" class="img-cover" alt="">
@else
<img src="/assets/default/img/200x200.png" class="img-cover" alt="">

                                    @endif
                                    <div class="d-flex justify-content-between">

                                        @if ($webinar->type == 'webinar')
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
                                        @elseif(!empty($webinar->downloadable))
                                            <span style="position: absolute;top: 17px;"
                                                class="badge badge-secondary">{{ trans('home.downloadable') }}</span>
                                        @else
                                            <span style="position: absolute;top: 17px;"
                                                class="badge badge-secondary">{{ trans('webinars.' . $webinar->type) }}</span>
                                        @endif

                                        <div style="position: absolute;top: 17px;right: 17px;">

                                            <span
                                                class="badge badge-white ml-10 status-badge-white">{{ trans('webinars.' . $webinar->type) }}</span>
                                          
                                        </div>
                                    </div>
                                </div>

                                <div style="padding: 0 20px;" class="webinar-card-body w-100 d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="{{ $webinar->getUrl() }}">
                                            <h3 style="color: #43d477" class="webinar-title font-weight-bold font-18">
                                                {{ $webinar->title }}

                                            </h3>
                                        </a>


                                    </div>



                                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-auto">
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title font-weight-bold font-15">Class ID:</span>
                                            <span class="stat-value">{{ $webinar->id }}</span>
                                        </div>

                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title font-weight-bold font-15">Subject:</span>
                                            <span
                                                class="stat-value">{{ !empty($webinar->category_id) ? $webinar->category->title : '' }}</span>
                                        </div>

                                        @if ($webinar->type == 'webinar')
                                            @if ($webinar->isProgressing() and !empty($nextSession))
                                                {{-- <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span
                                                        class="stat-title">{{ trans('webinars.next_session_duration') }}:</span>
                                                    <span
                                                        class="stat-value">{{ convertMinutesToHourAndMinute($nextSession->duration) }}
                                                        Hrs</span>
                                                </div> --}}

                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span
                                                        class="stat-title font-weight-bold font-15">{{ trans('webinars.next_session_start_date') }}:</span>
                                                    <span
                                                        class="stat-value">{{ dateTimeFormat($nextSession->date, 'j M Y') }}</span>
                                                </div>
                                            @else
                                                {{-- <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span class="stat-title">{{ trans('public.duration') }}:</span>
                                                    <span
                                                        class="stat-value">{{ convertMinutesToHourAndMinute($webinar->duration) }}
                                                        Hrs</span>
                                                </div> --}}
                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span class="stat-title font-weight-bold font-15">Teacher:</span>
                                                    <span class="stat-value">{{ $webinar->teacher->full_name }}</span>
                                                </div>

                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span class="stat-title font-weight-bold font-15">{{ trans('public.start_date') }}:</span>
                                                    <span
                                                        class="stat-value">{{ dateTimeFormat($webinar->start_date, 'j M Y') }}</span>
                                                </div>
                                            @endif
                                        @endif

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
                                        {{-- <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title">{{ trans('panel.purchase_date') }}:</span>
                                            <span
                                                class="stat-value">{{ dateTimeFormat($webinar->purchast_date, 'j M Y') }}</span>
                                        </div> --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        @else
            @include(getTemplate() . '.includes.no-result', [
                'file_name' => 'student.png',
                'title' => 'No available class',
            ])
            @endif
        </div>

    </section>

    <div class="my-30">
        {{ $webinars->appends(request()->input())->links('vendor.pagination.panel') }}
    </div>

    @include('web.default.panel.webinar.join_webinar_modal')

@endsection

@push('scripts_bottom')
    <script>
        var undefinedActiveSessionLang = '{{ trans('webinars.undefined_active_session') }}';
    </script>

    <script src="/assets/default/js/panel/join_webinar.min.js"></script>
@endpush
