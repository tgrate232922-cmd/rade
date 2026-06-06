@extends('frontend::layouts.auth')

@section('title')
    {{ __('Login') }}
@endsection

@section('content')
<section class="modern-login-section">
    <div class="login-container">
        <!-- Logo -->
        <div class="logo-container">
            <a href="{{ route('home') }}">
                <img src="{{ asset(setting('site_logo','global')) }}" alt="logo" class="login-logo">
            </a>
        </div>

        <!-- Login Card -->
        <div class="login-card">
            <!-- Icon/Avatar -->
            <div class="icon-wrapper">
                <svg class="user-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </div>

            <!-- Title -->
            <h1 class="login-title">{{ $data['title'] }}</h1>
            <p class="login-subtitle">{{ $data['bottom_text'] }}</p>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="error-message">
                    @foreach($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" class="login-form">
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">{{ __('Email Or Username') }}</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <input 
                            type="text" 
                            id="email" 
                            name="email" 
                            placeholder="your@email.com"
                            value="{{ old('email') }}"
                            required 
                        >
                    </div>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>
                    <div class="input-wrapper">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Enter your password"
                            required
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Google reCAPTCHA -->
                @if($googleReCaptcha)
                    <div class="g-recaptcha mb-3" id="feedback-recaptcha"
                         data-sitekey="{{ json_decode($googleReCaptcha->data,true)['google_recaptcha_key'] }}">
                    </div>
                @endif

                <!-- Remember & Forgot -->
                <div class="form-options">
                    <label class="remember-checkbox">
                        <input type="checkbox" name="remember" id="remember">
                        <span>{{ __('Remember me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">{{ __('Forget Password') }}</a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="login-button">
                    {{ __('Account Login') }}
                </button>

                <!-- Register Link -->
                <div class="register-link">
                    {{ __("Don't have an account?") }} <a href="{{route('register')}}">{{ __('Join Our Community') }}</a>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    }
</script>
@endsection

@section('script')
    @if($googleReCaptcha)
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
@endsection