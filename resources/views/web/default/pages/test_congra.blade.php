@extends(getTemplate() . '.layouts.app')

@section('content')
    <section style="padding-top:60px;padding-bottom: 150px; ">
        <div class="container">
            <div class="congra-img">
                <img src="/assets/default/img/home/test_congra.png" alt="">
            </div>
            <p class="congra-para">
                You are free entitled to get an online language test.
                <br />
                Our tutor will arrange a session with you as soon as possible.
            </p>
            <div class="back-to-home">
                <a href="/" style="color: #fff;">Back to homepage</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts_bottom')
@endpush
