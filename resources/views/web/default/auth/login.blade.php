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

            <div class="col-12 col-md-6 pl-0">
                <div class="login_img_div">
                    <img src="/assets/default/img/home/login_front.png" class="img-cover" alt="Login"
                        style="height:auto!important; ">

                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-width" style="width: 83%;margin: auto;">
                    {{-- <h1 class="font-20 font-weight-bold">{{ trans('auth.login_h1') }}</h1> --}}
                    <h1 class="font-23 font-weight-bold text-center">{{ trans('home.login_to_your_acc')}}</h1>

                    <form method="Post" action="/login" class="mt-35">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            {{-- <label class="input-label" for="username">{{ trans('auth.email_or_mobile') }}:</label> --}}
                            <input name="username" type="text"
                                class="form-control @error('username') is-invalid @enderror" id="username"
                                value="{{ old('username') }}" aria-describedby="emailHelp"
                                placeholder="Enter Student ID or email" required
                                style="border: 1px solid #000!important;padding: 1.5rem 1rem!important;border-radius: 0.8rem!important;">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group" style="position: relative">
                            {{-- <label class="input-label" for="password">{{ trans('auth.password') }}:</label> --}}
                            <input name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                aria-describedby="passwordHelp" placeholder="{{trans('home.password')}}" required
                                style="border: 1px solid #000!important;padding: 1.5rem 1rem!important;border-radius: 0.8rem!important;">
                            <i data-feather="eye-off" width="20" height="20" class="mr-10"
                                style="position: absolute;right: 9px;top: 14px;cursor: pointer;" onclick="myFunction()"></i>

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mt-20 pl-25">
                            <a href="/forget-password" target="_blank" style="color:#46aa52">{{trans('home.forgot_password')}}</a>
                        </div>

                        <div style="display: flex">
                            <button type="submit" class="btn btn-block mt-20"
                                style="margin-right:14px;background-color: #46aa52;color:#fff;width: 40%!important;border-radius: 30px!important;">{{ trans('home.login') }}</button>

                            <div class="form-group mobile-remember"
                                style="background-color: #f3f3f3;padding: 15px 35px;border-radius: 30px;width: 60%;align-self: center;margin-top: 20px;">
                                <div class="custom-control custom-checkbox" style="color: #46aa52;">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                        id="remember-me">
                                    <label class="custom-control-label"
                                        for="remember-me">{{ trans('home.remember_me') }}</label>
                                </div>
                            </div>

                        </div>
                        <div class="mt-20 text-center">
                            <span>{{ trans('home.dont_have_acc') }}</span>
                            <a href="/register" class="text-secondary font-weight-bold"
                                style="color: #46aa52!important;">{{ trans('home.sign_up') }}</a>
                        </div>

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



                    {{-- <div class="mt-20 text-center">
                        <span>{{ trans('auth.dont_have_account') }}</span>
                        <a href="/register" class="text-secondary font-weight-bold">{{ trans('auth.signup') }}</a>
                    </div> --}}
                </div>

                {{-- Register --}}


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



                {{-- <div class="mt-20 text-center">
                        <span>{{ trans('auth.dont_have_account') }}</span>
                        <a href="/register" class="text-secondary font-weight-bold">{{ trans('auth.signup') }}</a>
                    </div> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>
@endsection

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
