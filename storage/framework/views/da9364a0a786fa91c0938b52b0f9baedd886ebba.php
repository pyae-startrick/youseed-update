<button type="button" class="sidebar-close">
    <i class="fa fa-times"></i>
</button>

<div class="navbar-bg"></div>

<nav class="navbar navbar-expand-lg main-navbar">

    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">

    <li class="dropdown dropdown-list-toggle">
                <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
                    <i class="fa fa-info-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    <div class="dropdown-list-icons mb-0" height="150px">
                            
                                <div class="dropdown-item-desc align-items-center p-4 ">
                                   YouSeed LMS Version 1
                                   <div class="time text-primary">All rights reserved for <a style="font-size: 1rem;color:#46aa52" href="https://startrick.com" target="_blank" rel="noopener noreferrer"> Startrick.</a></div>
                                </div>
                            
                    </div>
                </div>
            </li>

        

        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?php echo e($authUser->getAvatar()); ?>" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block"><?php echo e($authUser->full_name); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">

                 <a href="/" class="dropdown-item has-icon">
                    <i class="fas fa-globe"></i> <?php echo e(trans('admin/main.show_website')); ?>

                </a>

                <a href="/admin/users/<?php echo e($authUser->id); ?>/edit" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> <?php echo e(trans('admin/main.change_password')); ?>

                </a>

                <div class="dropdown-divider"></div>
                <a href="/admin/logout" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> <?php echo e(trans('admin/main.logout')); ?>

                </a>
            </div>
        </li>
    </ul>
</nav>
<?php /**PATH /Users/admin/Code/lms/resources/views/admin/includes/navbar.blade.php ENDPATH**/ ?>