<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/daterangepicker/daterangepicker.min.css">
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
            <div class="row">

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
                            
                            <div class="gradient-card" style="height: 620px!important;">
                                <div class="image-box" style="position: relative;">
                                    <img src="<?php echo e($webinar->getImage()); ?>" class="img-cover" alt="">
                                    <div class="d-flex justify-content-between">
                                        <?php switch($webinar->status):
                                            case (\App\Models\Webinar::$active): ?>
                                                <?php if($webinar->isWebinar()): ?>
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
                                                <?php else: ?>
                                                    <span style="position: absolute;top: 17px;"
                                                        class="badge badge-secondary"><?php echo e(trans('webinars.' . $webinar->type)); ?></span>
                                                <?php endif; ?>
                                            <?php break; ?>

                                            <?php case (\App\Models\Webinar::$isDraft): ?>
                                                <span style="position: absolute;top: 17px;"
                                                    class="badge badge-danger"><?php echo e(trans('public.draft')); ?></span>
                                            <?php break; ?>

                                            <?php case (\App\Models\Webinar::$pending): ?>
                                                <span style="position: absolute;top: 17px;"
                                                    class="badge badge-warning"><?php echo e(trans('public.waiting')); ?></span>
                                            <?php break; ?>

                                            <?php case (\App\Models\Webinar::$inactive): ?>
                                                <span style="position: absolute;top: 17px;"
                                                    class="badge badge-danger"><?php echo e(trans('public.rejected')); ?></span>
                                            <?php break; ?>
                                        <?php endswitch; ?>

                                        <div style="position: absolute;top: 17px;right: 17px;">
                                            <span
                                                class="badge badge-white ml-10 status-badge-white"><?php echo e(trans('webinars.' . $webinar->type)); ?></span>


                                                

                                                <?php if($authUser->id == $webinar->creator_id or $authUser->id == $webinar->teacher_id): ?>
                                                <div class="btn-group dropdown table-actions">
                                                    <button style="color: #46aa52;" type="button" class="btn-transparent dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i data-feather="more-vertical" height="20"></i>
                                                    </button>
                                                    <div class="dropdown-menu" style="top: -83px!important;">
        
                                                        <a href="/panel/webinars/<?php echo e($webinar->id); ?>/step/4" class="webinar-actions d-block mt-10">Upload Files</a>
                                                        <a href="/panel/webinars/<?php echo e($webinar->id); ?>/step/1" class="webinar-actions d-block mt-10">Edit Class</a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                    </div>

                                    
                                </div>

                                <div style="padding: 0 20px;" class="webinar-card-body w-100 d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <a href="<?php echo e($webinar->getUrl()); ?>" target="_blank">
                                            <h3 style="color: #43d477" class="font-18 font-weight-bold">
                                                <?php echo e($webinar->title); ?>

                                            </h3>
                                        </a>


                                    </div>

                                    

                                    

                                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-auto">
                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span
                                                class="stat-title font-weight-bold font-15">Class ID:</span>
                                            <span class="stat-value"><?php echo e($webinar->id); ?></span>
                                        </div>

                                        <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                            <span
                                                class="stat-title font-weight-bold font-15">Subject:</span>
                                            <span
                                                class="stat-value"><?php echo e(!empty($webinar->category_id) ? $webinar->category->title : ''); ?></span>
                                        </div>

                                        <?php if($webinar->isProgressing() and !empty($nextSession)): ?>
                                            

                                            <?php if($webinar->isWebinar()): ?>
                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span
                                                        class="stat-title font-weight-bold font-15"><?php echo e(trans('webinars.next_session_start_date')); ?>:</span>
                                                    <span
                                                        class="stat-value"><?php echo e(dateTimeFormat($nextSession->date, 'j M Y')); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            

                                            <?php if($webinar->isWebinar()): ?>
                                                <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                    <span
                                                        class="stat-title font-weight-bold font-15"><?php echo e(trans('public.start_date')); ?>:</span>
                                                    <span
                                                        class="stat-value"><?php echo e(dateTimeFormat($webinar->start_date, 'j M Y')); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if($webinar->isTextCourse() or $webinar->isCourse()): ?>
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span
                                                    class="stat-title font-weight-bold font-15"><?php echo e(trans('public.files')); ?>:</span>
                                                <span class="stat-value"><?php echo e($webinar->files->count()); ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($webinar->isTextCourse()): ?>
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span
                                                    class="stat-title font-weight-bold font-15"><?php echo e(trans('webinars.text_lessons')); ?>:</span>
                                                <span class="stat-value"><?php echo e($webinar->textLessons->count()); ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($webinar->isCourse()): ?>
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span
                                                    class="stat-title font-weight-bold font-15"><?php echo e(trans('home.downloadable')); ?>:</span>
                                                <span
                                                    class="stat-value"><?php echo e($webinar->downloadable ? trans('public.yes') : trans('public.no')); ?></span>
                                            </div>
                                        <?php endif; ?>

                                        

                                        <?php if(!empty($webinar->partner_instructor) and $webinar->partner_instructor and $authUser->id != $webinar->teacher_id and $authUser->id != $webinar->creator_id): ?>
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span
                                                    class="stat-title font-weight-bold font-15"><?php echo e(trans('panel.invited_by')); ?>:</span>
                                                <span class="stat-value"><?php echo e($webinar->teacher->full_name); ?></span>
                                            </div>
                                        <?php elseif($authUser->id != $webinar->teacher_id and $authUser->id != $webinar->creator_id): ?>
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span
                                                    class="stat-title font-weight-bold font-15"><?php echo e(trans('webinars.teacher_name')); ?>:</span>
                                                <span class="stat-value"><?php echo e($webinar->teacher->full_name); ?></span>
                                            </div>
                                        <?php elseif($authUser->id == $webinar->teacher_id and $authUser->id != $webinar->creator_id and $webinar->creator->isOrganization()): ?>
                                            <div class="d-flex align-items-start flex-column mt-20 mr-15">
                                                <span
                                                    class="stat-title font-weight-bold font-15"><?php echo e(trans('webinars.organization_name')); ?>:</span>
                                                <span class="stat-value"><?php echo e($webinar->creator->full_name); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="my-30">
                <?php echo e($webinars->appends(request()->input())->links('vendor.pagination.panel')); ?>

            </div>
        <?php else: ?>
            <?php echo $__env->make(getTemplate() . '.includes.no-result', [
                'file_name' => 'webinar.png',
                'title' => 'No available class',
                'hint' => trans('panel.no_result_hint'),
                'btn' => ['url' => '#', 'text' => 'Wait for class assign from admin'],
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

    </section>

    <?php echo $__env->make('web.default.panel.webinar.make_next_session_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script src="/assets/default/vendors/daterangepicker/daterangepicker.min.js"></script>

    <script>
        var undefinedActiveSessionLang = '<?php echo e(trans('webinars.undefined_active_session')); ?>';
        var saveSuccessLang = '<?php echo e(trans('webinars.success_store')); ?>';
    </script>

    <script src="/assets/default/js/panel/make_next_session.min.js"></script>

    <script>
        (function($) {
            "use strict";

            <?php if(session()->has('sweetalert')): ?>
                Swal.fire({
                    icon: "<?php echo e(session()->get('sweetalert')['status'] ?? 'success'); ?>",
                    html: '<h3 class="font-20 text-center text-dark-blue py-25"><?php echo e(session()->get('sweetalert')['msg'] ?? ''); ?></h3>',
                    showConfirmButton: true,
                    width: '25rem',
                });
            <?php endif; ?>
        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() . '.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/panel/webinar/index.blade.php ENDPATH**/ ?>