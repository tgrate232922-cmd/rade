@extends('backend.layouts.app')
@section('title')
    {{ __('Edit Copy Trader') }}
@endsection
@section('content')
    <div class="main-content">
        <div class="page-title">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="title-content">
                            <h2 class="title">{{ __('Edit Copy Trader') }}</h2>
                            <a href="{{ route('admin.copy-traders.index') }}" class="title-btn">
                                <i icon-name="corner-down-left"></i>{{ __('Back') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="site-card">
                        <div class="site-card-body">
                            <form action="{{ route('admin.copy-traders.update', $copyTrader->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @include('backend.copy_trader._form', ['copyTrader' => $copyTrader])
                                <button type="submit" class="site-btn-sm primary-btn w-100 centered">
                                    {{ __('Update Trader') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
