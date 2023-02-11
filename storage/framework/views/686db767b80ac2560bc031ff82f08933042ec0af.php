<?php
$userLanguages = !empty($generalSettings['site_language']) ? [$generalSettings['site_language'] => getLanguages($generalSettings['site_language'])] : [];

if (!empty($generalSettings['user_languages']) and is_array($generalSettings['user_languages'])) {
    $userLanguages = getLanguages($generalSettings['user_languages']);
}

$localLanguage = [];

foreach ($userLanguages as $key => $userLanguage) {
    $localLanguage[localeToCountryCode($key)] = $userLanguage;
}

?>

<div class="top-navbar d-flex border-bottom" style="background: #F1F1F1BF;border-bottom: 1px solid #F1F1F1BF !important;">
    <div class="container d-flex justify-content-between flex-column flex-lg-row">
        <div
            class="top-contact-box border-bottom d-flex flex-column flex-md-row align-items-center justify-content-center">

            <div class="d-flex align-items-center justify-content-center">
                <?php if(!empty($generalSettings['site_phone'])): ?>
                    <span class="d-flex align-items-center py-10 py-lg-0 text-dark-blue font-14">
                        <i data-feather="phone" width="20" height="20" class="mr-10"></i>
                        <?php echo e($generalSettings['site_phone']); ?>

                    </span>
                <?php endif; ?>

                <?php if(!empty($generalSettings['site_email'])): ?>
                    <div class="border-left mx-5 mx-lg-15 h-100"></div>

                    <span class="d-flex align-items-center py-10 py-lg-0 text-dark-blue font-14">
                        <i data-feather="mail" width="20" height="20" class="mr-10"></i>
                        <?php echo e($generalSettings['site_email']); ?>

                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="xs-w-100 d-flex align-items-center justify-content-between ">
            <div class="d-flex">

                <?php echo $__env->make(getTemplate() . '.includes.notification-dropdown', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <?php if(!empty($authUser)): ?>


                <div class="dropdown">
                    <a href="#!" class="navbar-user d-flex align-items-center ml-50 dropdown-toggle" type="button"
                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo e($authUser->getAvatar()); ?>" class="rounded-circle"
                            alt="<?php echo e($authUser->full_name); ?>">
                        <span class="font-16 user-name ml-10 text-dark-blue font-14"><?php echo e($authUser->full_name); ?></span>
                    </a>

                    <div class="dropdown-menu user-profile-dropdown" aria-labelledby="dropdownMenuButton">
                        <div class="d-md-none border-bottom mb-20 pb-10 text-right">
                            <i class="close-dropdown" data-feather="x" width="32" height="32" class="mr-10"></i>
                        </div>

                        <a class="dropdown-item" href="<?php echo e($authUser->isAdmin() ? '/admin' : '/panel'); ?>">
                            <img src="/assets/default/img/icons/sidebar/dashboard.svg" width="25" alt="nav-icon">
                            <span class="font-14 text-dark-blue"><?php echo e(trans('public.my_panel')); ?></span>
                        </a>
                        <?php if($authUser->isTeacher() or $authUser->isOrganization()): ?>
                            <a class="dropdown-item" href="<?php echo e($authUser->getProfileUrl()); ?>">
                                <img src="/assets/default/img/icons/profile.svg" width="25" alt="nav-icon">
                                <span class="font-14 text-dark-blue"><?php echo e(trans('public.my_profile')); ?></span>
                            </a>
                        <?php endif; ?>
                        <a class="dropdown-item" href="/logout">
                            <img src="/assets/default/img/icons/sidebar/logout.svg" width="25" alt="nav-icon">
                            <span class="font-14 text-dark-blue"><?php echo e(trans('panel.log_out')); ?></span>
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <div class="d-flex align-items-center ml-md-50">
                    <a href="/login" class="py-5 px-10 mr-10 text-dark-blue font-14"><?php echo e(trans('auth.login')); ?></a>
                    <a href="/register" class="py-5 px-10 text-dark-blue font-14"><?php echo e(trans('auth.register')); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php $__env->startPush('scripts_bottom'); ?>
    <link href="/assets/default/vendors/flagstrap/css/flags.css" rel="stylesheet">
    <script src="/assets/default/vendors/flagstrap/js/jquery.flagstrap.min.js"></script>
    <script src="/assets/default/js/parts/top_nav_flags.min.js"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/includes/top_nav.blade.php ENDPATH**/ ?>