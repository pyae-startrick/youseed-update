@extends(getTemplate() . '.layouts.app')

@section('content')
    <section style="padding-top:60px;padding-bottom: 150px; ">
        <div class="container">
            <h3 class="privacy-h3" style="text-align: center;margin-bottom: 28px;font-size: 30px;">{{trans('home.term')}}</h3>
            <div style="width: 40px;background-color:#86c739;height: 2px;margin: auto;"></div>
            <p style="margin-top: 28px;">
               {{trans('home.term_welcome')}}
            </p>
            <div class="privacy-img" style="width: 21%;margin: auto;margin-top: 45px;">
                <img src="/assets/default/img/home/term.png" alt="" style="width:100%">
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   {{trans('home.general')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                   {{trans('home.general_desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                    {{trans('home.site_content')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.site_content_desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                    {{trans('home.comm-feed')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.comm-feed-desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                    {{trans('home.product_information')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.product_information_desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                    {{trans('home.newsletter')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.newsletter_desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                    {{trans('home.indemnification')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.indemnification_desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                    {{trans('home.link-to-other-sites')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.link-to-other-sites-desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                    {{trans('home.inaccuracy-information')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.inaccuracy-information-desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                    {{trans('home.termination')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.termination-desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                    {{trans('home.payments')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.payments-desc')}}
                </p>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
@endpush
