<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php if(!empty(session()->has('msg'))): ?>
            <div class="alert alert-info alert-dismissible fade show mt-30" role="alert">
                <?php echo e(session()->get('msg')); ?>

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <div class="row login-container">

            <div class="col-12 col-md-5 pl-0">
                <div class="test_sign_up_img_div">
                    <video class="growth-plans-video" autoplay muted loop style="width: 100%;height: 600px;">
                        <source src="/assets/default/img/home/sign_up_for_test.mp4" type="video/mp4">
                        Your browser does not support HTML5 video.
                    </video>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <h3 class="sign-test-title">
                    Get your child a free online languages proficiency test
                    <br />
                    and a customized teaching plan
                </h3>
                <div style="width: 40px;background-color:#86C739;height: 2px;margin: auto;"></div>

                <div class="login-card">
                    <h1 class="font-20 font-weight-bold">Sign Up Now!</h1>

                    <form method="Post" action="/login" class="mt-35">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <div class="form-group">
                            
                            <input style="border: 1px solid #000;padding: 25px 10px;border-radius: 15px;" name="child_name"
                                type="text" class="form-control <?php $__errorArgs = ['child_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="child_name" value="<?php echo e(old('child_name')); ?>" placeholder="Child's Name*" required>
                            <?php $__errorArgs = ['child_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            
                            <input style="border: 1px solid #000;padding: 25px 10px;border-radius: 15px;" name="child_age"
                                type="child_age" class="form-control <?php $__errorArgs = ['child_age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="child_age" placeholder="Child's Age*">

                            <?php $__errorArgs = ['child_age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            
                            <input style="border: 1px solid #000;padding: 25px 10px;border-radius: 15px;"
                                name="WhatsApp Number*" type="WhatsApp Number*"
                                class="form-control <?php $__errorArgs = ['WhatsApp Number*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="WhatsApp Number*"
                                placeholder="WhatsApp Number*">

                            <?php $__errorArgs = ['WhatsApp Number*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <button type="submit" class="btn btn-block mt-20 submit-but"
                            style="background-color: #46aa52;color:#fff;">Submit</button>
                    </form>

                    

                    

                    

                    

                    
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() . '.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/auth/sign_up_for_test.blade.php ENDPATH**/ ?>