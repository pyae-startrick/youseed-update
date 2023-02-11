<?php
$getPanelSidebarSettings = getPanelSidebarSettings();
?>

<div class="xs-panel-nav d-flex d-lg-none justify-content-between py-5 px-15">
    <div class="user-info d-flex align-items-center justify-content-between">
        <div class="user-avatar">
            <img src="<?php echo e($authUser->getAvatar()); ?>" class="img-cover" alt="<?php echo e($authUser->full_name); ?>">
        </div>

        <div class="user-name ml-15">
            <h3 class="font-16 font-weight-bold"><?php echo e($authUser->full_name); ?></h3>
        </div>
    </div>

    <button
        class="sidebar-toggler btn-transparent d-flex flex-column-reverse justify-content-center align-items-center p-5 rounded-sm sidebarNavToggle"
        type="button" style="padding: 10px !important;">
        
        <i data-feather="menu" width="16" height="16"></i>
    </button>
</div>

<div style="height: 125vh!important;" class="panel-sidebar pt-50 pb-25 px-25" id="panelSidebar">
    <button class="btn-transparent panel-sidebar-close sidebarNavToggle">
        <i data-feather="x" width="24" height="24"></i>
    </button>

    <div class="user-info d-flex align-items-center flex-row flex-lg-column justify-content-lg-center">
        <a href="/panel" class="user-avatar">
            <img src="<?php echo e($authUser->getAvatar()); ?>" class="img-cover" alt="<?php echo e($authUser->full_name); ?>">
        </a>

        <div class="d-flex flex-column align-items-center justify-content-center">
            <a href="/panel" class="user-name mt-15">
                <h3 class="font-16 font-weight-bold text-center"><?php echo e($authUser->full_name); ?></h3>
            </a>

            <?php if($authUser->isTeacher()): ?>
                <span class="create-new-user mt-10">Teacher</span>
            <?php else: ?>
                <span class="create-new-user mt-10">Student</span>
                <span class="create-new-user mt-10">ID: <?php echo e($authUser->student_id); ?></span>
            <?php endif; ?>
        </div>
    </div>

    

    <ul class="sidebar-menu pt-10 <?php if(!empty($authUser->userGroup)): ?> has-user-group <?php endif; ?> <?php if(empty($getPanelSidebarSettings) or empty($getPanelSidebarSettings['background'])): ?> without-bottom-image <?php endif; ?>"
        data-simplebar <?php if(!empty($isRtl) and $isRtl): ?> data-simplebar-direction="rtl" <?php endif; ?>>

        <li class="sidenav-item <?php echo e(request()->is('panel') ? 'sidenav-item-active' : ''); ?>">
            <a href="/panel" class="d-flex align-items-center">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500">Welcome</span>
            </a>
        </li>

        <?php if($authUser->isOrganization()): ?>
            <li
                class="sidenav-item <?php echo e((request()->is('panel/instructors') or request()->is('panel/manage/instructors*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#instructorsCollapse" role="button"
                    aria-expanded="false" aria-controls="instructorsCollapse">
                    <span class="sidenav-item-icon mr-10">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.teachers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500"><?php echo e(trans('public.instructors')); ?></span>
                </a>

                <div class="collapse <?php echo e((request()->is('panel/instructors') or request()->is('panel/manage/instructors*')) ? 'show' : ''); ?>"
                    id="instructorsCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="mt-5 <?php echo e(request()->is('panel/instructors/new') ? 'active' : ''); ?>">
                            <a href="/panel/manage/instructors/new"><?php echo e(trans('public.new')); ?></a>
                        </li>
                        <li class="mt-5 <?php echo e(request()->is('panel/manage/instructors') ? 'active' : ''); ?>">
                            <a href="/panel/manage/instructors"><?php echo e(trans('public.list')); ?></a>
                        </li>
                    </ul>
                </div>
            </li>

            <li
                class="sidenav-item <?php echo e((request()->is('panel/students') or request()->is('panel/manage/students*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#studentsCollapse" role="button"
                    aria-expanded="false" aria-controls="studentsCollapse">
                    <span class="sidenav-item-icon mr-10">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.students', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500"><?php echo e(trans('quiz.students')); ?></span>
                </a>

                <div class="collapse <?php echo e((request()->is('panel/students') or request()->is('panel/manage/students*')) ? 'show' : ''); ?>"
                    id="studentsCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="mt-5 <?php echo e(request()->is('panel/manage/students/new') ? 'active' : ''); ?>">
                            <a href="/panel/manage/students/new"><?php echo e(trans('public.new')); ?></a>
                        </li>
                        <li class="mt-5 <?php echo e(request()->is('panel/manage/students') ? 'active' : ''); ?>">
                            <a href="/panel/manage/students"><?php echo e(trans('public.list')); ?></a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>


        <?php if($authUser->isUser()): ?>
            <li class="sidenav-item <?php echo e(request()->is('panel/webinars/purchases') ? 'sidenav-item-active' : ''); ?>">
                <a href="/panel/webinars/purchases" class="d-flex align-items-center">
                    <span class="sidenav-item-icon mr-10">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.webinars', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">My Class</span>
                </a>
            </li>
        <?php else: ?>
        <li class="sidenav-item <?php echo e((request()->is('panel/webinars') or request()->is('panel/webinars/*')) ? 'sidenav-item-active' : ''); ?>">
            <a class="d-flex align-items-center" data-toggle="collapse" href="#webinarCollapse" role="button" aria-expanded="false" aria-controls="webinarCollapse">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.webinars', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500">Classes</span>
            </a>
            <div class="collapse <?php echo e((request()->is('panel/webinars') or request()->is('panel/webinars/*')) ? 'show' : ''); ?>"
                id="webinarCollapse">
                <ul class="sidenav-item-collapse">
                    <li class="mt-5 <?php echo e(request()->is('panel/webinars/new') ? 'active' : ''); ?>">
                        <a href="/panel/webinars/new">New Class</a>
                    </li>
                    <li class="mt-5 <?php echo e((request()->is('panel/webinars')) ? 'active' : ''); ?>">
                        <a href="/panel/webinars" class="d-flex align-items-center">
                            My Class
                        </a>
                    </li>

                    
                    
                </ul>
            </div>
        </li>
        <?php endif; ?>




        <li
            class="sidenav-item <?php echo e((request()->is('panel/quizzes') or request()->is('panel/quizzes/*')) ? 'sidenav-item-active' : ''); ?>">
            <a class="d-flex align-items-center" data-toggle="collapse" href="#quizzesCollapse" role="button"
                aria-expanded="false" aria-controls="quizzesCollapse">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.quizzes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500"><?php echo e(trans('panel.quizzes')); ?></span>
            </a>

            <div class="collapse <?php echo e((request()->is('panel/quizzes') or request()->is('panel/quizzes/*')) ? 'show' : ''); ?>"
                id="quizzesCollapse">
                <ul class="sidenav-item-collapse">
                    <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                        <li class="mt-5 <?php echo e(request()->is('panel/quizzes/new') ? 'active' : ''); ?>">
                            <a href="/panel/quizzes/new">New Quiz</a>
                        </li>
                        <li class="mt-5 <?php echo e(request()->is('panel/quizzes') ? 'active' : ''); ?>">
                            <a href="/panel/quizzes">Quizzes List</a>
                        </li>
                        <li class="mt-5 <?php echo e(request()->is('panel/quizzes/results') ? 'active' : ''); ?>">
                            <a href="/panel/quizzes/results">Student Results</a>
                        </li>
                    <?php endif; ?>
                    


                    <?php if($authUser->isUser()): ?>
                    <li class="mt-5 <?php echo e(request()->is('panel/quizzes/opens') ? 'active' : ''); ?>">
                        <a href="/panel/quizzes/opens">Take Quiz</a>
                    </li>
                    <li class="mt-5 <?php echo e(request()->is('panel/quizzes/my-results') ? 'active' : ''); ?>">
                        <a href="/panel/quizzes/my-results">My Results</a>
                    </li>
                    <?php endif; ?>

                    
                </ul>
            </div>
        </li>

        <li
            class="sidenav-item <?php echo e((request()->is('panel/certificates') or request()->is('panel/certificates/*')) ? 'sidenav-item-active' : ''); ?>">
            <a class="d-flex align-items-center" data-toggle="collapse" href="#certificatesCollapse" role="button"
                aria-expanded="false" aria-controls="certificatesCollapse">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.certificate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500"><?php echo e(trans('panel.certificates')); ?></span>
            </a>

            <div class="collapse <?php echo e((request()->is('panel/certificates') or request()->is('panel/certificates/*')) ? 'show' : ''); ?>"
                id="certificatesCollapse">
                <ul class="sidenav-item-collapse">
                    <?php if($authUser->isOrganization() || $authUser->isTeacher()): ?>
                        <li class="mt-5 <?php echo e(request()->is('panel/certificates') ? 'active' : ''); ?>">
                            <a href="/panel/certificates">Certificates List</a>
                        </li>
                        
                    <?php endif; ?>

                    

                    <?php if($authUser->isUser()): ?>
                    <li class="mt-5 <?php echo e(request()->is('panel/certificates/achievements') ? 'active' : ''); ?>">
                        <a href="/panel/certificates/achievements">Achievements</a>
                    </li>
                    <?php endif; ?>

                    

                </ul>
            </div>
        </li>


        

        <?php if($authUser->isOrganization()): ?>
            <li
                class="sidenav-item <?php echo e((request()->is('panel/noticeboard') or request()->is('panel/noticeboard/*')) ? 'sidenav-item-active' : ''); ?>">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#noticeboardCollapse"
                    role="button" aria-expanded="false" aria-controls="noticeboardCollapse">
                    <span class="sidenav-item-icon mr-10">
                        <?php echo $__env->make('web.default.panel.includes.sidebar_icons.noticeboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </span>

                    <span class="font-14 text-dark-blue font-weight-500"><?php echo e(trans('panel.noticeboard')); ?></span>
                </a>

                <div class="collapse <?php echo e((request()->is('panel/noticeboard') or request()->is('panel/noticeboard/*')) ? 'show' : ''); ?>"
                    id="noticeboardCollapse">
                    <ul class="sidenav-item-collapse">
                        <li class="mt-5 <?php echo e(request()->is('panel/noticeboard') ? 'active' : ''); ?>">
                            <a href="/panel/noticeboard"><?php echo e(trans('public.history')); ?></a>
                        </li>

                        <li class="mt-5 <?php echo e(request()->is('panel/noticeboard/new') ? 'active' : ''); ?>">
                            <a href="/panel/noticeboard/new"><?php echo e(trans('public.new')); ?></a>
                        </li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        

        

        <li class="sidenav-item <?php echo e((request()->is('panel/setting') or request()->is('panel/setting/*')) ? 'sidenav-item-active' : ''); ?>">
            <a href="/panel/setting" class="d-flex align-items-center">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.setting', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500">Profile Settings</span>
            </a>
        </li>

        

        <li class="sidenav-item">
            <a href="/logout" class="d-flex align-items-center">
                <span class="sidenav-item-icon mr-10">
                    <?php echo $__env->make('web.default.panel.includes.sidebar_icons.logout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </span>
                <span class="font-14 text-dark-blue font-weight-500"><?php echo e(trans('panel.log_out')); ?></span>
            </a>
        </li>
    </ul>

    
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/panel/includes/sidebar.blade.php ENDPATH**/ ?>