@extends('frontend::layouts.user')
@section('title')
    {{ __('Copy Trade') }}
@endsection
@section('content')
    <div class="container-fluid default-page">
        @include('frontend.default.copy_trade._index_content')
    </div>
@endsection
