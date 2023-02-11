<?php $__env->startPush('styles_top'); ?>
    <link rel="stylesheet" href="/assets/default/vendors/chartjs/chart.min.css" />
    <link rel="stylesheet" href="/assets/default/vendors/apexcharts/apexcharts.css" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <section class="dashboard mobile-panel-w" style="padding: 30px 50px;margin-bottom: 100px;">

        <h3 class="mobile-panel-h2 font-20 mb-30 text-center text-dark-blue font-weight-bold">Welcome</h3>
        <div style="width:40px;height:2px;background: #000;margin: auto;"></div>
        <div class="row">
            

            <?php $__currentLoopData = $authUser->getUnreadNoticeboards(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getUnreadNoticeboard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-lg-4 mt-35">
                    <div style="height: 200px" class="bg-white noticeboard rounded-sm panel-shadow py-5 py-md-10 px-10 px-md-20">
                        <div class="noticeboard-item py-15">
                            <div style="margin-bottom: 93px;" class=" d-flex align-items-center justify-content-between">
                                <div class="w-50">
                                    <h4 class="js-noticeboard-title font-weight-500 text-secondary"><?php echo truncate($getUnreadNoticeboard->title, 150); ?>

                                    </h4>
                                </div>

                                <div>
                                    <button type="button" data-id="<?php echo e($getUnreadNoticeboard->id); ?>"
                                        class="js-noticeboard-info btn btn-sm btn-border-white"><?php echo e(trans('panel.more_info')); ?></button>
                                    <input type="hidden" class="js-noticeboard-message"
                                        value="<?php echo e($getUnreadNoticeboard->message); ?>">
                                </div>
                            </div>
                            <div style="position: absolute;
                            bottom: 22px;" class="font-12 text-gray mt-5">
                                <span class="mr-5"><?php echo e(trans('public.created_by')); ?>

                                    <?php echo e($getUnreadNoticeboard->sender); ?></span>
                                |
                                <span
                                    class="js-noticeboard-time ml-5"><?php echo e(dateTimeFormat($getUnreadNoticeboard->created_at, 'j M Y | H:i')); ?></span>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



        </div>
    </section>
    <section class="" style="height: 300px;background-color:#fff;">
        <div style="width: 94%;
        margin: auto;
        padding: 20px 30px !important;
        border-radius: 30px !important;
        background: #43d477 !important;
        top: -36px;" class="bg-white dashboard-banner-container position-relative px-15 px-ld-35 py-10 panel-shadow rounded-sm">
            <h2 class="font-30 text-white line-height-1 ">
                <span class="d-block"><?php echo e(trans('panel.hi')); ?> <?php echo e($authUser->full_name); ?>,</span>
            </h2>

            
        </div>
    </section>



    <div class="d-none" id="iNotAvailableModal">
        <div class="offline-modal">
            <h3 class="section-title after-line"><?php echo e(trans('panel.offline_title')); ?></h3>
            <p class="mt-20 font-16 text-gray"><?php echo e(trans('panel.offline_hint')); ?></p>

            <div class="form-group mt-15">
                <label><?php echo e(trans('panel.offline_message')); ?></label>
                <textarea name="message" rows="4" class="form-control "><?php echo e($authUser->offline_message); ?></textarea>
                <div class="invalid-feedback"></div>
            </div>

            <div class="mt-30 d-flex align-items-center justify-content-end">
                <button type="button"
                    class="js-save-offline-toggle btn btn-primary btn-sm"><?php echo e(trans('public.save')); ?></button>
                <button type="button" class="btn btn-danger ml-10 close-swl btn-sm"><?php echo e(trans('public.close')); ?></button>
            </div>
        </div>
    </div>

    <div class="d-none" id="noticeboardMessageModal">
        <div class="text-center">
            <h3 class="modal-title font-20 font-weight-500 text-dark-blue"></h3>
            <span class="modal-time d-block font-12 text-gray mt-25"></span>
            <p class="modal-message font-weight-500 text-gray mt-4"></p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    
    

    <script>
        var offlineSuccess = '<?php echo e(trans('panel.offline_success')); ?>';
        var $chartDataMonths = <?php echo json_encode($monthlyChart['months'], 15, 512) ?>;
        var $chartData = <?php echo json_encode($monthlyChart['data'], 15, 512) ?>;
    </script>

    
<?php $__env->stopPush(); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
     $(document).ready(function() {
        $('.js-noticeboard-info').on('click', function (e) {
        const $this = $(this);
        const noticeboard_id = $this.attr('data-id');
        const card = $this.closest('.noticeboard-item');
        const title = card.find('.js-noticeboard-title').text();
        const time = card.find('.js-noticeboard-time').text();
        const message = card.find('.js-noticeboard-message').val();

        const modal = $('#noticeboardMessageModal');
        modal.find('.modal-title').text(title);
        modal.find('.modal-time').text(time);
        modal.find('.modal-message').html(message);


        Swal.fire({
            html: modal.html(),
            showCancelButton: false,
            showConfirmButton: false,
            showCloseButton: true,
            customClass: {
                content: 'p-0 text-left',
            },
            width: '30rem',
        });

        if (!$this.hasClass('seen-at')) {
            $.get('/panel/noticeboard/' + noticeboard_id + '/saveStatus', function () {
            })
        }
    });
        })
</script>

<?php echo $__env->make(getTemplate() . '.panel.layouts.panel_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/panel/dashboard.blade.php ENDPATH**/ ?>