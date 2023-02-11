<?php
if (empty($authUser) and auth()->check()) {
    $authUser = auth()->user();
}
$userLanguages = !empty($generalSettings['site_language']) ? [$generalSettings['site_language'] => getLanguages($generalSettings['site_language'])] : [];

if (!empty($generalSettings['user_languages']) and is_array($generalSettings['user_languages'])) {
    $userLanguages = getLanguages($generalSettings['user_languages']);
}

$localLanguage = [];

foreach ($userLanguages as $key => $userLanguage) {
    $localLanguage[localeToCountryCode($key)] = $userLanguage;
}
?>



<nav id="navbar" class="navbar navbar-expand-lg"
    style="background-color: #F1F1F1BF;position: unset;box-shadow:0!important;padding-top: 15px;">
    <div class="<?php echo e((!empty($isPanel) and $isPanel) ? 'container-fluid' : ''); ?>" style="margin: auto!important">
        <div class="d-flex align-items-center justify-content-between w-100">

            <a class="navbar-brand navbar-order mr-0" href="/">
                <?php if(!empty($generalSettings['logo'])): ?>
                    <img src="<?php echo e($generalSettings['logo']); ?>" class="img-cover" alt="site logo">
                <?php endif; ?>
            </a>



            <div class="mx-lg-30 d-none d-lg-flex flex-grow-1 navbar-toggle-content " id="navbarContent"
                style="margin-left:0px!important;">
                <div class="navbar-toggle-header text-right d-lg-none">
                    <button class="btn-transparent" id="navbarClose">
                        <i data-feather="x" width="32" height="32"></i>
                    </button>
                </div>

                <ul class="navbar-nav mr-auto d-flex align-items-center m-auto font-weight-bold">

                    <li class="nav-item about">
                        <a id="navbarClose" class="nav-link" href="/#about_us"
                            style="color: #46AA52;font-size: 13px;"><?php echo e(trans('home.about_us')); ?></a>
                    </li>
                    <li class="nav-item intro">
                        <a id="navbarClose" class="nav-link" href="/#course_intro" style="color: #46AA52;font-size: 13px;">
                            <?php echo e(trans('home.course_introduction')); ?>

                        </a>
                    </li>
                    <li class="nav-item plan">
                        <a id="navbarClose" class="nav-link" href="/#language_plan"
                            style="color: #46AA52;font-size: 13px;"><?php echo e(trans('home.language_plan')); ?></a>
                    </li>
                    <li class="nav-item why">
                        <a id="navbarClose" class="nav-link" href="/#why_choose"
                            style="color: #46AA52;font-size: 13px;"><?php echo e(trans('home.why_choose_us')); ?></a>
                    </li>
                    <li class="nav-item feedback">
                        <a id="navbarClose" class="nav-link" href="/#parent_feedback"
                            style="color: #46AA52;font-size: 13px;"><?php echo e(trans('home.praise_from_parents')); ?></a>
                    </li>

                    
                    <?php if(!empty($authUser)): ?>
                        <li class="nav-item hide-desktop">
                            <a id="navbarClose" class="nav-link" href="<?php echo e($authUser->isAdmin() ? '/admin' : '/panel'); ?>"
                                style="color: #46AA52;font-size: 13px;"><?php echo e(trans('public.my_panel')); ?></a>
                        </li>
                        
                        <li class="nav-item hide-desktop">
                            <a id="navbarClose" class="nav-link" href="/logout"
                                style="color: #46AA52;font-size: 13px;"><?php echo e(trans('panel.log_out')); ?></a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item hide-desktop">
                            <a id="navbarClose" class="nav-link" href="/login"
                                style="color: #46AA52;font-size: 13px;"><?php echo e(trans('auth.login')); ?></a>
                        </li>
                        <li class="nav-item hide-desktop">
                            <a id="navbarClose" class="nav-link" href="/register"
                                style="color: #46AA52;font-size: 13px;"><?php echo e(trans('auth.register')); ?></a>
                        </li>
                    <?php endif; ?>
                    
                </ul>
            </div>

            <div style="z-index: 1;"
                class="xs-w-100 d-flex align-items-center justify-content-between position-relative mobile-end">
                <div class="d-flex">
                    


                    <form action="/locale" method="post" style="align-self: center;" class=" mr-15 mx-md-20">
                        <?php echo e(csrf_field()); ?>


                        <input id="locale" type="hidden" name="locale">

                        <div class="language-select">
                            <div id="localItems"
                                data-selected-country="<?php echo e(localeToCountryCode(mb_strtoupper(app()->getLocale()))); ?>"
                                data-countries='<?php echo e(json_encode($localLanguage)); ?>'></div>
                        </div>
                    </form>

                    <div class="dropdown">
                        <button type="button" class="btn btn-transparent dropdown-toggle" id="navbarAuth"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="user" width="20" height="20" class="mr-10"></i>
                        </button>

                        <div class="dropdown-menu" aria-labelledby="navbarShopingCart"
                            style="min-width: 184px!important;">
                            <div class="d-md-none border-bottom mb-20 pb-10 text-right">
                                <i class="close-dropdown" data-feather="x" width="32" height="32"
                                    class="mr-10"></i>
                            </div>
                            <div class="h-100">
                                <div class="navbar-shopping-cart h-100" data-simplebar>
                                    <?php if(!empty($authUser)): ?>


                                        <div class="dropdown">
                                            <div class="d-md-none border-bottom mb-20 pb-10 text-right">
                                                <i class="close-dropdown" data-feather="x" width="32" height="32"
                                                    class="mr-10"></i>
                                            </div>

                                            <a class="dropdown-item"
                                                href="<?php echo e($authUser->isAdmin() ? '/admin' : '/panel'); ?>">
                                                <span
                                                    class="font-14 text-dark-blue"><?php echo e(trans('public.my_panel')); ?></span>
                                            </a>
                                            
                                            <a class="dropdown-item" href="/logout">
                                                <span
                                                    class="font-14 text-dark-blue"><?php echo e(trans('panel.log_out')); ?></span>
                                            </a>
                                        </div>
                                </div>
                            <?php else: ?>
                                <div class="align-items-center dropdown">
                                    <a href="/login"
                                        class="dropdown-item py-5 px-10 mr-10 text-dark-blue font-14"><?php echo e(trans('auth.login')); ?></a>
                                    <a href="/register"
                                        class="dropdown-item py-5 px-10 text-dark-blue font-14"><?php echo e(trans('auth.register')); ?></a>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>

                <button class="navbar-toggler navbar-order" type="button" id="navbarToggle">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="nav-link" href="https://shop.youseed.com.my" target="_blank"
                style="display: flex;
                margin-top: 5px;">
                <i data-feather="shopping-cart" width="20" height="20" class="mr-10"></i>
                
            </a>
            </div>
        </div>
    </div>
    </div>
