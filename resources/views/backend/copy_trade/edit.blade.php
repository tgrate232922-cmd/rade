@extends('backend.layouts.app')
@section('title')
    {{ __('Edit User Copy Trade') }}
@endsection
@section('content')
    <div class="main-content">
        <div class="page-title">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="title-content">
                            <h2 class="title">{{ __('Edit User Copy Trade') }}</h2>
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
                <div class="col-xl-9">
                    <div class="site-card">
                        <div class="site-card-body">
                            <div class="site-card mb-4">
                                <div class="site-card-body">
                                    <strong>{{ __('User') }}:</strong>
                                    <a href="{{ route('admin.user.edit', $copyTrade->user_id) }}">
                                        #{{ $copyTrade->user_id }} - {{ $copyTrade->user->full_name }} ({{ $copyTrade->user->email }})
                                    </a>
                                    <br>
                                    <strong>{{ __('Wallets') }}:</strong>
                                    {{ __('Main') }} {{ $currencySymbol }}{{ $copyTrade->user->balance }},
                                    {{ __('Profit') }} {{ $currencySymbol }}{{ $copyTrade->user->profit_balance }}
                                </div>
                            </div>

                            <form action="{{ route('admin.copy-trades.update', $copyTrade->id) }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Trader') }}</label>
                                            <select name="copy_trader_id" id="copy-trader-select" class="form-select" required>
                                                @foreach($traders as $trader)
                                                    <option
                                                        value="{{ $trader->id }}"
                                                        data-daily-profit="{{ $trader->daily_profit_percentage }}"
                                                        @selected(old('copy_trader_id', $copyTrade->copy_trader_id) == $trader->id)
                                                    >
                                                        {{ $trader->name }} - {{ $trader->daily_profit_percentage }}% {{ __('daily') }} - {{ ucfirst($trader->risk_level) }} {{ __('Risk') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Status') }}</label>
                                            <select name="status" class="form-select" required>
                                                @foreach([\App\Models\UserCopyTrade::STATUS_RUNNING, \App\Models\UserCopyTrade::STATUS_PAUSED, \App\Models\UserCopyTrade::STATUS_COMPLETED, \App\Models\UserCopyTrade::STATUS_CANCELLED] as $status)
                                                    <option value="{{ $status }}" @selected(old('status', $copyTrade->status) === $status)>{{ ucfirst($status) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Amount Copied') }}</label>
                                            <div class="input-group joint-input">
                                                <input type="text" id="copy-amount" name="amount_copied" class="form-control" oninput="this.value = validateDouble(this.value); calculateDailyProfit();" value="{{ old('amount_copied', $copyTrade->amount_copied) }}" required>
                                                <span class="input-group-text">{{ $currency }}</span>
                                            </div>
                                            <small>{{ __('Editing this value changes future calculations only; it does not debit or refund wallets.') }}</small>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Daily Profit %') }}</label>
                                            <input type="text" id="daily-profit-percentage" name="daily_profit_percentage" class="box-input" oninput="this.value = validateDouble(this.value); calculateDailyProfit();" value="{{ old('daily_profit_percentage', $copyTrade->daily_profit_percentage) }}" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Daily Profit Amount') }}</label>
                                            <div class="input-group joint-input">
                                                <input type="text" id="daily-profit-amount" name="daily_profit_amount" class="form-control" oninput="this.value = validateDouble(this.value)" value="{{ old('daily_profit_amount', $copyTrade->daily_profit_amount) }}" required>
                                                <span class="input-group-text">{{ $currency }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Total Profit Earned') }}</label>
                                            <div class="input-group joint-input">
                                                <input type="text" name="total_profit_earned" class="form-control" oninput="this.value = validateDouble(this.value)" value="{{ old('total_profit_earned', $copyTrade->total_profit_earned) }}" required>
                                                <span class="input-group-text">{{ $currency }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Duration') }}</label>
                                            <div class="input-group joint-input">
                                                <input type="number" min="1" name="duration_days" class="form-control" value="{{ old('duration_days', $copyTrade->duration_days) }}" required>
                                                <span class="input-group-text">{{ __('Days') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Periods Paid') }}</label>
                                            <input type="number" min="0" name="periods_paid" class="box-input" value="{{ old('periods_paid', $copyTrade->periods_paid) }}" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Capital Return') }}</label>
                                            <select name="capital_return" class="form-select" required>
                                                <option value="1" @selected((string) old('capital_return', (int) $copyTrade->capital_return) === '1')>{{ __('Yes') }}</option>
                                                <option value="0" @selected((string) old('capital_return', (int) $copyTrade->capital_return) === '0')>{{ __('No') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Start Date') }}</label>
                                            <input type="datetime-local" name="start_date" class="box-input" value="{{ old('start_date', optional($copyTrade->start_date)->format('Y-m-d\TH:i')) }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-6">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('End Date') }}</label>
                                            <input type="datetime-local" name="end_date" class="box-input" value="{{ old('end_date', optional($copyTrade->end_date)->format('Y-m-d\TH:i')) }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Next Profit At') }}</label>
                                            <input type="datetime-local" name="next_profit_at" class="box-input" value="{{ old('next_profit_at', optional($copyTrade->next_profit_at)->format('Y-m-d\TH:i')) }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Last Profit At') }}</label>
                                            <input type="datetime-local" name="last_profit_at" class="box-input" value="{{ old('last_profit_at', optional($copyTrade->last_profit_at)->format('Y-m-d\TH:i')) }}">
                                        </div>
                                    </div>

                                    <div class="col-xl-4">
                                        <div class="site-input-groups">
                                            <label class="box-input-label">{{ __('Completed At') }}</label>
                                            <input type="datetime-local" name="completed_at" class="box-input" value="{{ old('completed_at', optional($copyTrade->completed_at)->format('Y-m-d\TH:i')) }}">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="site-btn-sm primary-btn w-100 centered">
                                    {{ __('Update User Copy Trade') }}
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
            const amount = parseFloat(document.getElementById('copy-amount').value || 0);
            const percent = parseFloat(document.getElementById('daily-profit-percentage').value || 0);
            const dailyProfit = ((amount * percent) / 100).toFixed(2);
            document.getElementById('daily-profit-amount').value = dailyProfit;
        }
    </script>
@endsection
