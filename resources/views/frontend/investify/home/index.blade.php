@extends('frontend::layouts.app')
@section('title')
    {{ __('Home') }}
@endsection
@section('content')

    @include('frontend::home._sections', ['homeContent' => $homeContent])

@endsection
