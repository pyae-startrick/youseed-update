@extends('web.default.layouts.app', ['appFooter' => false, 'appHeader' => false])

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/learning_page/styles.css" />
    <link rel="stylesheet" href="/assets/default/vendors/video/video-js.min.css">
@endpush

@section('content')
    <div class="learning-page">

        @include('web.default.course.learningPage.components.navbar')
        {{-- <div class='noti-modal-wrapper' style="position: absolute;left:50%;">
            <div class='noti-modal modal--active'>
              <div class='noti-modal-content'> --}}
        {{-- <img id="noClass" src="/assets/default/img/home/notification.png"
            style="width:27%;position: absolute;left:37%;z-index: 1;top: 18%;display:none;opacity:1!important" alt=""> --}}
        {{-- </div>
            </div>
        </div> --}}
        {{-- id="blueID" --}}
        <div  class="d-flex position-relative">
            <div class="learning-page-content flex-grow-1 bg-info-light p-15" style="position: relative">
                @include('web.default.course.learningPage.components.content')
            </div>

            <div class="learning-page-tabs show">
                <ul class="nav nav-tabs py-15 d-flex align-items-center justify-content-around" id="tabs-tab"
                    role="tablist">
                    <li class="nav-item">
                        {{-- {{dd($sessionChapters[0]->sessions[0])}} --}}
                        <a data-type="session" data-id="{{ $sessionChapters[0]->sessions[0]->id }}" class="tab-item-2 position-relative font-14 d-flex align-items-center active" id="content-tab"
                            data-toggle="tab" href="#content" role="tab" aria-controls="content" aria-selected="true">
                            <i class="learning-page-tabs-icons mr-5">
                                @include('web.default.panel.includes.sidebar_icons.webinars')
                            </i>
                            <span class="learning-page-tabs-link-text">Class</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="position-relative font-14 d-flex align-items-centera" id="material-tab"
                           data-toggle="tab" href="#material" role="tab" aria-controls="material"
                           aria-selected="false">
                            <i class="learning-page-tabs-icons mr-5">
                                @include('web.default.panel.includes.sidebar_icons.webinars')
                            </i>
                            <span class="learning-page-tabs-link-text">Material</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="position-relative font-14 d-flex align-items-center" id="quizzes-tab" data-toggle="tab"
                            href="#quizzes" role="tab" aria-controls="quizzes" aria-selected="false">
                            <i class="learning-page-tabs-icons mr-5">
                                @include('web.default.panel.includes.sidebar_icons.quizzes')
                            </i>
                            <span class="learning-page-tabs-link-text">{{ trans('quiz.quizzes') }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="position-relative font-14 d-flex align-items-center" id="certificates-tab"
                            data-toggle="tab" href="#certificates" role="tab" aria-controls="certificates"
                            aria-selected="false">
                            <i class="learning-page-tabs-icons mr-5">
                                @include('web.default.panel.includes.sidebar_icons.certificate')
                            </i>
                            <span class="learning-page-tabs-link-text">{{ trans('panel.certificates') }}</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content h-100" id="nav-tabContent">
                    <div class="pb-20 tab-pane fade show active h-100" id="content" role="tabpanel"
                        aria-labelledby="content-tab">
                        @include('web.default.course.learningPage.components.content_tab.index')
                    </div>

                    <div class="pb-20 tab-pane fade h-100" id="material" role="tabpanel"
                        aria-labelledby="material-tab">
                        @include('web.default.course.learningPage.components.content_tab.material')
                    </div>

                    {{-- <div class="pb-20 tab-pane fade show active h-100" id="record" role="tabpanel"
                    aria-labelledby="record-tab">
                   @include('web.default.course.learningPage.components.content_tab.record')
               </div> --}}

                    <div class="pb-20 tab-pane fade  h-100" id="quizzes" role="tabpanel" aria-labelledby="quizzes-tab">
                        @include('web.default.course.learningPage.components.quiz_tab.index')
                    </div>

                    <div class="pb-20 tab-pane fade  h-100" id="certificates" role="tabpanel"
                        aria-labelledby="certificates-tab">
                        @include('web.default.course.learningPage.components.certificate_tab.index')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/video/video.min.js"></script>
    <script src="/assets/default/vendors/video/youtube.min.js"></script>
    <script src="/assets/default/vendors/video/vimeo.js"></script>

    <script>
        var defaultItemType = '{{ request()->get('type') }}'
        var defaultItemId = '{{ request()->get('item') }}'

        var courseUrl = '{{ $course->getUrl() }}';

        // lang
        var pleaseWaitForTheContentLang = '{{ trans('update.please_wait_for_the_content_to_load') }}';
        var downloadTheFileLang = '{{ trans('update.download_the_file') }}';
        var downloadLang = '{{ trans('home.download') }}';
        var showHtmlFileLang = '{{ trans('update.show_html_file') }}';
        var showLang = '{{ trans('update.show') }}';
        var sessionIsLiveLang = '{{ trans('update.session_is_live') }}';
        var youCanJoinTheLiveNowLang = '{{ trans('update.you_can_join_the_live_now') }}';
        var joinTheClassLang = '{{ trans('update.join_the_class') }}';
        var coursePageLang = '{{ trans('update.course_page') }}';
        var quizPageLang = '{{ trans('update.quiz_page') }}';
        var sessionIsNotStartedYetLang = '{{ trans('update.session_is_not_started_yet') }}';
        var thisSessionWillBeStartedOnLang = '{{ trans('update.this_session_will_be_started_on') }}';
        var sessionIsFinishedLang = '{{ trans('update.session_is_finished') }}';
        var sessionIsFinishedHintLang = '{{ trans('update.this_session_is_finished_You_cant_join_it') }}';
        var goToTheQuizPageForMoreInformationLang = '{{ trans('update.go_to_the_quiz_page_for_more_information') }}';
        var downloadCertificateLang = '{{ trans('update.download_certificate') }}';
        var enjoySharingYourCertificateWithOthersLang =
            '{{ trans('update.enjoy_sharing_your_certificate_with_others') }}';
        var attachmentsLang = '{{ trans('public.attachments') }}';
        var checkAgainLang = '{{ trans('update.check_again') }}';
        var learningToggleLangSuccess = '{{ trans('public.course_learning_change_status_success') }}';
        var learningToggleLangError = '{{ trans('public.course_learning_change_status_error') }}';
    </script>
    <script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs"
        data-app-key="v5gxvm7qj1ku9la"></script>

    <script src="/assets/default/js/parts/video_player_helpers.min.js"></script>
    <script src="/assets/learning_page/scripts.min.js"></script>
@endpush

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    const getDays = (year, month) => {
        return new Date(year, month, 0).getDate();
    };

    const d = new Date();

    const month = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]

    const days = getDays(new Date().getFullYear(), month[d.getMonth()]);
    $(document).ready(function() {
        // $('#loader').addClass('loaded');

        const noClass = document.getElementById("noClass");
        const blueID = document.getElementById("blueID");
        if (d.getDate() == 29 || d.getDate() == 30 || d.getDate() == 31) {
            // noClass.addEventListener("transitionend", loop);
            blueID.style.filter = 'blur(10px)';
            noClass.style.display = 'block';
            // function loop() {
            //     if (noClass.style.opacity != "1") {
            //         noClass.style.opacity = 1;
            //     } else {
            //         setTimeout(() => noClass.style.opacity = 0, 2000);
            //     }
            // }

            // setTimeout(loop);
        }
        $("#blueID").bind("click", function() {
            blueID.style.filter = 'blur(0px)';
            noClass.style.display = 'none';
        });
    });
</script>
