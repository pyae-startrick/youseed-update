@extends(getTemplate() . '.layouts.app')

@push('styles_top')
    <link rel="stylesheet" href="/assets/default/vendors/select2/select2.min.css">
@endpush

@section('content')
    @php
    $registerMethod = getGeneralSettings('register_method') ?? 'mobile';
    @endphp

    <div class="container">
        <div class="row login-container">
            <div class="col-12 col-md-6 pl-0">
                <img src="/assets/default/img/home/online.gif" class="img-cover" style="height:auto!important; ">
            </div>
            <div class="col-12 col-md-6">
                <div class="login-card">
                    <h1 class="font-20 font-weight-bold">{{ trans('home.sign_up') }}</h1>

                    <form method="post" action="/register" class="mt-35" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @if ($registerMethod == 'mobile')
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label class="input-label" for="mobile">{{ trans('auth.country') }}:</label>
                                        <select name="country_code" class="form-control select2">
                                            @foreach (getCountriesMobileCode() as $country => $code)
                                                <option value="{{ $code }}"
                                                    @if ($code == old('country_code')) selected @endif>{{ $country }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('mobile')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-7">
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="mobile">{{ trans('auth.' . $registerMethod) }}:</label>
                                        <input name="mobile" type="text"
                                            class="form-control @error('mobile') is-invalid @enderror"
                                            value="{{ old('mobile') }}" id="mobile" aria-describedby="mobileHelp">

                                        @error('mobile')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label class="input-label" for="email">{{ trans('home.email') }}:</label>
                                <input name="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    id="email" aria-describedby="emailHelp">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="input-label" for="full_name"><span style="color: red;">*</span>{{ trans('home.full_name') }}:</label>
                            <input name="full_name" type="text" value="{{ old('full_name') }}"
                                class="form-control @error('full_name') is-invalid @enderror" required>
                            @error('full_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="age"><span style="color: red;">*</span>{{ trans('home.age') }}:</label>
                            <input name="age" type="number" value="{{ old('age') }}"
                                class="form-control @error('age') is-invalid @enderror">
                            @error('age')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="about">{{ trans('home.about-you') }}:</label>
                            <textarea name="about" value="{{ old('about') }}" class="form-control @error('about') is-invalid @enderror" cols="30" rows="5"></textarea>
                            @error('about')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="input-label" for="password"><span style="color: red;">*</span>{{ trans('home.pass') }}:</label>
                            <input name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                aria-describedby="passwordHelp">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group ">
                            <label class="input-label"
                                for="confirm_password"><span style="color: red;">*</span>{{ trans('home.retype_pass') }}:</label>
                            <input name="password_confirmation" type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="confirm_password" aria-describedby="confirmPasswordHelp">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- @if (getFeaturesSettings('timezone_in_register'))
                            @php
                                $selectedTimezone = getGeneralSettings('default_time_zone');
                            @endphp

                            <div class="form-group">
                                <label class="input-label">{{ trans('update.timezone') }}</label>
                                <select name="timezone" class="form-control select2" data-allow-clear="false">
                                    <option value="" {{ empty($user->timezone) ? 'selected' : '' }} disabled>
                                        {{ trans('public.select') }}</option>
                                    @foreach (getListOfTimezones() as $timezone)
                                        <option value="{{ $timezone }}"
                                            @if ($selectedTimezone == $timezone) selected @endif>{{ $timezone }}</option>
                                    @endforeach
                                </select>
                                @error('timezone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif --}}

                        {{-- @if (!empty($referralSettings) and $referralSettings['status'])
                            <div class="form-group ">
                                <label class="input-label"
                                    for="referral_code">{{ trans('financial.referral_code') }}:</label>
                                <input name="referral_code" type="text"
                                    class="form-control @error('referral_code') is-invalid @enderror" id="referral_code"
                                    value="{{ !empty($referralCode) ? $referralCode : old('referral_code') }}"
                                    aria-describedby="confirmPasswordHelp">
                                @error('referral_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        @endif --}}


                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="term" value="1"
                                {{ (!empty(old('term')) and old('term') == '1') ? 'checked' : '' }}
                                class="custom-control-input @error('term') is-invalid @enderror" id="term">
                            <label class="custom-control-label font-14" for="term"
                                style="color: #46aa52!important;">{{ trans('home.i_agree') }}
                                <a href="term-condition" target="_blank" class="text-secondary font-weight-bold font-14"
                                    style="color: #46aa52!important;">{{ trans('home.term_rule') }}</a>
                            </label>

                            @error('term')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @error('term')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <button type="submit"
                            class="btn btn-primary btn-block mt-20">{{ trans('home.sign_up') }}</button>
                    </form>

                    <div class="text-center mt-20">
                        <span class="text-secondary" style="color: #46aa52!important;">
                            {{ trans('home.already_have_an_account') }}
                            <a href="/login" class="text-secondary font-weight-bold"
                                style="color: #46aa52!important;">{{ trans('home.login') }}</a>
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_bottom')
    <script src="/assets/default/vendors/select2/select2.min.js"></script>
@endpush
