<?php $__env->startPush('libraries_top'); ?>
    <link rel="stylesheet" href="/assets/admin/vendor/owl.carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/admin/vendor/owl.carousel/owl.theme.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


    <section class="section">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="hero text-white hero-bg-image hero-bg"
                    data-background="<?php echo e(!empty(getPageBackgroundSettings('admin_dashboard')) ? getPageBackgroundSettings('admin_dashboard') : ''); ?>">
                    <div class="hero-inner">
                        <h2><?php echo e(trans('admin/main.welcome')); ?>, <?php echo e($authUser->full_name); ?>!</h2>

                        <div class="d-flex flex-column flex-lg-row align-items-center justify-content-between">
                            

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            


            

            
        </div>

        


        


        <div class="row">

            

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_general_dashboard_recent_webinars')): ?>
                <?php if(!empty($recentWebinars)): ?>
                    <div class="col-md-4">
                        <div class="card card-hero">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5>Upcoming Class</h5>
                                <div class="card-description"><?php echo e($recentWebinars['pendingReviews']); ?>

                                    <?php echo e(trans('admin/main.pending_review')); ?></div>
                            </div>
                            <div class="card-body p-0">
                                <div class="tickets-list">
                                    <?php $__currentLoopData = $recentWebinars['webinars']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="/admin/webinars/<?php echo e($webinar->id); ?>/edit" class="ticket-item">
                                            <div class="ticket-title">
                                                <h4><?php echo e($webinar->title); ?></h4>
                                            </div>

                                            <div class="ticket-info">
                                                <div><?php echo e($webinar->teacher->full_name); ?></div>
                                                <div class="bullet"></div>
                                                <?php switch($webinar->status):
                                                    case (\App\Models\Webinar::$active): ?>
                                                        <span class="text-success"><?php echo e(trans('admin/main.publish')); ?></span>
                                                        
                                                    <?php break; ?>

                                                    <?php case (\App\Models\Webinar::$isDraft): ?>
                                                        <span class="text-dark"><?php echo e(trans('admin/main.is_draft')); ?></span>
                                                    <?php break; ?>

                                                    <?php case (\App\Models\Webinar::$pending): ?>
                                                        <span class="text-warning"><?php echo e(trans('admin/main.waiting')); ?></span>
                                                    <?php break; ?>

                                                    <?php case (\App\Models\Webinar::$inactive): ?>
                                                        <span class="text-danger"><?php echo e(trans('public.rejected')); ?></span>
                                                    <?php break; ?>
                                                <?php endswitch; ?>
                                            </div>
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <a href="/admin/webinars?type=webinar" class="ticket-item ticket-more">
                                        <?php echo e(trans('admin/main.view_all')); ?> <i class="fas fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            
        </div>

        
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/chartjs/chart.min.js"></script>
    <script src="/assets/admin/vendor/owl.carousel/owl.carousel.min.js"></script>

    <script src="/assets/admin/js/dashboard.min.js"></script>

    <script>
        (function($) {
            "use strict";

            <?php if(!empty($getMonthAndYearSalesChart)): ?>
                makeStatisticsChart('saleStatisticsChart', saleStatisticsChart, 'Sale', <?php echo json_encode($getMonthAndYearSalesChart['labels'], 15, 512) ?>,
                    <?php echo json_encode($getMonthAndYearSalesChart['data'], 15, 512) ?>);
            <?php endif; ?>

            <?php if(!empty($usersStatisticsChart)): ?>
                makeStatisticsChart('usersStatisticsChart', usersStatisticsChart, 'Users', <?php echo json_encode($usersStatisticsChart['labels'], 15, 512) ?>,
                    <?php echo json_encode($usersStatisticsChart['data'], 15, 512) ?>);
            <?php endif; ?>

        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>