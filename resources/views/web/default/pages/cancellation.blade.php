@extends(getTemplate() . '.layouts.app')

@section('content')
    <section style="padding-top:60px;padding-bottom: 150px; ">
        <div class="container">
            <h3 class="privacy-h3" style="text-align: center;margin-bottom: 45px;font-size: 30px;">
                {{ trans('home.cancellation-and-refund-policy') }}</h3>
            <div style="width: 40px;background-color:#86c739;height: 2px;margin: auto;"></div>
            <div class="privacy-img" style="width: 21%;margin: auto;margin-top: 45px;">
                <img src="/assets/default/img/home/cancel.png" alt="" style="width:100%">
            </div>
            <div style="margin: 55px;">
                <h4 class="privacy-h4" style="text-align: center;font-size: 25px;color: #46aa52;margin-bottom: 40px;">
                    {{ trans('home.no-refund-and-no-cancellation-policy') }}
                </h4>
                <p class="privacy-p" style="color: #46aa52;text-align: center;line-height: 34px;">
                    {{ trans('home.no-refund-and-no-cancellation-policy-desc') }}

                </p>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
@endpush
