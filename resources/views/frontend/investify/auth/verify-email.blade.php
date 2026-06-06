@extends('frontend::layouts.auth')

@section('title')
    {{ __('Verify Email') }}
@endsection

@section('content')

<style>
body{
    background:
        radial-gradient(circle at top right, rgba(59,130,246,.18), transparent 30%),
        radial-gradient(circle at bottom left, rgba(34,211,238,.10), transparent 34%),
        linear-gradient(135deg,#07111f 0%,#0b1728 48%,#111827 100%) !important;
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
    background:rgba(15,23,42,.92);
">
    <div style="
        width:100%;
        max-width:500px;
        background:rgba(15,23,42,.92);
        border:1px solid rgba(148,163,184,.22);
        border-radius:24px;
        padding:34px 28px;
        box-shadow:0 22px 55px rgba(0,0,0,.45);
        backdrop-filter:blur(18px);
        color:#fff;
        text-align:center;
    ">
        <a href="{{ route('home') }}">
            <img src="{{ asset(setting('site_logo','global')) }}" alt="logo" style="max-height:50px;margin-bottom:24px;">
        </a>

        <h3 style="font-size:28px;font-weight:800;color:#fff;margin-bottom:12px;">
            {{ __('Verify Your Email') }}
        </h3>

        <p style="font-size:14px;line-height:1.7;color:rgba(226,232,240,.72);margin-bottom:24px;">
    Check your inbox for the verification link.<br>
    If you do not see it, check your spam or junk folder.
</p>

        @if (session('status') == 'verification-link-sent')
            <div style="background:rgba(34,197,94,.15);border:1px solid rgba(34,197,94,.25);color:#bbf7d0;padding:12px;border-radius:12px;margin-bottom:16px;font-size:13px;">
                {{ __('A new verification link has been sent to your email address.') }}
            </div>
        @endif

        <form action="{{ route('verification.send') }}" method="POST" style="margin-bottom:14px;">
            @csrf
            <button type="submit" style="width:100%;min-height:52px;border-radius:14px;border:none;background:linear-gradient(135deg,#2563eb,#38bdf8);color:#fff;font-size:14px;font-weight:800;cursor:pointer;">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="width:100%;min-height:50px;border-radius:14px;border:1px solid rgba(148,163,184,.25);background:rgba(30,41,59,.95);color:#e2e8f0;font-size:14px;font-weight:800;cursor:pointer;">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</div>
@endsection