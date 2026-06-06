@extends('frontend::layouts.auth')

@section('title')
{{ __('Register') }}
@endsection

@section('content')
<section class="modern-login-section">
    <div class="login-container register-container">
        <!-- Logo -->
        <div class="logo-container">
            <a href="{{ route('home') }}">
                <img src="{{ asset(setting('site_logo','global')) }}" alt="logo" class="login-logo">
            </a>
        </div>

        <!-- Register Card -->
        <div class="login-card">
            <!-- Icon/Avatar -->
            <div class="icon-wrapper">
                <svg class="user-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>

            <!-- Title -->
            <h1 class="login-title">{{ $data['title'] }}</h1>
            <p class="login-subtitle">{{ $data['bottom_text'] }}</p>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="error-message">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <!-- Register Form -->
            <form action="{{ route('register') }}" id="signUpForm" method="POST" class="login-form">
                @csrf

                <!-- First Name & Last Name -->
                <div class="form-row">
                    <div class="form-group form-group-half">
                        <label for="first_name">{{ __('First Name') }}</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <input 
                                type="text" 
                                name="first_name" 
                                placeholder="First name"
                                value="{{ old('first_name') }}"
                                required 
                            >
                        </div>
                    </div>

                    <div class="form-group form-group-half">
                        <label for="last_name">{{ __('Last Name') }}</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <input 
                                type="text" 
                                name="last_name" 
                                placeholder="Last name"
                                value="{{ old('last_name') }}"
                                required 
                            >
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">{{ __('Email Address') }}</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="your@email.com"
                            value="{{ old('email') }}"
                            required 
                        >
                    </div>
                </div>

                <!-- Username & Country Row -->
                <div class="form-row">
                    @if(getPageSetting('username_show'))
                    <div class="form-group form-group-half">
                        <label for="username">{{ __('Username') }}</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <input 
                                type="text" 
                                name="username" 
                                placeholder="Choose username"
                                value="{{ old('username') }}"
                                required 
                            >
                        </div>
                    </div>
                    @endif

                    @if(getPageSetting('country_show'))
                    <div class="form-group {{ getPageSetting('username_show') ? 'form-group-half' : '' }}">
                        <label for="countrySelect">{{ __('Select Country') }}</label>
                        <div class="input-wrapper select-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <select name="country" id="countrySelect" required>
                                @foreach(getCountries() as $country)
                                <option @if($location->country_code == $country['code']) selected @endif 
                                    value="{{ $country['name'].':'.$country['dial_code'] }}">
                                    {{ $country['name'] }}
                                </option>
                                @endforeach
                            </select>
                            <svg class="select-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Phone & Referral Row -->
                <!-- Phone & Referral Row -->
<div class="form-row">
    <!-- Phone Field - Always Show for Testing -->
    <div class="form-group {{ getPageSetting('referral_code_show') ? 'form-group-half' : '' }}">
        <label for="phone">{{ __('Phone Number') }}</label>
        <div class="input-wrapper phone-wrapper">
            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
            <span class="dial-code" id="dial-code">{{ getLocation()->dial_code }}</span>
            <input 
                type="text" 
                name="phone" 
                placeholder="Phone number"
                value="{{ old('phone') }}"
                class="phone-input"
            >
        </div>
    </div>

    @if(getPageSetting('referral_code_show'))
    <div class="form-group form-group-half">
        <label for="invite">{{ __('Referral Code') }} <span style="color: rgba(255,255,255,0.5); font-weight: normal;">({{ __('Optional') }})</span></label>
        <div class="input-wrapper">
            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <input 
                type="text" 
                name="invite" 
                placeholder="Referral code"
                value="{{ request('invite') ?? old('invite') }}"
            >
        </div>
    </div>
    @endif
</div>

                <!-- Password & Confirm Password -->
                <div class="form-row">
                    <div class="form-group form-group-half">
                        <label for="password">{{ __('Password') }}</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="Password"
                                required
                            >
                            <button type="button" class="toggle-password" onclick="togglePassword('password')">
                                <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-group form-group-half">
                        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                        <div class="input-wrapper">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                placeholder="Confirm password"
                                required
                            >
                            <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                                <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Google reCAPTCHA -->
                @if($googleReCaptcha)
                    <div class="g-recaptcha" id="feedback-recaptcha"
                         data-sitekey="{{ json_decode($googleReCaptcha->data,true)['google_recaptcha_key'] }}">
                    </div>
                @endif

                <!-- Terms & Conditions -->
                <div class="form-checkbox">
                    <label class="remember-checkbox">
                        <input type="checkbox" name="i_agree" value="yes" id="terms_condition" required>
                        <span>
                            {{ __('I agree with') }} 
                            <a href="../../index.html" target="_blank">{{ __('Privacy & Policy') }}</a> 
                            {{ __('and') }} 
                            <a href="../../index.html" target="_blank">{{ __('Terms & Condition') }}</a>
                        </span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="login-button" form="signUpForm">
                    {{ __('Launch Now') }}
                </button>

                <!-- Login Link -->
                <div class="register-link">
                    {{ __("Already have an account?") }} <a href="{{route('login')}}">{{ __('Login') }}</a>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function togglePassword(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    }

    // Country select change handler
    document.getElementById('countrySelect').addEventListener('change', function(e) {
        var country = this.value;
        document.getElementById('dial-code').innerHTML = country.split(":")[1];
    });
</script>
@endsection

@section('script')
@if($googleReCaptcha)
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endif
@endsection