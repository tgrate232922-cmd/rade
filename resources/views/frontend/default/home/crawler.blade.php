@extends('frontend::layouts.app')
@section('title')
    {{ __('Home') }}
@endsection
@section('meta_description')
    {{ __('Welcome to our platform.') }}
@endsection
@section('content')
    <section class="banner light-blue-bg">
        <div class="container py-5">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h2>{{ __('Welcome') }}</h2>
                    <p class="mb-0">{{ __('Please visit our website using a supported browser.') }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