</nav>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/js/parts/navbar.min.js"></script>

    <link href="/assets/default/vendors/flagstrap/css/flags.css" rel="stylesheet">
    <script src="/assets/default/vendors/flagstrap/js/jquery.flagstrap.min.js"></script>
    <script src="/assets/default/js/parts/top_nav_flags.min.js"></script>

    <script>
        $(function () {
            $(document).scroll(function () {
                var $nav = $("#navbar");
                $nav.toggleClass('is-floating', $(this).scrollTop() > $nav.height());
                $nav.toggleClass('no-padding', $(this).scrollTop() > $nav.height());

            });
        });
        $( document ).ready(function() {
            $(window).scroll(function() { 
                var Scroll = $(window).scrollTop() + 1, 
                AboutUsOffset = $('#about_us').offset().top, 
                CourseIntroOffset = $('#course_intro').offset().top,
                LanguagePlanOffset = $('#language_plan').offset().top,
                WhyChooseOffset = $('#why_choose').offset().top,
                FeedbackOffset = $('#parent_feedback').offset().top;

                if (Scroll >= AboutUsOffset) { 
                    $(".about").addClass("nav-active"); 
                } else { 
                    $(".about").removeClass("nav-active"); 
                }

                if (Scroll >= CourseIntroOffset) { 
                    $(".intro").addClass("nav-active"); 
                    $(".about").removeClass("nav-active");
                } else {
                    $(".intro").removeClass("nav-active"); 
                }

                if (Scroll >= LanguagePlanOffset) { 
                    $(".plan").addClass("nav-active"); 
                    $(".intro").removeClass("nav-active");
                } else {
                    $(".plan").removeClass("nav-active"); 
                }

                if (Scroll >= WhyChooseOffset) { 
                    $(".why").addClass("nav-active"); 
                    $(".plan").removeClass("nav-active");
                } else {
                    $(".why").removeClass("nav-active"); 
                }

                if (Scroll >= FeedbackOffset) { 
                    $(".feedback").addClass("nav-active"); 
                    $(".why").removeClass("nav-active");
                } else {
                    $(".feedback").removeClass("nav-active"); 
                }
            });
        });
            $( '.navbar-nav a' ).on('click', 
                function () {
                $( '.navbar-nav' ).find( 'li.nav-active' ).removeClass( 'nav-active' );
                $( this ).parent( 'li' ).addClass( 'nav-active' );
            });
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/includes/navbar_new.blade.php ENDPATH**/ ?>