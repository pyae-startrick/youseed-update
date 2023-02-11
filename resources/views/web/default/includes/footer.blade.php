@php
$socials = getSocials();
if (!empty($socials) and count($socials)) {
    $socials = collect($socials)
        ->sortBy('order')
        ->toArray();
}

$footerColumns = getFooterColumns();
@endphp

<footer class="" style="background-color:#46aa52;padding: 100px 0px 60px;">
    <div class="container">
        <div class="row" style="color: #fff;">
            <div class="col-md-4 col-sm-12">
                <h3 style="font-weight: 500;margin-bottom: 30px">{{ trans('home.our_address') }}</h3>
                <p>
                    No 40-2, Jalan Tanjung SD 13/1,
                    <br />
                    Bandar Sri Damansara,
                    <br />
                    52200 Kuala Lumpur
                </p>
            </div>
            <div class="col-md-4 col-sm-12 footer_useful">
                <h3 style="font-weight: 500;margin-bottom: 30px">{{ trans('home.useful_link') }}</h3>
                <ul>
                    <li style="padding: 0px 0px 20px;">
                        <a href="#about_us" style="color: #fff;">{{ trans('home.about_us') }}</a>
                    </li>
                    <li style="padding: 0px 0px 20px;">
                        <a href="#course_intro" style="color: #fff;">
                            {{ trans('home.course_intro') }}
                        </a>
                    </li>
                    <li style="padding: 0px 0px 20px;">
                        <a href="#language_plan" style="color: #fff;">{{ trans('home.language_plan') }}</a>
                    </li>
                    <li style="padding: 0px 0px 20px;">
                        <a href="#why_choose" style="color: #fff;">{{ trans('home.why_choose_us') }}</a>
                    </li>
                    <li style="padding: 0px 0px 20px;">
                        <a href="#parent_feedback" style="color: #fff;">{{ trans('home.praise_from_parents') }}</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="footer_social" style="display: flex;justify-content: space-between;margin-bottom: 20px;">
                    <i class="footer_social_icon" data-feather="mail" width="30" height="30"></i>
                    <a href="mailto:youseededucation@gmail.com" style="color: #fff;">youseededucation@gmail.com</a>
                </div>
                {{-- <div class="footer_social" style="display: flex;margin-bottom: 20px;">
                    <i class="footer_social_icon" data-feather="phone" width="30" height="30"></i>
                    <a href="tel:0362630202" style="color: #fff;padding-left: 70px;">03 - 6263 0202</a>
                </div> --}}
                <div class="footer_social" style="display: flex;justify-content: space-between;margin-bottom: 20px;padding-right: 97px;">
                    <a href="https://www.facebook.com/%E4%BC%98%E8%8B%97%E6%95%99%E8%82%B2-YouSeed-109881341362395" target="_blank" style="color: #fff;">
                        <i class="footer_social_icon" data-feather="facebook" width="30" height="30"></i>
                    </a>
                    <a href="https://www.facebook.com/%E4%BC%98%E8%8B%97%E6%95%99%E8%82%B2-YouSeed-109881341362395" target="_blank" style="color: #fff;">
                        YouSeed Facebook
                    </a>
                </div>
            </div>
            <div class="col-md-8 col-sm-12">
                <h3 style="font-weight: 500;margin-bottom: 30px">{{ trans('home.about_us') }}</h3>
                <p>
                    {{ trans('home.about_us_desc_footer') }}
                </p>
                <div
                    style="padding:20px 0px;background-color: #86c739;width: 33%;text-align:center;border-radius:30px;margin: 175px 0px 30px;font-weight: bold;box-shadow: 0px 0px 13px -6px rgba(0,0,0,0.66);">
                    <a href="#sign-up" style="color: #fff">{{ trans('home.get_start') }}</a>
                </div>

            </div>
            <div class="col-md-4 col-sm-12">
                <h3 style="font-weight: 500;margin-bottom: 30px">{{ trans('home.our_newsletter') }}</h3>
                <p style="margin-bottom: 30px">
                    {{ trans('home.our_news_letter_every') }}
                </p>
                <p>
                    {{ trans('home.our_news_letter_educators') }}
                </p>
                <div style="margin-top: 30px;display:none!important;"
                    class=" footer-subscribe d-block d-md-flex align-items-center justify-content-between">
                    <div style="border-radius: 30px;" class="subscribe-input bg-white p-10 flex-grow-1 mt-30 mt-md-0">
                        <form action="/newsletters" method="post">
                            {{ csrf_field() }}

                            <div class="form-group d-flex align-items-center m-0">
                                <div class="w-67">
                                    <input type="text" name="newsletter_email"
                                        class="form-control border-0 @error('newsletter_email') is-invalid @enderror"
                                        placeholder="{{ trans('footer.enter_email_here') }}" />
                                    @error('newsletter_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- <button style="width: 50%;background-color: #86c739;color:#fff;" type="submit"
                                    class="btn rounded-pill">Subscribe Now</button> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_copyright" style="display: flex;justify-content:space-between;margin-top: 50px;">
            <div>
                <div style="display: flex">
                    <div style="margin-right: 20px">
                        <a href="/privacy-policy" style="color: #fff">{{ trans('home.policy') }}</a>
                    </div>
                    <div style="margin-right: 20px">
                        <a href="/term-condition" style="color: #fff">{{ trans('home.terms') }}</a>
                    </div>
                    <div>
                        <a href="/cancellation" style="color: #fff">{{ trans('home.cancellation') }}</a>
                    </div>
                </div>
            </div>
            <div class="footer_reserved" style="color: #fff">
                {{ trans('home.all_rights_reserved') }} © <?= date('Y') ?> {{ trans('home.youseed') }}
            </div>
        </div>
    </div>
</footer>
