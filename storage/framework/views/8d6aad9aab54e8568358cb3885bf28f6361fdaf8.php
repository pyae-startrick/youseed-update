<?php $__env->startSection('content'); ?>
    <section style="padding-top:60px;padding-bottom: 150px; ">
        <div class="container">
            <h3 class="privacy-h3" style="text-align: center;margin-bottom: 45px;font-size: 30px;"> Privacy & Policy</h3>
            <div style="width: 40px;background-color:#86c739;height: 2px;margin: auto;"></div>
            <div class="privacy-img" style="width: 21%;margin: auto;margin-top: 45px;">
                <img src="/assets/default/img/home/provacy.png" alt="" style="width:100%">
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   <?php echo e(trans('home.your-privacy')); ?>

                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    <?php echo e(trans('home.your-privacy-desc')); ?>

                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   <?php echo e(trans('home.your-consent')); ?>

                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    <?php echo e(trans('home.your-consent-desc')); ?>

                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   <?php echo e(trans('home.communication-&-marketing')); ?>

                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    <?php echo e(trans('home.communication-&-marketing-desc')); ?>

                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   <?php echo e(trans('home.what-are-cookies')); ?>

                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    <?php echo e(trans('home.what-are-cookies-desc')); ?>

                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   <?php echo e(trans('home.site-statistics')); ?>

                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    <?php echo e(trans('home.site-statistics-desc')); ?>

                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   <?php echo e(trans('home.disclosures-of-your-information')); ?>

                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    <?php echo e(trans('home.disclosures-of-your-information-desc')); ?>

                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   <?php echo e(trans('home.third-party-sites')); ?>

                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    <?php echo e(trans('home.third-party-sites-desc')); ?>

                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   <?php echo e(trans('home.checking-your-details')); ?>

                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    <?php echo e(trans('home.checking-your-details-desc')); ?>

                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   <?php echo e(trans('home.contacting-us')); ?>

                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    <?php echo e(trans('home.contacting-us-desc')); ?>

                </p>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() . '.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/pages/policy.blade.php ENDPATH**/ ?>