@extends(getTemplate() . '.layouts.app_home')

@push('styles_top')
    {{-- <link rel="stylesheet" href="/assets/default/vendors/swiper/swiper-bundle.min.css"> --}}
    <link rel="stylesheet" href="/assets/default/vendors/owl-carousel2/owl.carousel.min.css">
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/assets/owl.carousel.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://themes.audemedia.com/html/goodgrowth/css/owl.theme.default.min.css"> --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endpush

@section('content')
    <section class="slider-container slider-hero-section2"
        style="background-color: #F1F1F1BF;position: static!important;padding: 0px!important;padding-bottom: 100px!important;padding-top: 100px!important;">
        <div class="hide-mobile high-mobile-nav"
            style="position: absolute;right: 0;width: 36%;transform: scaleX(-1);height: 48%;top:0px;">
            <img src="/assets/default/img/home/home-top.png" alt="" style="width: 100%;height: 106%;">
        </div>
        <div class="container">

            <div class="row slider-content align-items-center hero-section2 flex-md-row">

                <div class="col-12 col-md-7 col-lg-6">
                    <span style="color: #46AA52;font-size: 20px;">Youseed</span> <b style="font-size: 18px;">4-10
                        {{ trans('home.years_old') }}</b>
                    <br />
                    <p data-aos="fade-right" data-aos-duration="700" class="font-weight-bold;"
                        style="font-size: 26px;padding: 30px 0px;font-weight: bold;">
                        {{ trans('home.efficient') }}</p>
                    <ul style="color: #46AA52;line-height: 32px;padding-left: 14px;">
                        <li style="list-style: disc!important;font-size:15px;">{{ trans('home.one_to_one') }}</li>
                        <li style="list-style: disc!important;font-size:15px;">{{ trans('home.language_teaching') }}</li>
                        <li style="list-style: disc!important;font-size:15px;">{{ trans('home.course_customization') }}
                        </li>
                    </ul>
                    <div data-aos="zoom-out" data-aos-duration="700" class="mobile-test-margin"
                        style="margin-top: 30px;background: #46AA52;padding: 20px 10px;border-radius: 35px;text-align: center;width: 78%;box-shadow: 0px 16px 15px -6px rgba(0,0,0,0.52);">
                        <a href="#sign-up" style="color: #fff;font-weight: 550;">
                            {{ trans('home.free_test') }}
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-6">
                    <div style="display: flex;justify-content: center;">
                        <img src="/assets/default/img/home/section-1.png" alt="" style="width: 80%;">
                    </div>
                </div>
            </div>
        </div>
        <div class="hide-mobile hide-mobile-hero"
            style="position: absolute;transform: scaleY(-1);width: 20%!important;bottom: 311px;height: 80%;">
            <img src="/assets/default/img/home/about-banner.png" alt="" style="width: 103%;height: 45%;">
        </div>

    </section>
    {{-- <div style="position: absolute;transform: scaleY(-1);width: 14%!important;bottom: -180px;right: 0px;height: 58%;">
        <img src="/assets/default/img/home/white_wave.png" alt="" style="width: 100%;height: 38%;">
    </div> --}}
    <section id="floating">



        <section id="about_us" class="about-usSection"
            style="padding: 120px 0px;background-color: #46AA52;position: relative;">
            {{-- <div class="hide-mobile hide-mobile-hero-white"
            style="position: absolute;transform: scaleY(-1);width: 19%!important;top: -28px;right:-108px;height: 31%;">
            <img src="/assets/default/img/home/new_white_bg.png" alt="" style="width: 148%;height: 91%;">
            </div> --}}
            <img class="hide-mobile hide-mobile-hero-white" src="/assets/default/img/home/new_white_bg.png" alt=""
                style="position: absolute;transform: scaleY(-1);top: -1px;right:-108px;width: 18%;height: 20%;">

            <div class="mobile-circle-about" style="position: absolute;width: 8%;right:-60px;top:350px;">
                <img src="/assets/default/img/home/about-us-circle-2.png" alt="" style="width: 100%;">
            </div>
            <div class="container" style="position: relative;">

                <div class="mobile-laptop-about" style="position: absolute;width: 6%;top:203px;transform: rotate(-32deg);">
                    <img src="/assets/default/img/home/laptop.png" alt="" style="width: 100%;">
                </div>
                <div class="mobile-book-about" style="position: absolute;width: 8%;right:65px;top:82px;">
                    <img src="/assets/default/img/home/book.png" alt="" style="width: 100%;">
                </div>

                <div style="text-align: center;">
                    <h4 data-aos="fade-down-left" data-aos-duration="700"
                        style="color: #fff;font-weight: 500;padding-bottom: 20px;font-size: 35px">
                        {{ trans('home.about_us') }}
                    </h4>
                    <div style="width: 40px;background-color: #fff;height: 2px;margin: auto;"></div>
                    <h5 class="mobile-font" data-aos="fade-down-right" data-aos-duration="700"
                        style="color: #fff;font-weight: 300;padding-top: 20px;font-size: 22px;">
                        {{ trans('home.youseed_edu') }}</h5>
                </div>
                <div class="mobile-tree-img" style="width: 30%;margin: 0 auto;padding-top: 30px;position: relative;">
                    <img src="/assets/default/img/home/about-tree.png" alt=""
                        style="width: 100%;position: relative;z-index: 1;">
                    <img src="/assets/default/img/home/about-us-circle.png" alt=""
                        style="position: absolute;width: 45%;left: 90px;bottom: -22px;">
                </div>
                <div style="color: #46AA52;margin-top:30px">
                    <div data-aos="zoom-in" data-aos-duration="700" class="about-text"
                        style="background-color: #fff;padding: 70px 100px 30px 100px;border-radius: 47px 47px 0 0;position: relative;">
                        <div class="mobile-tree"
                            style="position: absolute;width: 62%;text-align: center;background-color: #fff;top: -29px;padding: 16px 40px;box-shadow: 0px 4px 27px -5px rgba(0,0,0,0.66);border-radius: 30px;right: 222px;">
                            <p class="mobile-font" style="font-weight: bold">{{ trans('home.every_child_is') }}</p>
                        </div>
                        <p style="text-align: justify;font-size: 18px;">
                            {{ trans('home.takes_ten_years') }}
                        </p>
                    </div>
                    <div data-aos="fade-down-left" data-aos-duration="500" class="about-text"
                        style="margin-top: 10px;background-color: #fff;padding: 30px 100px 30px 100px;position: relative;">
                        <p style="text-align: justify;font-size: 18px;">
                            {{ trans('home.as_educators') }}
                        </p>
                    </div>
                    <div data-aos="fade-down-right" data-aos-duration="700" class="about-text"
                        style="margin-top: 10px;background-color: #fff;padding: 30px 100px 30px 100px;border-radius: 0 0 47px 47px;position: relative;z-index:1;">
                        <p style="text-align: justify;font-size: 18px;">
                            {{ trans('home.youseed_is_the_first') }}
                        </p>
                    </div>
                </div>
            </div>
            <div style="position: absolute;width: 8%;right:122px;bottom:108px;transform: rotate(-32deg);">
                <img src="/assets/default/img/home/light.png" alt="" style="width: 100%;">
            </div>
            <div class="mobile-circle-about" style="position: absolute;width: 8%;left:-60px;bottom:180px;">
                <img src="/assets/default/img/home/about-us-circle-2.png" alt="" style="width: 100%;">
            </div>
            <div class="hide-mobile"
                style="position: absolute;transform: scaleX(-1);width: 39%!important;bottom: -206px;right: 0px;height: 31%;">
                <img src="/assets/default/img/home/about-right.png" alt="" style="width: 100%;height: 100%;">
            </div>
        </section>
        <section class="test-section" style="background-color: #F3F3F3;">
            <div class="container" style="position: relative;">
                <div class="container" style="padding: 40px 0px;">
                    <div style="text-align: center;margin-bottom: 40px">
                        <iframe class="video-width" width="700" height="450"
                            src="https://www.youtube.com/embed/7tr-7xV6KNk" title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                    <div data-aos="zoom-out" data-aos-duration="700" class="test-width-button"
                        style="background-color: #46AA52;padding: 25px 30px;margin: auto;width: 40%;text-align: center;border-radius: 30px;box-shadow: 0px 4px 27px -5px rgba(0,0,0,0.66);">
                        <a href="#sign-up" style="color: #fff;font-weight: 500;">
                            {{ trans('home.free_test') }}
                        </a>
                    </div>
                </div>
                <div class="test-img-width" style="position: absolute;width: 13%;bottom: 0;left: 150px;">
                    <img src="/assets/default/img/home/test.png" alt="" style="width: 100%;height: 100%">
                </div>
            </div>

        </section>
        {{-- course intro --}}
        <section id="course_intro" style="padding: 50px 0px;">
            <div class="container">
                <h4 style="text-align: center;margin-bottom: 25px;font-weight: bold;font-size: 26px;">
                    {{ trans('home.course_intro') }}</h4>
                <div style="width: 40px;height: 2px;background-color:#86C739;margin: auto;"></div>

                <div class="row" style="margin-bottom: 30px;">
                    <div data-aos="fade-down-right" data-aos-duration="700" class="col-md-6 col-sm-12">
                        <div style="width:32%;margin:auto;">
                            <img src="/assets/default/img/home/course_intro_1.png" alt="" style="width: 100%">
                        </div>
                        <div class="course-intro-button-1"
                            style="height: 85px;color: #fff;text-align: center;background-color:#86C739;padding:34px;border-radius: 30px;box-shadow: 0px 0px 21px -6px rgba(0,0,0,0.66);">
                            {{ trans('home.free_3_test') }}
                        </div>
                    </div>
                    <div data-aos="fade-down-left" data-aos-duration="700" class="col-md-6 col-sm-12"
                        style="margin-bottom: 35px;">
                        <div style="width:39%;margin:auto;">
                            <img src="/assets/default/img/home/course_intro_2.png" alt="" style="width: 100%">
                        </div>
                        <div class="course-intro-button"
                            style="height: 85px;color: #fff;text-align: center;background-color:#86C739;padding:24px;border-radius: 30px;box-shadow: 0px 0px 21px -6px rgba(0,0,0,0.66);">
                            {{ trans('home.1_on_1_teaching') }}
                        </div>
                    </div>
                    <div data-aos="fade-up-right" data-aos-duration="700" class="col-md-6 col-sm-12"
                        style="padding-top: 18px;">
                        <div style="width:41%;margin:auto;">
                            <img src="/assets/default/img/home/course_intro_3.png" alt="" style="width: 100%">
                        </div>
                        <div class="course-intro-button"
                            style="height: 85px;color: #fff;text-align: center;background-color:#86C739;padding:30px;border-radius: 30px;box-shadow: 0px 0px 21px -6px rgba(0,0,0,0.66);">
                            {{ trans('home.40_minutes_fun') }}
                        </div>
                    </div>
                    <div data-aos="fade-up-left" data-aos-duration="700" class="col-md-6 col-sm-12">
                        <div style="width:32%;margin:auto;">
                            <img src="/assets/default/img/home/course_intro_4.png" alt="" style="width: 100%">
                        </div>
                        <div
                            style="height: 85px;color: #fff;text-align: center;background-color:#86C739;padding:30px;border-radius: 30px;box-shadow: 0px 0px 21px -6px rgba(0,0,0,0.66);">
                            {{ trans('home.tailor_made') }}
                        </div>
                    </div>
                </div>
                <div data-aos="zoom-out" data-aos-duration="700" class="course-intro-learn-more"
                    style="margin-top: 52px;padding:20px 0px;background-color:#46AA52;width: 21%;text-align:center;border-radius:30px;margin:auto;box-shadow: 0px 0px 13px -6px rgba(0,0,0,0.66);">
                    <a href="#sign-up" style="color: #fff;font-weight: 500;">{{ trans('home.learn_more') }}</a>
                </div>
            </div>
        </section>
        {{-- Sign-up now section --}}
        <section id="signup" style="background-color:#86C739;padding: 60px 0px;position:relative;">
            <div class="container" style="position:relative;">
                <div class="mobile-light-plan" style="position: absolute;width: 8%;right:0;top:62px;">
                    <img src="/assets/default/img/home/light.png" alt="" style="width: 100%;">
                </div>
                <div class="mobile-laptop-plan" style="position: absolute;width: 8%;top:249px;">
                    <img src="/assets/default/img/home/laptop.png" alt="" style="width: 100%;">
                </div>
                <div class="mobile-book-plan" style="position: absolute;width: 8%;right:0;bottom:63px;">
                    <img src="/assets/default/img/home/book.png" alt="" style="width: 100%;">
                </div>
                <div>
                    <h3 style="color: #fff;font-weight:bold;margin-bottom:35px;text-align:center;font-size:26px;">
                        {{ trans('home.get_your_child') }}
                        <br />
                        {{ trans('home.get_your_child_extra') }}
                    </h3>
                </div>
                <div style="width: 40px;background-color:#fff;height: 2px;margin: auto;"></div>

                <div class="plan-sign-up"
                    style="margin-top: 37px!important;background-color: #fff;border-radius:30px;box-shadow: 0px 0px 13px -6px rgba(0,0,0,0.66);width:41%;padding:21px 30px;margin:auto;">
                    <h3 style="text-align:center;margin-bottom:20px;">{{ trans('home.sign_up_now') }}</h3>
                    <form class="contactFormMiddle">
                        <div class="form-group">
                            <input id="nameMiddle" type="text" placeholder="{{ trans('home.child_name') }}"
                                name="name"
                                style="border: 1px solid #F3F3F3;padding: 15px 20px;width: 100%;border-radius: 20px;"
                                required>
                        </div>

                        <div id="name-error" class="name-error-middle invalid-feedback">

                        </div>

                        <div class="form-group">
                            <input id="ageMiddle" type="text" maxlength="2"
                                placeholder="{{ trans('home.child_age') }}" name="age"
                                style="border: 1px solid #F3F3F3;padding: 15px 20px;width: 100%;border-radius: 20px;"
                                required>
                        </div>
                        <div class="invalid-feedback age-error-middle">

                        </div>

                        <div class="form-group">
                            <input id="whatsappMiddle" type="text" placeholder="{{ trans('home.whatsapp_number') }}"
                                name="whatsapp"
                                style="border: 1px solid #F3F3F3;padding: 15px 20px;width: 100%;border-radius: 20px;"
                                required>
                        </div>
                        <div class="invalid-feedback whatsapp-error-middle">

                        </div>

                        <div
                            style="background-color:#46AA52;border-radius:30px;padding:20px 15px;text-align:center;width:50%;margin:auto;">
                            <button id="submitMiddle"
                                style="color:#fff;background: none;border: none;font-weight: 500;">{{ trans('home.submit') }}</button>
                            <p id="loadingMiddle" style="color:#fff;background: none;border: none;font-weight: 500;">
                                Loading...</p>
                            <input hidden type="reset" class="hidden reset-button">

                        </div>
                    </form>
                </div>
            </div>
            <div class="hide-mobile"
                style="position: absolute;transform: scaleY(-1);width: 23%!important;bottom: -46px;height: 111%;">
                <img src="/assets/default/img/home/white_wave.png" alt="" style="width: 69%;height: 38%;">
            </div>
            <div class="hide-mobile"
                style="position: absolute;transform: scaleX(-1);width: 39%!important;bottom: -121px;right: 0px;height: 31%;">
                <img src="/assets/default/img/home/home-top.png" alt="" style="width: 100%;height: 100%;">
            </div>
        </section>
        {{-- Speck section --}}
        <section id="language_plan" style="padding: 100px 0px;position: relative;">
            <div class="container">
                <div style="position: relative;">
                    <h3 class="mobile_title" style="text-align: center;font-size: 30px;margin-bottom: 40px;">
                        {{ trans('home.a_comprehensive') }}
                    </h3>
                    <div style="width: 40px;background-color:#86C739;height: 2px;margin: auto;"></div>
                    <p
                        style="color: #86C739;text-align: left;font-size: 20px;font-weight: 500;margin-bottom: 100px;margin-top: 40px;">
                        {{ trans('home.language_play') }}
                        <br />
                        <span class="hide-all">{{ trans('home.these_3_language') }}</span>
                    </p>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div style="width: 50%;margin: auto;">
                                <img src="/assets/default/img/home/speak.png" alt="" style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h4 style="text-align: center;font-size: 21px;margin-bottom: 25px;">
                                {{ trans('home.speak') }}
                            </h4>
                            <div
                                style="margin-bottom: 25px;width: 40px;background-color:#86C739;height: 2px;margin: auto;">
                            </div>
                            <p class="recog-para"
                                style="color: #86C739;font-weight: 500;text-align: left;margin-top: 28px;">

                                {{ trans('home.speak_desc') }}
                            </p>
                        </div>
                    </div>
                    <div class="mobile-book-speak" style="position: absolute;width: 7%;left:-6px;">
                        <img src="/assets/default/img/home/book.png" alt="" style="width: 100%;">
                    </div>

                </div>
            </div>
            <div class="mobile-circle-about" style="position: absolute;width: 20%;right:-170px;top:350px;">
                <img src="/assets/default/img/home/about-us-circle-2.png" alt="" style="width: 100%;">
            </div>
        </section>
        <section style="position: relative">
            <div class="container">
                <div style="position: relative">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h4 style="text-align: center;font-size: 21px;margin-bottom: 25px;">

                                {{ trans('home.recognize') }}

                            </h4>
                            <div
                                style="margin-bottom: 25px;width: 40px;background-color:#86C739;height: 2px;margin: auto;">
                            </div>
                            <p class="recog-para"
                                style="color: #86C739;font-weight: 500;width: 77%;margin: auto;margin-top: 24px;text-align: left;">
                                {{ trans('home.recognize_desc') }}
                            </p>
                        </div>
                        <div class="col-md-6 col-sm-12" style="margin-bottom: 100px;">
                            <div style="width: 50%;margin: auto;">
                                <img src="/assets/default/img/home/recognize.png" alt="" style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 apply_bottom" style="margin-bottom: 100px;">
                            <div style="width: 50%;margin: auto;">
                                <img src="/assets/default/img/home/apply.png" alt="" style="width: 100%;">
                            </div>

                        </div>
                        <div class="col-md-6 col-sm-12 apply_margin_bottom">
                            <h4 style="text-align: center;font-size: 21px;margin-bottom: 25px;">
                                {{ trans('home.apply') }}
                            </h4>
                            <div
                                style="margin-bottom: 25px;width: 40px;background-color:#86C739;height: 2px;margin: auto;">
                            </div>
                            <p class="recog-para"
                                style="color: #86C739;font-weight: 500;width: 77%;margin: auto;text-align: left;margin-top: 24px;">
                                {{ trans('home.apply_desc') }}
                            </p>
                        </div>
                    </div>
                    <div style="position: absolute;width: 6%;right:-71px;transform: rotate(32deg);bottom: 173px;">
                        <img src="/assets/default/img/home/laptop.png" alt="" style="width: 100%;">
                    </div>
                </div>
            </div>
            <div class="mobile-circle-about" style="position: absolute;width: 20%;left:-180px;top:100px;">
                <img src="/assets/default/img/home/about-us-circle-2.png" alt="" style="width: 100%;">
            </div>
        </section>
        <section style="position: relative">
            <div class="mobile-circle-about" style="position: absolute;width: 5%;left:-45px;top:100px;">
                <img src="/assets/default/img/home/about-us-circle-2.png" alt="" style="width: 100%;">
            </div>
            <div class="mobile-circle-about" style="position: absolute;width: 10%;right:-83px;top:200px;">
                <img src="/assets/default/img/home/about-us-circle-2.png" alt="" style="width: 100%;">
            </div>
            <div class="container">
                <div style="position: relative;margin-bottom: 100px;">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h4 style="text-align: center;font-size: 21px;margin-bottom: 25px;">
                                {{ trans('home.read') }}
                            </h4>
                            <div
                                style="margin-bottom: 25px;width: 40px;background-color:#86C739;height: 2px;margin: auto;">
                            </div>
                            <p class="recog-para"
                                style="color: #86C739;font-weight: 500;width: 77%;margin: auto;text-align:left;margin-top: 24px;">
                                {{ trans('home.read_desc') }}
                            </p>

                        </div>
                        <div class="col-md-6 col-sm-12" style="margin-bottom: 100px;">

                            <div style="width: 50%;margin: auto;">
                                <img src="/assets/default/img/home/read.png" alt="" style="width: 100%;">
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div style="width: 50%;margin: auto;">
                                <img src="/assets/default/img/home/write.png" alt="" style="width: 100%;">
                            </div>

                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h4 style="text-align: center;font-size: 21px;margin-bottom: 25px;">
                                {{ trans('home.write') }}
                            </h4>
                            <div
                                style="margin-bottom: 25px;width: 40px;background-color:#86C739;height: 2px;margin: auto;">
                            </div>
                            <p class="write_margin_top"
                                style="color: #86C739;font-weight: 500;width: 77%;margin: auto;text-align:left;margin-top: 24px;">
                                {{ trans('home.write_desc') }}
                            </p>

                        </div>
                    </div>
                    <div style="position: absolute;width: 6%;left:-71px;transform: rotate(-32deg);bottom: 173px;">
                        <img src="/assets/default/img/home/light.png" alt="" style="width: 100%;">
                    </div>
                </div>
                <div data-aos="zoom-out" data-aos-duration="700" class="write-button"
                    style="margin: auto;margin-bottom: 100px;background: #46AA52;padding: 20px 10px;border-radius: 35px;text-align: center;width: 40%;box-shadow: 0px 16px 15px -6px rgba(0,0,0,0.52);">
                    <a href="#sign-up" style="color: #fff;font-weight: 550;">
                        {{ trans('home.free_test') }}
                    </a>
                </div>

            </div>
            {{-- <div class="hide-mobile"
            style="position: absolute;transform: scaleY(-1);width: 30%!important;bottom: -155px;height: 70%;">
            <img src="/assets/default/img/home/home-top.png" alt="" style="width: 69%;height: 38%;">
            </div> --}}
        </section>
        {{-- many parents section --}}
        {{-- <section style="background-color:#86C739;padding:69px 0px;margin-top: 100px;position: relative;">
        <div class="hide-mobile hide-mobile-hero-white"
            style="position: absolute;transform: scaleY(-1);width: 19%!important;top: -24px;right:-108px;height: 38%;">
            <img src="/assets/default/img/home/lighgreen-with-white.jpg" alt="" style="width: 148%;height: 91%;">
        </div>
        <div class="container" style="position: relative;">
            <div style="position: absolute;width: 6%;left:-48px;transform: rotate(-32deg);top: 173px;">
                <img src="/assets/default/img/home/book.png" alt="" style="width: 100%;">
            </div>
            <div style="position: absolute;width: 6%;right:-71px;transform: rotate(32deg);bottom: 173px;">
                <img src="/assets/default/img/home/question_light.png" alt="" style="width: 100%;">
            </div>
            <h3 style="text-align: center;font-size: 29px;margin-bottom: 50px;color:#fff">
                {{ trans('home.a_comprehensive') }}
                <br />
            </h3>
            <div style="width: 40px;background-color:#fff;height: 2px;margin: auto;"></div>
            <div class="improve-img-top" style="margin-top:50px;">
                <div class="row">
                    <div class="col-md-4 col-sm-12 improve-img" style="margin-top: 150px;">
                        <div style="width: 42%;margin:auto;">
                            <img src="/assets/default/img/home/parent_1.png" alt="" style="width: 100%;">
                        </div>
                        <div
                            style="padding: 20px;border-radius: 25px;background-color:#fff;text-align: center;font-weight: 500;margin-top: -8px;">
                            <p style="color:#86C739">Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div style="width: 42%;margin:auto;">
                            <img src="/assets/default/img/home/parent_2.png" alt="" style="width: 100%;">
                        </div>
                        <div
                            style="padding: 20px;border-radius: 25px;background-color:#fff;text-align: center;font-weight: 500;margin-top: -8px;">
                            <p style="color:#86C739">Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 improve-img" style="margin-top: 150px;">
                        <div style="width: 42%;margin:auto;">
                            <img src="/assets/default/img/home/parent_3.png" alt="" style="width: 100%;">
                        </div>
                        <div
                            style="padding: 20px;border-radius: 25px;background-color:#fff;text-align: center;font-weight: 500;margin-top: -8px;">
                            <p style="color:#86C739">Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section> --}}
        {{-- children road map --}}
        <section style="position: relative">
            <div>
                <video class="growth-plans-video" autoplay muted loop
                    style="width: 100%;height: 600px;object-fit: cover;">
                    <source src="/assets/default/img/home/road_map_video.mp4" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
            </div>
            <div class="container" style="position: absolute;top: 0;left:0;right:0;">
                <div class="growth-plans-img" style="width: 15%;margin: auto;padding-top:30px;">
                    <img src="/assets/default/img/home/road_map.png" alt="" style="width: 100%;">
                </div>
                <h3 style="font-weight: 500;color:#fff;text-align:center;font-size:26px;padding-bottom:30px;">
                    {{ trans('home.children_learning') }}
                </h3>
                <ul class="timeline">
                    <li data-year="1" data-text="Seeder"></li>
                    <li data-year="2" data-text="Germinator"></li>
                    <li data-year="3" data-text="Grower"></li>
                    <li data-year="4" data-text="Harvester"></li>
                </ul>
                <div data-aos="zoom-out" data-aos-duration="700" class="growth-plans-learn-more"
                    style="width: 16%;background-color:#46AA52;padding: 17px;text-align: center;border-radius: 30px;margin: auto;">
                    <a href="#" style="color: #fff;font-weight: 500;">{{ trans('home.learn_more') }}</a>
                </div>
            </div>
        </section>
        {{-- Why choose --}}
        <section id="why_choose" style="padding:70px 0px;position: relative;">
            <div class="container">
                <h3 style="text-align: center;font-size: 25px;margin-bottom: 30px;">{{ trans('home.why_choose') }}</h3>
                <div style="width: 40px;background-color:#46AA52;height: 2px;margin: auto;"></div>
                <p style="color: #46AA52;margin-top: 30px;font-weight: 500;font-size: 19px;text-align: center;">
                    {{ trans('home.online_one_on') }}
                </p>
                <div class="row" style="margin-top: 40px;gap:30px;text-align: center;justify-content: center;">
                    <div data-aos="fade-down-right" data-aos-duration="700" class="col-md-3 col-sm-12 mobile-width"
                        style="background-color:#46AA52;padding:30px;border-radius: 20px">
                        <div>
                            <img src="/assets/default/img/home/s1.png" style="width: 60%;">
                        </div>
                        <p style="margin-top: 30px;color:#fff;">
                            {{ trans('home.why_choose_one') }}
                        </p>
                    </div>
                    <div data-aos="fade-down" data-aos-duration="700" class="col-md-3 col-sm-12 mobile-width"
                        style="background-color:#46AA52;padding:30px;border-radius: 20px">
                        <div>
                            <img src="/assets/default/img/home/s2.png" style="width: 60%;">
                        </div>
                        <p style="margin-top: 30px;color:#fff;">
                            {{ trans('home.why_choose_2') }}
                        </p>
                    </div>
                    <div data-aos="fade-down-left" data-aos-duration="700" class="col-md-3 col-sm-12 mobile-width"
                        style="background-color:#46AA52;padding:30px;border-radius: 20px">
                        <div>
                            <img src="/assets/default/img/home/s3.png" style="width: 60%;">
                        </div>
                        <p style="margin-top: 30px;color:#fff;">
                            {{ trans('home.why_choose_3') }}
                        </p>
                    </div>
                    <div data-aos="fade-down-right" data-aos-duration="700" class="col-md-3 col-sm-12 mobile-width"
                        style="background-color:#46AA52;padding:30px;border-radius: 20px">
                        <div>
                            <img src="/assets/default/img/home/s4.png" style="width: 60%;">
                        </div>
                        <p style="margin-top: 30px;color:#fff;">
                            {{ trans('home.why_choose_4') }}
                        </p>
                    </div>
                    <div data-aos="fade-down" data-aos-duration="700" class="col-md-3 col-sm-12 mobile-width"
                        style="background-color:#46AA52;padding:30px;border-radius: 20px">
                        <div>
                            <img src="/assets/default/img/home/s5.png" style="width: 60%;">
                        </div>
                        <p style="margin-top: 30px;color:#fff;">
                            {{ trans('home.why_choose_5') }}
                        </p>
                    </div>
                    <div data-aos="fade-down-left" data-aos-duration="700" class="col-md-3 col-sm-12 mobile-width"
                        style="background-color:#46AA52;padding:30px;border-radius: 20px">
                        <div>
                            <img src="/assets/default/img/home/s6.png" style="width: 60%;">
                        </div>
                        <p style="margin-top: 30px;color:#fff;">
                            {{ trans('home.why_choose_6') }}
                        </p>
                    </div>
                    <div data-aos="fade-down-right" data-aos-duration="700" class="col-md-3 col-sm-12 mobile-width"
                        style="background-color:#46AA52;padding:30px;border-radius: 20px">
                        <div>
                            <img src="/assets/default/img/home/s7-1.png" style="width: 60%;">
                        </div>
                        <p style="margin-top: 30px;color:#fff;">
                            {{ trans('home.why_choose_7') }}
                        </p>
                    </div>
                    <div class="col-md-3 col-sm-12 mobile-width">
                    </div>
                    <div class="col-md-3 col-sm-12"> </div>

                </div>
            </div>
            <div class="hide-mobile"
                style="position: absolute;transform: scaleY(-1);width: 45%!important;bottom: -77px;height: 62%;">
                <img src="/assets/default/img/home/home-top.png" alt="" style="width: 69%;height: 29%;">
            </div>
        </section>
        {{-- plan --}}
        <section style="padding: 80px 0px;background-color:#86C739;position: relative;">
            {{-- <div class="hide-mobile hide-mobile-hero-white"
            style="position: absolute;transform: scaleY(-1);width: 19%!important;top: -23px;right:-108px;height: 38%;">
            <img src="/assets/default/img/home/lighgreen-with-white.jpg" alt="" style="width: 148%;height: 91%;">
            </div> --}}
            <img class="hide-mobile hide-mobile-hero-white" src="/assets/default/img/home/lighgreen-with-white.jpg"
                alt=""
                style="position: absolute;transform: scaleY(-1);width: 21%;top: -1px;right:-122px;height: 34%;">
            <div class="container" style="position: relative;">
                <div class="effciency-laptop"
                    style="position: absolute;width: 6%;left:64px;transform: rotate(-32deg);top: 173px;">
                    <img src="/assets/default/img/home/laptop.png" alt="" style="width: 100%;">
                </div>
                <div class="effciency-light"
                    style="position: absolute;width: 7%;right:200px;transform: rotate(-32deg);bottom: 173px;">
                    <img src="/assets/default/img/home/light.png" alt="" style="width: 100%;">
                </div>
                <h3 style="color: #fff;font-weight: 500;margin-bottom: 40px;text-align: center;font-size: 24px;">
                    {{ trans('home.interactive_lesson') }}
                </h3>
                <div style="width: 40px;background-color:#fff;height: 2px;margin: auto;"></div>
                {{-- plan img --}}
                @if ($local == 'en')
                    <div style="width: 40%;margin:auto;">
                        <img src="/assets/default/img/home/plan.png" alt="" style="width: 100%;">
                    </div>
                @else
                    <div style="width: 40%;margin:auto;">
                        <img src="/assets/default/img/home/Clock.png" alt="" style="width: 100%;">
                    </div>
                @endif

                <div class="effciency-book"
                    style="position: absolute;width: 6%;left:200px;transform: rotate(-32deg);bottom: 0px;">
                    <img src="/assets/default/img/home/book.png" alt="" style="width: 100%;">
                </div>
            </div>
            <div class="hide-mobile"
                style="position: absolute;transform: scaleX(-1);width: 58%!important;bottom: -121px;right: 0px;height: 30%;z-index:1;">
                <img src="/assets/default/img/home/home-top.png" alt="" style="width: 100%;height: 100%;">
            </div>
        </section>
        {{-- After the course --}}
        <section style="position: relative;">
            <div>
                <video class="after_the_course_video" autoplay muted loop
                    style="width: 100%;height: 1000px;object-fit: cover;">
                    <source src="/assets/default/img/home/after_the_course.mp4" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
            </div>
            <div class="container" style="position: absolute;top: 0;left:0;right:0;padding: 70px 0px;">
                <h3 style="color:#fff;margin-bottom: 30px;text-align: center;">
                    {{ trans('home.after_the_course') }}
                </h3>
                <div style="width: 40px;background-color:#fff;height: 2px;margin: auto;"></div>
                @if ($local == 'en')
                    <div class="mobile-circle" style="width: 55%;margin: auto;margin-top: 40px;margin-bottom: 70px;">
                        <img src="/assets/default/img/home/Transparent.png" alt="" style="width: 100%;">

                    </div>
                @else
                    <div class="mobile-circle" style="width: 55%;margin: auto;margin-top: 40px;margin-bottom: 70px;">
                        <img src="/assets/default/img/home/transparent_cn.png" alt="" style="width: 100%;">
                    </div>
                @endif
                {{-- start --}}
                {{-- <div class="circle-div">
                <div class="after_the_course_img" style="width: 12%;margin: auto;">
                    <img src="/assets/default/img/home/after_course.png" alt=""
                        style="width: 100%;margin-left:17px;transform: rotate(280deg);">
                </div>
                <li style="--i:0;">
                    <h3>2000</h3>
                    <p>
                        Primary school
                        high frequency words
                    </p>
                </li>
                <li style="--i:1;">
                    <h3>2000</h3>
                    <p>
                        Primary school
                        high frequency words
                    </p>
                </li>
                <li style="--i:2;">
                    <h3>2000</h3>
                    <p>
                        Primary school
                        high frequency words
                    </p>
                </li>
                <li style="--i:3;">
                    <h3>2000</h3>
                    <p>
                        Primary school
                        high frequency words
                    </p>
                </li>
                <li style="--i:4;">
                    <h3>2000</h3>
                    <p>
                        Primary school
                        high frequency words
                    </p>
                </li>
                <li style="--i:5;">
                    <h3>2000</h3>
                    <p>
                        Primary school
                        high frequency words
                    </p>
                </li>
            </div> --}}
                {{-- end --}}


                <div data-aos="zoom-out" class="after_the_course_button"
                    style="margin-left: 370px;background: #46AA52;padding: 20px 10px;border-radius: 35px;text-align: center;width: 38%;box-shadow: 0px 16px 15px -6px rgba(0,0,0,0.52);">
                    <a href="#sign-up" style="color: #fff;font-weight: 550;">
                        {{ trans('home.free_test') }}
                    </a>
                </div>
            </div>
        </section>
        {{-- Testimonials --}}
        <section id="parent_feedback" style="padding: 50px 0px">
            <div class="container" style="position: relative">

                <div style="position: relative;">
                    <h3 style="font-weight: bold;margin-bottom: 40px;text-align:center;font-size: 26px;">{{ trans('home.parent_feedback') }}
                    </h3>
                    <div style="width: 40px;background-color:#46AA52;height: 2px;margin: auto;"></div>

                    @if (!empty($testimonials) and !$testimonials->isEmpty())
                        <section class="testimonials" style="margin-top: 40px">
                            <div class="container">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="customers-testimonials-2" class="owl-carousel">

                                            <!--TESTIMONIAL 1 -->
                                            @foreach ($testimonials as $testimonial)
                                                <div class="item">
                                                    <div class="shadow-effect">
                                                        <div>
                                                            <img class="img-circle"
                                                                src="/assets/default/img/home/testi_comma.png"
                                                                alt="" />
                                                        </div>

                                                        <h3>{{ $testimonial->user_name }}</h3>
                                                        <p>
                                                            {{ $testimonial->comment }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                    <div style="position: absolute;width: 8%;right:0;top:63px;">
                        <img src="/assets/default/img/home/book.png" alt="" style="width: 100%;">
                    </div>
                </div>

                <div style="position: absolute;width:12%;bottom:-52px;right:-94px;">
                    <img src="/assets/default/img/home/testi_bottom.png" alt="" style="width: 100%;">
                </div>
            </div>
        </section>
        <section id="sign-up" style="background-color:#86C739;padding: 60px 0px;position:relative;">
            <div class="container" style="position:relative;">
                <div style="position: absolute;width: 8%;right:0;top:62px;">
                    <img src="/assets/default/img/home/light.png" alt="" style="width: 100%;">
                </div>
                <div style="position: absolute;width: 8%;top:249px;">
                    <img src="/assets/default/img/home/laptop.png" alt="" style="width: 100%;">
                </div>
                <div style="position: absolute;width: 8%;right:0;bottom:63px;">
                    <img src="/assets/default/img/home/book.png" alt="" style="width: 100%;">
                </div>
                <div>
                    <h3 style="color: #fff;font-weight:bold;margin-bottom:35px;text-align:center;font-size:26px;">
                        {{ trans('home.get_your_child') }}
                        <br />
                        {{ trans('home.get_your_child_extra') }}
                    </h3>
                </div>
                <div style="width: 40px;background-color:#fff;height: 2px;margin: auto;"></div>
                <div style="margin-top: 35px;"></div>
                <div class="footer_sign_up"
                    style="background-color: #fff;border-radius:30px;box-shadow: 0px 0px 13px -6px rgba(0,0,0,0.66);width:41%;padding:21px 30px;margin:auto;">
                    <h3 style="text-align:center;margin-bottom:20px;">{{ trans('home.subscribe_now') }}</h3>
                    <form class="contactForm">

                        <div class="form-group">
                            <input id="name" type="text" placeholder="{{ trans('home.child_name') }}"
                                name="name"
                                style="border: 1px solid #F3F3F3;padding: 15px 20px;width: 100%;border-radius: 20px;"
                                required>
                        </div>

                        <div id="name-error" class="name-error invalid-feedback">

                        </div>

                        <div class="form-group">
                            <input id="age" type="text" maxlength="2"
                                placeholder="{{ trans('home.child_age') }}" name="age"
                                style="border: 1px solid #F3F3F3;padding: 15px 20px;width: 100%;border-radius: 20px;"
                                required>
                        </div>

                        <div class="invalid-feedback age-error">

                        </div>

                        <div class="form-group">
                            <input id="whatsapp" type="text" placeholder="{{ trans('home.whatsapp_number') }}"
                                name="whatsapp"
                                style="border: 1px solid #F3F3F3;padding: 15px 20px;width: 100%;border-radius: 20px;"
                                required>
                        </div>

                        <div class="invalid-feedback whatsapp-error">

                        </div>

                        <div
                            style="background-color:#46AA52;border-radius:30px;padding:20px 15px;text-align:center;width:50%;margin:auto;">
                            <button id="submit"
                                style="color:#fff;background: none;border: none;font-weight: 500;">{{ trans('home.submit') }}</button>
                            <p id="loading" style="color:#fff;background: none;border: none;font-weight: 500;">
                                Loading...</p>
                            <input hidden type="reset" class="hidden reset-button">
                        </div>
                    </form>
                </div>
     
            </div>
            <div class="hide-mobile"
                style="position: absolute;transform: scaleX(-1);width: 39%!important;bottom: -121px;right: 0px;height: 31%;">
                <img src="/assets/default/img/home/home-top.png" alt="" style="width: 100%;height: 100%;">
            </div>
        </section>



        <!-- Back to Top -->
        <a href="#"
            style="position: fixed;
            bottom: 30px;
            right: 30px;
            width: 67px;
            height: 64px;
            z-index: 9999;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.2s ease-out;
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 19px;
            font-size: 14px;
            border-radius: 30px;"
            class="back-to-top">
            {{ trans('home.top') }}
        </a>

    </section>

@endsection

@push('scripts_bottom')
{{-- <script src="/assets/default/js/parts/home.min.js"></script> --}}

<script src="/assets/default/vendors/owl-carousel2/owl.carousel.min.js"></script>

    {{-- <script src="/assets/default/vendors/swiper/swiper-bundle.min.js"></script> --}}
    <script src="/assets/default/vendors/parallax/parallax.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        $(document).ready(function($) {
            "use strict";
            //  TESTIMONIALS CAROUSEL HOOK
            $('#customers-testimonials-2').owlCarousel({
                loop: true,
                center: true,
                items: 3,
                margin: 0,
                autoplay: true,
                dots: true,
                autoplayTimeout: 8500,
                smartSpeed: 450,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    1170: {
                        items: 3
                    }
                }
            });
        });

        //Check to see if the window is top if not then display button

        $(window).scroll(function() {

            // Show button after 100px
            var showAfter = 200;

            if ($(this).scrollTop() > showAfter) {
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }
        });

        //Click event to scroll to top
        $('.back-to-top').click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        setTimeout(function() {
            $('.back-to-top').css('display', 'block');
        }, 4000);
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#loadingMiddle').hide();
            $('.contactFormMiddle').on('submit', function(e) {
                e.preventDefault();
                $('#submitMiddle').hide();
                $('#loadingMiddle').show();
                let name = $('#nameMiddle').val();
                let age = $('#ageMiddle').val();
                let whatsapp = $('#whatsappMiddle').val();
                var formData = $('.contactFormMiddle').serializeArray()
                $.ajax({
                    url: "/sendnewsletters",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        $('#submitMiddle').show();
                        $('#loadingMiddle').hide();
                        if (response) {
                            window.location.href = "/congratulation"
                            //             $('#success-message').text(response.success);
                            //             $(".reset-button").trigger('click');
                            //             $('.name-error').css('display', 'none');
                            //             $('.age-error').css('display', 'none');
                            //             $('.whatsapp-error').css('display', 'none');
                            //             Swal.fire({
                            //     icon:  `${response.sweetalert.status}`,
                            //     html: `<h3 class="font-20 text-center text-dark-blue py-25">${response.sweetalert.msg}</h3>`,
                            //     showConfirmButton: false,
                            //     width: '25rem',
                            // });
                        }
                    },
                    error: function(response) {
                        $('#loadingMiddle').hide();
                        $('#submitMiddle').show();
                        $('.name-error-middle').text(response.responseJSON.errors.name).css(
                            'display',
                            'block');
                        $('.age-error-middle').text(response.responseJSON.errors.age).css(
                            'display',
                            'block');
                        $('.whatsapp-error-middle').text(response.responseJSON.errors.whatsapp)
                            .css(
                                'display', 'block');
                    }
                });
            });
            $('#loading').hide();
            $('.contactForm').on('submit', function(e) {
                e.preventDefault();
                $('#submit').hide();
                $('#loading').show();
                let name = $('#name').val();
                let age = $('#age').val();
                let whatsapp = $('#whatsapp').val();
                var formData = $('.contactForm').serializeArray()
                $.ajax({
                    url: "/sendnewsletters",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        $('#submit').show();
                        $('#loading').hide();
                        if (response) {
                            window.location.href = "/congratulation"
                        }
                    },
                    error: function(response) {
                        $('#loading').hide();
                        $('#submit').show();
                        $('.name-error').text(response.responseJSON.errors.name).css('display',
                            'block');
                        $('.age-error').text(response.responseJSON.errors.age).css('display',
                            'block');
                        $('.whatsapp-error').text(response.responseJSON.errors.whatsapp).css(
                            'display', 'block');
                    }
                });
            });
        })
    </script>
    <script>
        (function($) {
            "use strict";

            @if (session()->has('sweetalert'))
                Swal.fire({
                    icon: "{{ session()->get('sweetalert')['status'] ?? 'success' }}",
                    html: '<h3 class="font-20 text-center text-dark-blue py-25">{{ session()->get('sweetalert')['msg'] ?? '' }}</h3>',
                    showConfirmButton: false,
                    width: '25rem',
                });
            @endif
        })(jQuery)
    </script>
@endpush
