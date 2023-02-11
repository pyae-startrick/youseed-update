<div class="tab-pane mt-3 fade" id="images" role="tabpanel" aria-labelledby="images-tab">
    <div class="row">
        <div class="col-12 col-md-6">
            <form action="/admin/users/<?php echo e($user->id .'/updateImage'); ?>" method="Post">
                <?php echo e(csrf_field()); ?>


                <div class="form-group mt-15">
                    <label class="input-label"><?php echo e(trans('admin/main.avatar')); ?></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="input-group-text admin-file-manager" data-input="avatar" data-preview="holder">
                                <i class="fa fa-chevron-up"></i>
                            </button>
                        </div>
                        <input type="text" name="avatar" id="avatar" value="<?php echo e(!empty($user->avatar) ? $user->getAvatar() : old('image_cover')); ?>" class="form-control" autofocus/>
                        <div class="input-group-append">
                            <button type="button" class="input-group-text admin-file-view" data-input="avatar">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-15 d-none">
                    <label class="input-label"><?php echo e(trans('admin/main.cover_image')); ?></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="button" class="input-group-text admin-file-manager" data-input="cover_img" data-preview="holder">
                                <i class="fa fa-chevron-up"></i>
                            </button>
                        </div>
                        <input type="text" name="cover_img" id="cover_img" value="<?php echo e(!empty($user->cover_img) ? $user->cover_img : old('image_cover')); ?>" class="form-control"/>
                        <div class="input-group-append">
                            <button type="button" class="input-group-text admin-file-view" data-input="cover_img">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>


                <div class=" mt-4">
                    <button class="btn btn-primary"><?php echo e(trans('admin/main.submit')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $__env->startPush('scripts_bottom'); ?>
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


                $('body').on('click', '.admin-file-manager', function (e) {
        e.preventDefault();
        $(this).filemanager('file', {prefix: '/laravel-filemanager'})
    });

        })(jQuery)
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /Users/admin/Code/lms/resources/views/admin/users/editTabs/images.blade.php ENDPATH**/ ?>