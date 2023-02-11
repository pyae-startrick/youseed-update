@extends(getTemplate() . '.layouts.app')

@section('content')
    <div class="container">
        @if (!empty(session()->has('msg')))
            <div class="alert alert-info alert-dismissible fade show mt-30" role="alert">
                {{ session()->get('msg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

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
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            {{-- <label class="input-label" for="username">{{ trans('auth.email_or_mobile') }}:</label> --}}
                            <input style="border: 1px solid #000;padding: 25px 10px;border-radius: 15px;" name="child_name"
                                type="text" class="form-control @error('child_name') is-invalid @enderror"
                                id="child_name" value="{{ old('child_name') }}" placeholder="Child's Name*" required>
                            @error('child_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            {{-- <label class="input-label" for="password">{{ trans('auth.password') }}:</label> --}}
                            <input style="border: 1px solid #000;padding: 25px 10px;border-radius: 15px;" name="child_age"
                                type="child_age" class="form-control @error('child_age') is-invalid @enderror"
                                id="child_age" placeholder="Child's Age*">

                            @error('child_age')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            {{-- <label class="input-label" for="password">{{ trans('auth.password') }}:</label> --}}
                            <input style="border: 1px solid #000;padding: 25px 10px;border-radius: 15px;"
                                name="WhatsApp Number*" type="WhatsApp Number*"
                                class="form-control @error('WhatsApp Number*') is-invalid @enderror" id="WhatsApp Number*"
                                placeholder="WhatsApp Number*">

                            @error('WhatsApp Number*')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-block mt-20 submit-but"
                            style="background-color: #46aa52;color:#fff;">Submit</button>
                    </form>

                    {{-- <div class="text-center mt-20">
                        <span
                            class="badge badge-circle-gray300 text-secondary d-inline-flex align-items-center justify-content-center">{{ trans('auth.or') }}</span>
                    </div> --}}

                    {{-- <a href="/google" target="_blank"
                        class="social-login mt-20 p-10 text-center d-flex align-items-center justify-content-center">
                        <img src="/assets/default/img/auth/google.svg" class="mr-auto" alt=" google svg" />
                        <span class="flex-grow-1">{{ trans('auth.google_login') }}</span>
                    </a> --}}

                    {{-- <a href="{{ url('/facebook/redirect') }}" target="_blank"
                        class="social-login mt-20 p-10 text-center d-flex align-items-center justify-content-center ">
                        <img src="/assets/default/img/auth/facebook.svg" class="mr-auto" alt="facebook svg" />
                        <span class="flex-grow-1">{{ trans('auth.facebook_login') }}</span>
                    </a> --}}

                    {{-- <div class="mt-30 text-center">
                        <a href="/forget-password" target="_blank"
                            style="color:#46aa52">{{ trans('auth.forget_your_password') }}</a>
                    </div> --}}

                    {{-- <div class="mt-20 text-center">
                        <span>{{ trans('auth.dont_have_account') }}</span>
                        <a href="/register" class="text-secondary font-weight-bold">{{ trans('auth.signup') }}</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
