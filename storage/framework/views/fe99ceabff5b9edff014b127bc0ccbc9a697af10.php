<?php $__env->startSection('content'); ?>
    <section style="padding-top:60px;padding-bottom: 150px; ">
        <div class="container">
            <h3 class="privacy-h3" style="text-align: center;margin-bottom: 45px;font-size: 30px;">
                <?php echo e(trans('home.cancellation-and-refund-policy')); ?></h3>
            <div style="width: 40px;background-color:#86c739;height: 2px;margin: auto;"></div>
            <div class="privacy-img" style="width: 21%;margin: auto;margin-top: 45px;">
                <img src="/assets/default/img/home/cancel.png" alt="" style="width:100%">
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                    <?php echo e(trans('home.no-refund-and-no-cancellation-policy')); ?>

                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    <?php echo e(trans('home.no-refund-and-no-cancellation-policy-desc')); ?>


                </p>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() . '.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/pages/cancellation.blade.php ENDPATH**/ ?>