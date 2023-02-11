@extends(getTemplate() . '.layouts.app')

@section('content')
    <section style="padding-top:60px;padding-bottom: 150px; ">
        <div class="container">
            <h3 class="privacy-h3" style="text-align: center;margin-bottom: 45px;font-size: 30px;">{{trans('home.privacy-&-policy')}}</h3>
            <div style="width: 40px;background-color:#86c739;height: 2px;margin: auto;"></div>
            <div class="privacy-img" style="width: 21%;margin: auto;margin-top: 45px;">
                <img src="/assets/default/img/home/provacy.png" alt="" style="width:100%">
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   {{trans('home.your-privacy')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.your-privacy-desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   {{trans('home.your-consent')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.your-consent-desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   {{trans('home.communication-&-marketing')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.communication-&-marketing-desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   {{trans('home.what-are-cookies')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.what-are-cookies-desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   {{trans('home.site-statistics')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.site-statistics-desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   {{trans('home.disclosures-of-your-information')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.disclosures-of-your-information-desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   {{trans('home.third-party-sites')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.third-party-sites-desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   {{trans('home.checking-your-details')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.checking-your-details-desc')}}
                </p>
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                   {{trans('home.contacting-us')}}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{trans('home.contacting-us-desc')}}
                </p>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
@endpush
