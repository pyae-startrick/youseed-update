<?php $__env->startSection('content'); ?>
    <section class="cart-banner position-relative text-center">
        <h1 class="font-30 text-white font-weight-bold"><?php echo e(trans('cart.shopping_cart')); ?></h1>
        <span class="payment-hint font-20 text-white d-block">
            <?php echo e(addCurrencyToPrice(handlePriceFormat($subTotal)) . ' ' . trans('cart.for_items', ['count' => $carts->count()])); ?></span>
    </section>

    <div class="container mb-45">
        <section class="mt-45">
            <h2 class="section-title"><?php echo e(trans('cart.cart_items')); ?></h2>

            <div class="rounded-sm shadow mt-20 py-25 px-10 px-md-30">
                <?php if($carts->count() > 0): ?>
                    <div class="row d-none d-md-flex">
                        <div class="col-12 col-lg-8"><span class="text-gray font-weight-500"><?php echo e(trans('cart.item')); ?></span>
                        </div>
                        <div class="col-6 col-lg-2 text-center"><span
                                class="text-gray font-weight-500"><?php echo e(trans('public.price')); ?></span></div>
                        <div class="col-6 col-lg-2 text-center"><span
                                class="text-gray font-weight-500"><?php echo e(trans('public.remove')); ?></span></div>
                    </div>
                <?php endif; ?>
                <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row mt-5 cart-row">
                        <div class="col-12 col-lg-8 mb-15 mb-md-0">
                            <div class="webinar-card webinar-list-cart row">
                                <div class="col-4">
                                    <div class="image-box">
                                        <?php
                                            $imgPath = '';
                                            
                                            if (!empty($cart->webinar_id)) {
                                                $imgPath = $cart->webinar->getImage();
                                            } elseif (!empty($cart->reserve_meeting_id)) {
                                                $imgPath = $cart->reserveMeeting->meeting->creator->getAvatar();
                                            }
                                        ?>
                                        <img src="<?php echo e($imgPath); ?>" class="img-cover" alt="user avatar">
                                    </div>
                                </div>

                                <div class="col-8">
                                    <div class="webinar-card-body p-0 w-100 h-100 d-flex flex-column">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <?php if(!empty($cart->webinar_id)): ?>
                                                <a href="<?php echo e($cart->webinar->getUrl()); ?>" target="_blank">
                                                    <h3 class="font-16 font-weight-bold text-dark-blue">
                                                        <?php echo e($cart->webinar->title); ?></h3>
                                                </a>
                                            <?php elseif(!empty($cart->reserve_meeting_id)): ?>
                                                <h3 class="font-16 font-weight-bold text-dark-blue">
                                                    <?php echo e(trans('meeting.reservation_appointment')); ?>

                                                    <?php echo e((!empty($cart->reserveMeeting->student_count) and $cart->reserveMeeting->student_count > 1) ? '(' . trans('update.reservation_appointment_student_count', ['count' => $cart->reserveMeeting->student_count]) . ')' : ''); ?>

                                                </h3>
                                            <?php endif; ?>
                                        </div>

                                        <?php if(!empty($cart->reserve_meeting_id)): ?>
                                            <div class="mt-10">
                                                <span
                                                    class="text-gray font-12 border rounded-pill py-5 px-10"><?php echo e($cart->reserveMeeting->day . ' ' . $cart->reserveMeeting->meetingTime->time); ?>

                                                    (<?php echo e($cart->reserveMeeting->meeting->getTimezone()); ?>)
                                                </span>
                                            </div>

                                            <?php if($cart->reserveMeeting->meeting->getTimezone() != getTimezone()): ?>
                                                <div class="mt-10">
                                                    <span
                                                        class="text-danger font-12 border border-danger rounded-pill py-5 px-10"><?php echo e($cart->reserveMeeting->day . ' ' . dateTimeFormat($cart->reserveMeeting->start_at, 'h:iA', false) . '-' . dateTimeFormat($cart->reserveMeeting->end_at, 'h:iA', false)); ?>

                                                        (<?php echo e(getTimezone()); ?>)</span>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <span class="text-gray font-14 mt-auto">
                                            <?php echo e(trans('public.by')); ?>


                                            <?php if(!empty($cart->webinar_id)): ?>
                                                <a href="<?php echo e($cart->webinar->teacher->getProfileUrl()); ?>" target="_blank"
                                                    class="text-gray text-decoration-underline"><?php echo e($cart->webinar->teacher->full_name); ?></a>
                                            <?php elseif(!empty($cart->reserve_meeting_id)): ?>
                                                <a href="<?php echo e($cart->reserveMeeting->meeting->creator->getProfileUrl()); ?>"
                                                    target="_blank"
                                                    class="text-gray text-decoration-underline"><?php echo e($cart->reserveMeeting->meeting->creator->full_name); ?></a>
                                            <?php endif; ?>
                                        </span>

                                        <?php if(!empty($cart->webinar_id)): ?>
                                            <?php echo $__env->make(getTemplate() . '.includes.webinar.rate', [
                                                'rate' => $cart->webinar->getRate(),
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php elseif(!empty($cart->reserve_meeting_id)): ?>
                                            <?php echo $__env->make(getTemplate() . '.includes.webinar.rate', [
                                                'rate' => $cart->reserveMeeting->meeting->creator->rates(),
                                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-lg-2 d-flex flex-md-column align-items-center justify-content-center">
                            <span class="text-gray d-inline-block d-md-none"><?php echo e(trans('public.price')); ?> :</span>

                            <?php if(!empty($cart->webinar_id)): ?>
                                <?php if($cart->webinar->getDiscount($cart->ticket)): ?>
                                    <span
                                        class="text-gray text-decoration-line-through mx-10 mx-md-0"><?php echo e(handlePrice($cart->webinar->price, true, true)); ?></span>
                                    <span
                                        style="color:#46aa52;"class="font-20 mt-0 mt-md-5 font-weight-bold"><?php echo e(handlePrice($cart->webinar->price - $cart->webinar->getDiscount($cart->ticket), true, true)); ?></span>
                                <?php else: ?>
                                    <span
                                        style="color:#46aa52;"class="font-20 mt-0 mt-md-5 font-weight-bold"><?php echo e(handlePrice($cart->webinar->price, true, true)); ?></span>
                                <?php endif; ?>
                            <?php elseif(!empty($cart->reserve_meeting_id)): ?>
                                <span
                                    style="color:#46aa52;"class="font-20 mt-0 mt-md-5 font-weight-bold"><?php echo e(handlePrice($cart->reserveMeeting->paid_amount, true, true)); ?></span>
                            <?php endif; ?>
                        </div>

                        <div class="col-6 col-lg-2 d-flex flex-md-column align-items-center justify-content-center">
                            <span class="text-gray d-inline-block d-md-none mr-10 mr-md-0"><?php echo e(trans('public.remove')); ?>

                                :</span>

                            <a href="/cart/<?php echo e($cart->id); ?>/delete"
                                class="delete-action btn-cart-list-delete d-flex align-items-center justify-content-center">
                                <i data-feather="x" width="20" height="20" class=""></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <button type="button" onclick="window.history.back()" class="btn btn-sm mt-25"
                    style="background-color: #46aa52;color:#fff;"><?php echo e(trans('cart.continue_shopping')); ?></button>
            </div>
        </section>

        <div class="row mt-30">
            <div class="col-12 col-lg-6">
                <section class="mt-45">
                    <h3 class="section-title"><?php echo e(trans('cart.coupon_code')); ?></h3>
                    <div class="rounded-sm shadow mt-20 py-25 px-20">
                        <p class="text-gray font-14"><?php echo e(trans('cart.coupon_code_hint')); ?></p>

                        <?php if(!empty($userGroup) and !empty($userGroup->discount)): ?>
                            <p class="text-gray mt-25">
                                <?php echo e(trans('cart.in_user_group', ['group_name' => $userGroup->name, 'percent' => $userGroup->discount])); ?>

                            </p>
                        <?php endif; ?>

                        <form action="/carts/coupon/validate" method="Post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <input type="text" name="coupon" id="coupon_input" class="form-control mt-25"
                                    placeholder="<?php echo e(trans('cart.enter_your_code_here')); ?>">
                                <span class="invalid-feedback"><?php echo e(trans('cart.coupon_invalid')); ?></span>
                                <span class="valid-feedback"><?php echo e(trans('cart.coupon_valid')); ?></span>
                            </div>

                            <button type="submit" id="checkCoupon" class="btn btn-sm mt-50"
                                style="background-color: #46aa52;color:#fff;"><?php echo e(trans('cart.validate')); ?></button>
                        </form>
                    </div>
                </section>
            </div>

            <div class="col-12 col-lg-6">
                <section class="mt-45">
                    <h3 class="section-title"><?php echo e(trans('cart.cart_totals')); ?></h3>
                    <div class="rounded-sm shadow mt-20 pb-20 px-20">

                        <div class="cart-checkout-item">
                            <h4 class="text-secondary font-14 font-weight-500"><?php echo e(trans('cart.sub_total')); ?></h4>
                            <span
                                class="font-14 text-gray font-weight-bold"><?php echo e(addCurrencyToPrice(handlePriceFormat($subTotal))); ?></span>
                        </div>

                        <div class="cart-checkout-item">
                            <h4 class="text-secondary font-14 font-weight-500"><?php echo e(trans('public.discount')); ?></h4>
                            <span class="font-14 text-gray font-weight-bold">
                                <span
                                    id="totalDiscount"><?php echo e(addCurrencyToPrice(handlePriceFormat($totalDiscount))); ?></span>
                            </span>
                        </div>

                        <div class="cart-checkout-item">
                            <h4 class="text-secondary font-14 font-weight-500"><?php echo e(trans('cart.tax')); ?>

                                <span class="font-14 text-gray ">(<?php echo e($tax); ?>%)</span>
                            </h4>
                            <span class="font-14 text-gray font-weight-bold"><span
                                    id="taxPrice"><?php echo e(addCurrencyToPrice(handlePriceFormat($taxPrice))); ?></span></span>
                        </div>

                        <div class="cart-checkout-item border-0">
                            <h4 class="text-secondary font-14 font-weight-500"><?php echo e(trans('cart.total')); ?></h4>
                            <span class="font-14 text-gray font-weight-bold"><span
                                    id="totalAmount"><?php echo e(addCurrencyToPrice(handlePriceFormat($total))); ?></span></span>
                        </div>

                        <form action="/cart/checkout" method="post" id="cartForm">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="discount_id" value="">

                            <button type="submit" class="btn btn-sm mt-15"
                                style="background-color: #46aa52;color:#fff;"><?php echo e(trans('cart.checkout')); ?></button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_bottom'); ?>
    <script>
        var couponInvalidLng = '<?php echo e(trans('cart.coupon_invalid')); ?>';
    </script>
    <script src="/assets/default/js/parts/cart.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make(getTemplate() . '.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/cart/cart.blade.php ENDPATH**/ ?>