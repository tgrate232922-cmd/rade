@extends('frontend::layouts.user')
@section('title')
    {{ __('Copy Trade Logs') }}
@endsection
@section('content')
    @include('frontend.default.copy_trade._log_content')
@endsection
