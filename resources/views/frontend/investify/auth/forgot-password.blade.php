@extends('frontend::layouts.auth')
@section('title')
{{ __('Forgot password') }}
@endsection

@section('content')
<style>
body{
    background:
        radial-gradient(circle at top right, rgba(59,130,246,.18), transparent 30%),
        radial-gradient(circle at bottom left, rgba(34,211,238,.10), transparent 34%),
        linear-gradient(135deg,#07111f 0%,#0b1728 48%,#111827 100%) !important;
}

.rock-auth-main,
.reset-card{
    background:rgba(15,23,42,.92) !important;
    border:1px solid rgba(148,163,184,.22) !important;
    box-shadow:0 22px 55px rgba(0,0,0,.45) !important;
}

.rock-auth-content .title,
.reset-title,
h3{
    color:#ffffff !important;
}

.rock-auth-content .description,
.reset-desc,
.rock-auth-bottm .description,
p{
    color:rgba(226,232,240,.72) !important;
}

.rock-input-label,
label{
    color:rgba(226,232,240,.86) !important;
}

.input-field input,
input[type="email"]{
    background:rgba(30,41,59,.95) !important;
    border:1px solid rgba(148,163,184,.28) !important;
    color:#ffffff !important;
}

.input-field input::placeholder,
input::placeholder{
    color:rgba(226,232,240,.45) !important;
}

.rock-auth-bottm a,
a{
    color:#60a5fa !important;
}
</style>

<div style="
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
    position:relative;
    z-index:9999;
">

    <div style="
        width:100%;
        max-width:480px;
        background:rgba(255,255,255,.07);
        border:1px solid rgba(148,163,184,.22);
        border-radius:24px;
        padding:32px 26px;
        box-shadow:0 22px 55px rgba(0,0,0,.45);
        backdrop-filter:blur(18px);
        color:#fff;
    ">

        <div style="text-align:center;margin-bottom:24px;">
            <a href="{{ route('home') }}">
                <img src="{{ asset(setting('site_logo','global')) }}" alt="logo" style="max-height:48px;margin-bottom:22px;">
            </a>

            <h3 style="font-size:28px;font-weight:800;color:#fff;margin-bottom:10px;">
                {{ $data['title'] ?? __('Forgot Password') }}
            </h3>

            <p style="font-size:14px;line-height:1.7;color:rgba(226,232,240,.72);margin:0;">
                {{ $data['bottom_text'] ?? __('Enter your email address and we will send you a password reset link.') }}
            </p>
        </div>

        @if ($errors->any())
            <div style="background:rgba(239,68,68,.15);border:1px solid rgba(239,68,68,.25);color:#fecaca;padding:12px;border-radius:12px;margin-bottom:16px;font-size:13px;">
                @foreach($errors->all() as $error)
                    <strong>{{ $error }}</strong><br>
                @endforeach
            </div>
        @endif

        @if(session('status'))
            <div style="background:rgba(34,197,94,.15);border:1px solid rgba(34,197,94,.25);color:#bbf7d0;padding:12px;border-radius:12px;margin-bottom:16px;font-size:13px;">
                <strong>{{ session('status') }}</strong>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <div style="margin-bottom:18px;">
                <label style="display:block;color:rgba(226,232,240,.82);font-size:13px;font-weight:700;margin-bottom:8px;">
                    {{ __('Email Address') }}
                </label>

                <input
                    type="email"
                    name="email"
                    required
                    value="{{ old('email') }}"
                    style="
                        width:100%;
                        height:52px;
                        border-radius:14px;
                        background:rgba(15,23,42,.78);
                        border:1px solid rgba(148,163,184,.25);
                        color:#fff;
                        padding:0 15px;
                        outline:none;
                    "
                >
            </div>

            <button type="submit" style="
                width:100%;
                min-height:52px;
                border-radius:14px;
                border:none;
                background:linear-gradient(135deg,#2563eb,#38bdf8);
                color:#fff;
                font-size:14px;
                font-weight:800;
                cursor:pointer;
            ">
                {{ __('Email Password Reset Link') }}
            </button>
        </form>

        <div style="text-align:center;margin-top:20px;font-size:13px;color:rgba(226,232,240,.68);">
            {{ __("Already have an account?") }}
            <a href="{{ route('login') }}" style="color:#60a5fa;font-weight:800;">
                {{ __('Login') }}
            </a>
        </div>

    </div>
</div>


@endsection
