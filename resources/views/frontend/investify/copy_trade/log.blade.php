@extends('frontend::layouts.user')
@section('title')
    {{ __('Copy Trade Logs') }}
@endsection
@section('content')
    <div class="container-fluid default-page">
        @include('frontend.default.copy_trade._log_content')
    </div>
@endsection
