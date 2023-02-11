<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/learning_page/styles.css" />
    <link rel="stylesheet" href="/assets/default/vendors/video/video-js.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="learning-page">

        <?php echo $__env->make('web.default.course.learningPage.components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <img id="noClass" src="/assets/default/img/home/notification.png"
            style="width:27%;position: absolute;left:37%;z-index: 1;top: 18%;opacity: 1!important" alt="">
        
        <div id="blueID" class="d-flex position-relative">
            <div class="learning-page-content flex-grow-1 bg-info-light p-15" style="position: relative">
                <?php echo $__env->make('web.default.course.learningPage.components.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="learning-page-tabs show">
                <ul class="nav nav-tabs py-15 d-flex align-items-center justify-content-around" id="tabs-tab"
                    role="tablist">
                    <li class="nav-item">
                        
                        <a data-type="session" data-id="<?php echo e($sessionChapters[0]->sessions[0]->id); ?>" class="tab-item-2 position-relative font-14 d-flex align-items-center active" id="content-tab"
                            data-toggle="tab" href="#content" role="tab" aria-controls="content" aria-selected="true">
                            <i class="learning-page-tabs-icons mr-5">
                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.webinars', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </i>
                            <span class="learning-page-tabs-link-text">Class</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="position-relative font-14 d-flex align-items-centera" id="material-tab"
                           data-toggle="tab" href="#material" role="tab" aria-controls="material"
                           aria-selected="false">
                            <i class="learning-page-tabs-icons mr-5">
                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.webinars', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </i>
                            <span class="learning-page-tabs-link-text">Material</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="position-relative font-14 d-flex align-items-center" id="quizzes-tab" data-toggle="tab"
                            href="#quizzes" role="tab" aria-controls="quizzes" aria-selected="false">
                            <i class="learning-page-tabs-icons mr-5">
                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.quizzes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </i>
                            <span class="learning-page-tabs-link-text"><?php echo e(trans('quiz.quizzes')); ?></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="position-relative font-14 d-flex align-items-center" id="certificates-tab"
                            data-toggle="tab" href="#certificates" role="tab" aria-controls="certificates"
                            aria-selected="false">
                            <i class="learning-page-tabs-icons mr-5">
                                <?php echo $__env->make('web.default.panel.includes.sidebar_icons.certificate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </i>
                            <span class="learning-page-tabs-link-text"><?php echo e(trans('panel.certificates')); ?></span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content h-100" id="nav-tabContent">
                    <div class="pb-20 tab-pane fade show active h-100" id="content" role="tabpanel"
                        aria-labelledby="content-tab">
                        <?php echo $__env->make('web.default.course.learningPage.components.content_tab.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <div class="pb-20 tab-pane fade h-100" id="material" role="tabpanel"
                        aria-labelledby="material-tab">
                        <?php echo $__env->make('web.default.course.learningPage.components.content_tab.material', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    

                    <div class="pb-20 tab-pane fade  h-100" id="quizzes" role="tabpanel" aria-labelledby="quizzes-tab">
                        <?php echo $__env->make('web.default.course.learningPage.components.quiz_tab.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <div class="pb-20 tab-pane fade  h-100" id="certificates" role="tabpanel"
                        aria-labelledby="certificates-tab">
                        <?php echo $__env->make('web.default.course.learningPage.components.certificate_tab.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/video/video.min.js"></script>
    <script src="/assets/default/vendors/video/youtube.min.js"></script>
    <script src="/assets/default/vendors/video/vimeo.js"></script>

    <script>
        var defaultItemType = '<?php echo e(request()->get('type')); ?>'
        var defaultItemId = '<?php echo e(request()->get('item')); ?>'

        var courseUrl = '<?php echo e($course->getUrl()); ?>';

        // lang
        var pleaseWaitForTheContentLang = '<?php echo e(trans('update.please_wait_for_the_content_to_load')); ?>';
        var downloadTheFileLang = '<?php echo e(trans('update.download_the_file')); ?>';
        var downloadLang = '<?php echo e(trans('home.download')); ?>';
        var showHtmlFileLang = '<?php echo e(trans('update.show_html_file')); ?>';
        var showLang = '<?php echo e(trans('update.show')); ?>';
        var sessionIsLiveLang = '<?php echo e(trans('update.session_is_live')); ?>';
        var youCanJoinTheLiveNowLang = '<?php echo e(trans('update.you_can_join_the_live_now')); ?>';
        var joinTheClassLang = '<?php echo e(trans('update.join_the_class')); ?>';
        var coursePageLang = '<?php echo e(trans('update.course_page')); ?>';
        var quizPageLang = '<?php echo e(trans('update.quiz_page')); ?>';
        var sessionIsNotStartedYetLang = '<?php echo e(trans('update.session_is_not_started_yet')); ?>';
        var thisSessionWillBeStartedOnLang = '<?php echo e(trans('update.this_session_will_be_started_on')); ?>';
        var sessionIsFinishedLang = '<?php echo e(trans('update.session_is_finished')); ?>';
        var sessionIsFinishedHintLang = '<?php echo e(trans('update.this_session_is_finished_You_cant_join_it')); ?>';
        var goToTheQuizPageForMoreInformationLang = '<?php echo e(trans('update.go_to_the_quiz_page_for_more_information')); ?>';
        var downloadCertificateLang = '<?php echo e(trans('update.download_certificate')); ?>';
        var enjoySharingYourCertificateWithOthersLang =
            '<?php echo e(trans('update.enjoy_sharing_your_certificate_with_others')); ?>';
        var attachmentsLang = '<?php echo e(trans('public.attachments')); ?>';
        var checkAgainLang = '<?php echo e(trans('update.check_again')); ?>';
        var learningToggleLangSuccess = '<?php echo e(trans('public.course_learning_change_status_success')); ?>';
        var learningToggleLangError = '<?php echo e(trans('public.course_learning_change_status_error')); ?>';
    </script>
    <script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs"
        data-app-key="v5gxvm7qj1ku9la"></script>

    <script src="/assets/default/js/parts/video_player_helpers.min.js"></script>
    <script src="/assets/learning_page/scripts.min.js"></script>
<?php $__env->stopPush(); ?>

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
        // if (d.getDate() == 29 || d.getDate() == 30 || d.getDate() == 31) {
        //     // noClass.addEventListener("transitionend", loop);
        //     blueID.style.filter = 'blur(10px)';
        //     // function loop() {
        //     //     if (noClass.style.opacity != "1") {
        //     //         noClass.style.opacity = 1;
        //     //     } else {
        //     //         setTimeout(() => noClass.style.opacity = 0, 2000);
        //     //     }
        //     // }

        //     // setTimeout(loop);
        // }
    });
</script>

<?php echo $__env->make('web.default.layouts.app', ['appFooter' => false, 'appHeader' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/course/learningPage/index.blade.php ENDPATH**/ ?>