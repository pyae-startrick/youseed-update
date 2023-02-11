<?php
if (empty($authUser) and auth()->check()) {
    $authUser = auth()->user();
}
?>

<div id="navbarVacuum"></div>
<nav id="navbar" class="navbar navbar-expand-lg navbar-light">
    <div class="<?php echo e((!empty($isPanel) and $isPanel) ? 'container-fluid' : 'container'); ?>">
        <div class="d-flex align-items-center justify-content-between w-100">

            <a class="navbar-brand navbar-order mr-0" href="/">
                <?php if(!empty($generalSettings['logo'])): ?>
                    <img src="<?php echo e($generalSettings['logo']); ?>" class="img-cover" alt="site logo">
                <?php endif; ?>
            </a>

            <button class="navbar-toggler navbar-order" type="button" id="navbarToggle">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="mx-lg-30 d-none d-lg-flex flex-grow-1 navbar-toggle-content " id="navbarContent">
                <div class="navbar-toggle-header text-right d-lg-none">
                    <button class="btn-transparent" id="navbarClose">
                        <i data-feather="x" width="32" height="32"></i>
                    </button>
                </div>

                <ul class="navbar-nav mr-auto d-flex align-items-center">
                    

                    
                </ul>
            </div>

            <div class="nav-icons-or-start-live navbar-order">

                <a href="<?php echo e(empty($authUser) ? '/login' : ($authUser->isAdmin() ? '/admin/webinars/create' : ($authUser->isUser() ? '/become-instructor' : '/panel/webinars/new'))); ?>"
                    class="d-none d-lg-flex btn btn-sm btn-primary nav-start-a-live-btn">
                    <?php echo e((empty($authUser) or !$authUser->isUser()) ? trans('navbar.start_a_live_class') : ($authUser->isUser() ? trans('site.become_instructor') : '')); ?>

                </a>

                <a href="<?php echo e(empty($authUser) ? '/login' : ($authUser->isUser() ? '/become-instructor' : '/panel/webinars/new')); ?>"
                    class="d-flex d-lg-none text-primary nav-start-a-live-btn font-14">
                    <?php echo e((empty($authUser) or !$authUser->isUser()) ? trans('navbar.start_a_live_class') : ($authUser->isUser() ? trans('site.become_instructor') : '')); ?>

                </a>

                <div class="d-none nav-notify-cart-dropdown top-navbar ">
                    

                    

                    
                </div>

            </div>
        </div>
    </div>
</nav>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/js/parts/navbar.min.js"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/includes/navbar.blade.php ENDPATH**/ ?>