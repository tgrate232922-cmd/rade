@extends('backend.layouts.app')
@section('title')
    {{ __('Add User Copy Trade') }}
@endsection
@section('content')
    <div class="main-content">
        <div class="page-title">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="title-content">
                            <h2 class="title">{{ __('Add User Copy Trade') }}</h2>
                            <a href="{{ route('admin.copy-trades.index') }}" class="title-btn">
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
                            <form action="{{ route('admin.copy-trades.store') }}" method="post">
                                @csrf

                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('User') }}</label>
                                            <select name="user_id" class="form-select" required>
                                                <option value="">{{ __('Select User') }}</option>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                                                        #{{ $user->id }} - {{ $user->full_name }} ({{ $user->email }}) |
                                                        {{ __('Main') }}: {{ $currencySymbol }}{{ $user->balance }},
                                                        {{ __('Profit') }}: {{ $currencySymbol }}{{ $user->profit_balance }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Trader') }}</label>
                                            <select name="copy_trader_id" id="copy-trader-select" class="form-select" required>
                                                <option value="">{{ __('Select Trader') }}</option>
                                                @foreach($traders as $trader)
                                                    <option
                                                        value="{{ $trader->id }}"
                                                        data-daily-profit="{{ $trader->daily_profit_percentage }}"
                                                        data-min="{{ $trader->min_amount }}"
                                                        data-max="{{ $trader->max_amount }}"
                                                        data-duration="{{ $trader->duration_days }}"
                                                        @selected(old('copy_trader_id') == $trader->id)
                                                    >
                                                        {{ $trader->name }} -
                                                        {{ $trader->daily_profit_percentage }}% {{ __('daily') }},
                                                        {{ $currencySymbol }}{{ $trader->min_amount }}-{{ $currencySymbol }}{{ $trader->max_amount }},
                                                        {{ ucfirst($trader->risk_level) }} {{ __('Risk') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Amount Copied') }}</label>
                                            <div class="input-group joint-input">
                                                <input type="text" id="copy-amount" name="amount" class="form-control" oninput="this.value = validateDouble(this.value); calculateDailyProfit();" value="{{ old('amount') }}" required>
                                                <span class="input-group-text">{{ $currency }}</span>
                                            </div>
                                            <small id="trader-range" class="text-muted"></small>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Wallet to Debit') }}</label>
                                            <select name="wallet" class="form-select" required>
                                                <option value="main" @selected(old('wallet') === 'main')>{{ __('Main Wallet') }}</option>
                                                <option value="profit" @selected(old('wallet') === 'profit')>{{ __('Profit Wallet') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="site-card mb-3">
                                            <div class="site-card-body">
                                                <p class="mb-1">{{ __('Estimated Daily Profit') }}: <strong id="daily-profit-preview">0 {{ $currency }}</strong></p>
                                                <p class="mb-0">{{ __('Admin-created copy trades debit the selected wallet immediately and create an investment transaction/log.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="site-btn-sm primary-btn w-100 centered">
                                    {{ __('Create User Copy Trade') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function calculateDailyProfit() {
            const trader = document.getElementById('copy-trader-select');
            const amount = parseFloat(document.getElementById('copy-amount').value || 0);
            const selected = trader.options[trader.selectedIndex];
            const percent = parseFloat(selected.getAttribute('data-daily-profit') || 0);
            const min = selected.getAttribute('data-min');
            const max = selected.getAttribute('data-max');
            const dailyProfit = ((amount * percent) / 100).toFixed(2);

            document.getElementById('daily-profit-preview').innerText = dailyProfit + ' {{ $currency }}';
            document.getElementById('trader-range').innerText = min && max ? '{{ __('Allowed range') }}: {{ $currencySymbol }}' + min + ' - {{ $currencySymbol }}' + max : '';
        }

        document.getElementById('copy-trader-select').addEventListener('change', calculateDailyProfit);
        calculateDailyProfit();
    </script>
@endsection
