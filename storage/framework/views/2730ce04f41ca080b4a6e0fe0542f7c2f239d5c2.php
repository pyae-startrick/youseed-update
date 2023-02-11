<?php $__env->startPush('styles_top'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <section class="mt-md-25 mt-50">
        <div style="background-color: #43d477 !important;">

            <div style="padding: 20px 50px;"
                class="d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
                
                <h2 class="section-title" style="color: #fff">My Class</h2>

                
            </div>
        </div>
        <div class="webinar-mobile-padding" style="padding: 30px 50px;">
            <div class="row ">

                <?php if(!empty($webinars) and !$webinars->isEmpty()): ?>
                    <?php $__currentLoopData = $webinars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webinar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $lastSession = $webinar->lastSession();
                            $nextSession = $webinar->nextSession();
                            $isProgressing = false;
                            
                            if ($webinar->start_date <= time() and !empty($lastSession) and $lastSession->date > time()) {
                                $isProgressing = true;
                            }
                        ?>

                        <div class="col-12 col-xl-4 col-lg-4 col-md-6 mt-30">
                            
                            <div class="gradient-card" style="height: 620px!important;background-image: linear-gradient(#282828, white max(0rem, 26vh))!important;">

                                <div class="image-box" style="position: relative;">
                                    <?php if(!empty($webinar->getImage())): ?>
                                    <img src="<?php echo e($webinar->getImage()); ?>" class="img-cover" alt="">
<?php else: ?>
<img src="/assets/default/img/200x200.png" class="img-cover" alt="">

                                    <?php endif; ?>
                                    <div class="d-flex justify-content-between">

                                        <?php if($webinar->type == 'webinar'): ?>
                                            <?php if($webinar->start_date > time()): ?>
                                                <span style="position: absolute;top: 17px;"
                                                    class="badge badge-secondary"><?php echo e(trans('panel.not_conducted')); ?></span>
                                            <?php elseif($webinar->isProgressing()): ?>
                                                <span style="position: absolute;top: 17px;"
                                                    class="badge badge-primary"><?php echo e(trans('webinars.in_progress')); ?></span>
                                            <?php else: ?>
                                                <span style="position: absolute;top: 17px;"
                                                    class="badge badge-secondary"><?php echo e(trans('public.finished')); ?></span>
                                            <?php endif; ?>
                                        <?php elseif(!empty($webinar->downloadable)): ?>
                                            <span style="position: absolute;top: 17px;"
                                                class="badge badge-secondary"><?php echo e(trans('home.downloadable')); ?></span>
                                        <?php else: ?>
                                            <span style="position: absolute;top: 17px;"
                                                class="badge badge-secondary"><?php echo e(trans('webinars.' . $webinar->type)); ?></span>
                                        <?php endif; ?>

                                        <div style="position: absolute;top: 17px;right: 17px;">

                                            <span
                                                class="badge badge-white ml-10 status-badge-white"><?php echo e(trans('webinars.' . $webinar->type)); ?></span>
                                          
                                        </div>
                                    </div>
                                </div>

                                <div style="padding: 0 20px;" class="webinar-card-body w-100 d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="<?php echo e($webinar->getUrl()); ?>">
                                            <h3 style="color: #43d477" class="webinar-title font-weight-bold font-18">
                                                <?php echo e($webinar->title); ?>


                                            </h3>
                                        </a>


                                    </div>



                                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-auto">
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title font-weight-bold font-15">Class ID:</span>
                                            <span class="stat-value"><?php echo e($webinar->id); ?></span>
                                        </div>

                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span class="stat-title font-weight-bold font-15">Subject:</span>
                                            <span
                                                class="stat-value"><?php echo e(!empty($webinar->category_id) ? $webinar->category->title : ''); ?></span>
                                        </div>

                                        <?php if($webinar->type == 'webinar'): ?>
                                            <?php if($webinar->isProgressing() and !empty($nextSession)): ?>
                                                

                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span
                                                        class="stat-title font-weight-bold font-15"><?php echo e(trans('webinars.next_session_start_date')); ?>:</span>
                                                    <span
                                                        class="stat-value"><?php echo e(dateTimeFormat($nextSession->date, 'j M Y')); ?></span>
                                                </div>
                                            <?php else: ?>
                                                
                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span class="stat-title font-weight-bold font-15">Teacher:</span>
                                                    <span class="stat-value"><?php echo e($webinar->teacher->full_name); ?></span>
                                                </div>

                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span class="stat-title font-weight-bold font-15"><?php echo e(trans('public.start_date')); ?>:</span>
                                                    <span
                                                        class="stat-value"><?php echo e(dateTimeFormat($webinar->start_date, 'j M Y')); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <div style="margin: 15px 0px">
                                            <span class="stat-title font-weight-bold font-15">Description</span>
                                            
                                            <p>
                                                <?php echo $webinar->description; ?>

        
                                               </p>
                                        </div>
                                       
                                        <div
                                        style="
                                        background-color: #43d477 !important;
                                        text-align: center;
                                        color: #fff;
                                        padding: 10px;
                                        border-radius: 20px;
                                        position: absolute;
                                        bottom: 17px;
                                        width: 80%;
                                        left: 37px;"
                                    >
                                        <a href="<?php echo e($webinar->getLearningPageUrl()); ?>" target="_blank">Go to Class</a>
                                    </div>
                                        

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <?php echo $__env->make(getTemplate() . '.includes.no-result', [
                'file_name' => 'student.png',
                'title' => 'No available class',

            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>

    </section>

    <div class="my-30">
        <?php echo e($webinars->appends(request()->input())->links('vendor.pagination.panel')); ?>

    </div>

    <?php echo $__env->make('web.default.panel.webinar.join_webinar_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script>
        var undefinedActiveSessionLang = '<?php echo e(trans('webinars.undefined_active_session')); ?>';
    </script>

    <script src="/assets/default/js/panel/join_webinar.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() . '.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/panel/webinar/purchases.blade.php ENDPATH**/ ?>