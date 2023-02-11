<?php
$socials = getSocials();
if (!empty($socials) and count($socials)) {
    $socials = collect($socials)
        ->sortBy('order')
        ->toArray();
}

$footerColumns = getFooterColumns();
?>

<footer class="" style="background-color:#46aa52;padding: 100px 0px 60px;position: relative;">

        <img class="hide-mobile hide-mobile-hero-white" src="/assets/default/img/home/green-with-whitebg.jpg" alt="" style="position: absolute;transform: scaleY(-1);width: 19%!important;top: 0px;right:-108px;height: 15%;">

    <div class="container">
        <div class="row" style="color: #fff;">
            <div class="col-md-4 col-sm-12">
                <h3 style="font-weight: 500;margin-bottom: 30px">Our Address</h3>
                <p>
                    No 40-2, Jalan Tanjung SD 13/1,
                    <br />
                    Bandar Sri Damansara,
                    <br />
                    52200 Kuala Lumpur
                </p>
            </div>
            <div class="col-md-4 col-sm-12 footer_useful">
                <h3 style="font-weight: 500;margin-bottom: 30px">Useful Links</h3>
                <ul>
                    <li style="padding: 0px 0px 20px;">
                        <a href="#about_us" style="color: #fff;"><?php echo e(trans('home.about_us')); ?></a>
                    </li>
                    <li style="padding: 0px 0px 20px;">
                        <a href="#course_intro" style="color: #fff;">
                            <?php echo e(trans('home.course_intro')); ?>

                        </a>
                    </li>
                    <li style="padding: 0px 0px 20px;">
                        <a href="#language_plan" style="color: #fff;"><?php echo e(trans('home.language_plan')); ?></a>
                    </li>
                    <li style="padding: 0px 0px 20px;">
                        <a href="#why_choose" style="color: #fff;"><?php echo e(trans('home.why_choose_us')); ?></a>
                    </li>
                    <li style="padding: 0px 0px 20px;">
                        <a href="#parent_feedback" style="color: #fff;"><?php echo e(trans('home.praise_from_parents')); ?></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="footer_social" style="display: flex;justify-content: space-between;margin-bottom: 20px;">
                    <i class="footer_social_icon" data-feather="mail" width="30" height="30"></i>
                    <a href="mailto:youseededucation@gmail.com" style="color: #fff;">youseededucation@gmail.com</a>
                </div>
                
                <div style="display: flex;justify-content: space-between;margin-bottom: 20px;padding-right: 97px;">
                    <a href="https://www.facebook.com/%E4%BC%98%E8%8B%97%E6%95%99%E8%82%B2-YouSeed-109881341362395" target="_blank" style="color: #fff;">
                        <i data-feather="facebook" width="30" height="30"></i>
                    </a>
                    <a href="https://www.facebook.com/%E4%BC%98%E8%8B%97%E6%95%99%E8%82%B2-YouSeed-109881341362395" target="_blank" style="color: #fff;">
                        YouSeed Facebook
                    </a>
                </div>
            </div>
            <div class="col-md-8 col-sm-12">
                <h3 style="font-weight: 500;margin-bottom: 30px">About Us</h3>
                <p>
                    Ten years of trees, a hundred years of people.
                    Youmiao Education has been exploring this educational
                    road for many years and has trained thousands of students,
                    so it has a full understanding of the various difficulties that
                    students encounter in the learning process. According to our
                    experience, 80% of children are unable to absorb 100% of the
                    knowledge they have learned because of their poor language skills.
                    Every child is excellent and intelligent, but because they do not use
                    the correct learning method, they feel difficult in the process of
                    language learning. It is like trying to grow into a towering tree seed,
                    but it cannot break out of the ground due to lack of sunlight and rain.
                </p>
                <div
                    style="padding:20px 0px;background-color: #86c739;width: 33%;text-align:center;border-radius:30px;margin: 175px 0px 30px;font-weight: bold;box-shadow: 0px 0px 13px -6px rgba(0,0,0,0.66);">
                    <a href="#sign-up" style="color: #fff">Get Started</a>
                </div>

            </div>
            <div class="col-md-4 col-sm-12">
                <h3 style="font-weight: 500;margin-bottom: 30px">Our Newsletter</h3>
                <p style="margin-bottom: 30px">
                    Every child is a high-quality sapling that
                    can grow into a towering tree.
                </p>
                <p>
                    As educators, we are on a mission to
                    help every child break through learning
                    difficulties, so we established Youmiao Education.
                    Based on this belief, we strive to escape the
                    traditional cramming education, and design the
                    curriculum from the perspective of children,
                    understand children’s psychology and learning
                    difficulties, so that they can learn happily and effectively.
                </p>
                
            </div>
        </div>
        <div class="footer_copyright" style="display: flex;justify-content:space-between;margin-top: 50px;">
            <div>
                <div style="display: flex">
                    <div style="margin-right: 20px">
                        <a href="/privacy-policy" style="color: #fff">Privacy & Policy</a>
                    </div>
                    <div style="margin-right: 20px">
                        <a href="/term-condition" style="color: #fff">Terms & Condition</a>
                    </div>
                    <div>
                        <a href="/cancellation" style="color: #fff">Cancellation & Refund Policy</a>
                    </div>
                </div>
            </div>
            <div class="footer_reserved" style="color: #fff">
                All Rights Reserved <?= date('Y') ?> YouSeed
            </div>
        </div>
    </div>
</footer>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/lms/resources/views/web/default/includes/footer.blade.php ENDPATH**/ ?>