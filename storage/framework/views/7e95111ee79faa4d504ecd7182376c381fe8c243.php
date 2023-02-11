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

            <div class="col-12 col-md-6 pl-0">
                <div class="login_img_div">
                    <img src="/assets/default/img/home/login_front.png" class="img-cover" alt="Login"
                        style="height:auto!important; ">

                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-width" style="width: 83%;margin: auto;">
                    
                    <h1 class="font-23 font-weight-bold text-center"><?php echo e(trans('home.login_to_your_acc')); ?></h1>

                    <form method="Post" action="/login" class="mt-35">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <div class="form-group">
                            
                            <input name="username" type="text"
                                class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="username"
                                value="<?php echo e(old('username')); ?>" aria-describedby="emailHelp"
                                placeholder="Enter Student ID or email" required
                                style="border: 1px solid #000!important;padding: 1.5rem 1rem!important;border-radius: 0.8rem!important;">
                            <?php $__errorArgs = ['username'];
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

                        <div class="form-group" style="position: relative">
                            
                            <input name="password" type="password"
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password"
                                aria-describedby="passwordHelp" placeholder="<?php echo e(trans('home.password')); ?>" required
                                style="border: 1px solid #000!important;padding: 1.5rem 1rem!important;border-radius: 0.8rem!important;">
                            <i data-feather="eye-off" width="20" height="20" class="mr-10"
                                style="position: absolute;right: 9px;top: 14px;cursor: pointer;" onclick="myFunction()"></i>

                            <?php $__errorArgs = ['password'];
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

                        <div class="mt-20 pl-25">
                            <a href="/forget-password" target="_blank" style="color:#46aa52"><?php echo e(trans('home.forgot_password')); ?></a>
                        </div>

                        <div style="display: flex">
                            <button type="submit" class="btn btn-block mt-20"
                                style="margin-right:14px;background-color: #46aa52;color:#fff;width: 40%!important;border-radius: 30px!important;"><?php echo e(trans('home.login')); ?></button>

                            <div class="form-group mobile-remember"
                                style="background-color: #f3f3f3;padding: 15px 35px;border-radius: 30px;width: 60%;align-self: center;margin-top: 20px;">
                                <div class="custom-control custom-checkbox" style="color: #46aa52;">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                        id="remember-me">
                                    <label class="custom-control-label"
                                        for="remember-me"><?php echo e(trans('home.remember_me')); ?></label>
                                </div>
                            </div>

                        </div>
                        <div class="mt-20 text-center">
                            <span><?php echo e(trans('home.dont_have_acc')); ?></span>
                            <a href="/register" class="text-secondary font-weight-bold"
                                style="color: #46aa52!important;"><?php echo e(trans('home.sign_up')); ?></a>
                        </div>

                    </form>

                    

                    

                    



                    
                </div>

                


                

                

                



                
                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    function mySecFunction() {
        var x = document.getElementById("register-password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

<?php echo $__env->make(getTemplate() . '.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/admin/Code/lms/resources/views/web/default/auth/login.blade.php ENDPATH**/ ?>