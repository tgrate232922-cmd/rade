<div class="row">
    <div class="col-xl-12">
        <div class="site-card">
            <div class="site-card-header">
                <h3 class="title">{{ __('Copy Trade Earning Plans') }}</h3>
            </div>
            <div class="site-card-body">
                <p class="mb-4">
                    {{ __('Choose an expert trader, enter an amount, and the system will calculate a fixed daily simulated copy-trade profit. This is an earning plan, not a live trading terminal.') }}
                </p>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('user.copy-trade.active') }}" class="site-btn grad-btn w-100 centered">
                            {{ __('View Active Copy Trades') }}
                        </a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <a href="{{ route('user.copy-trade.completed') }}" class="site-btn red-btn w-100 centered">
                            {{ __('View Completed Copy Trades') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @forelse($traders as $trader)
        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="site-card mb-4">
                <div class="site-card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $trader->image_url }}" alt="{{ $trader->name }}" class="avatar me-3">
                        <div>
                            <h4 class="mb-1">{{ $trader->name }}</h4>
                            <span class="site-badge success">{{ __('Active') }}</span>
                            <span class="site-badge primary-bg">{{ ucfirst($trader->risk_level) }} {{ __('Risk') }}</span>
                        </div>
                    </div>

                    @if($trader->description)
                        <p>{{ $trader->description }}</p>
                    @endif

                    <ul class="list-unstyled">
                        <li>{{ __('Daily Profit') }}: <strong>{{ $trader->daily_profit_percentage }}%</strong></li>
                        <li>{{ __('Minimum Amount') }}: <strong>{{ $currencySymbol }}{{ $trader->min_amount }}</strong></li>
                        <li>{{ __('Maximum Amount') }}: <strong>{{ $currencySymbol }}{{ $trader->max_amount }}</strong></li>
                        <li>{{ __('Duration') }}: <strong>{{ $trader->duration_days }} {{ __('Days') }}</strong></li>
                        <li>{{ __('Capital Return') }}: <strong>{{ $trader->capital_return ? __('Yes') : __('No') }}</strong></li>
                        <li>{{ __('Users Copying') }}: <strong>{{ $trader->running_copied_trades_count }}</strong></li>
                    </ul>

                    <form action="{{ route('user.copy-trade.store') }}" method="post" class="mt-3">
                        @csrf
                        <input type="hidden" name="copy_trader_id" value="{{ $trader->id }}">
                        <div class="site-input-groups">
                            <label class="box-input-label">{{ __('Amount to Copy') }}</label>
                            <div class="input-group joint-input">
                                <input type="text" name="amount" class="form-control" oninput="this.value = validateDouble(this.value)" required>
                                <span class="input-group-text">{{ $currency }}</span>
                            </div>
                        </div>
                        <div class="site-input-groups">
                            <label class="box-input-label">{{ __('Wallet') }}</label>
                            <select name="wallet" class="form-select" required>
                                <option value="main">{{ __('Main Wallet') }}</option>
                                <option value="profit">{{ __('Profit Wallet') }}</option>
                            </select>
                        </div>
                        <button type="submit" class="site-btn grad-btn w-100 centered">
                            {{ __('Start Copying') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-xl-12">
            <div class="site-card">
                <div class="site-card-body text-center">
                    {{ __('No active copy traders are available right now.') }}
                </div>
            </div>
        </div>
    @endforelse
</div>

@if($activeTrades->isNotEmpty())
    <div class="row">
        <div class="col-xl-12">
            <div class="site-card">
                <div class="site-card-header">
                    <h3 class="title">{{ __('Recent Active Copy Trades') }}</h3>
                </div>
                <div class="site-card-body table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('Trader') }}</th>
                            <th>{{ __('Amount') }}</th>
                            <th>{{ __('Daily Profit') }}</th>
                            <th>{{ __('Total Profit') }}</th>
                            <th>{{ __('Next Profit') }}</th>
                            <th>{{ __('Status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activeTrades as $trade)
                            <tr>
                                <td>{{ $trade->trader->name }}</td>
                                <td>{{ $currencySymbol }}{{ $trade->amount_copied }}</td>
                                <td>{{ $currencySymbol }}{{ $trade->daily_profit_amount }}</td>
                                <td>{{ $currencySymbol }}{{ $trade->total_profit_earned }}</td>
                                <td>{{ $trade->next_profit_time }}</td>
                                <td><span class="site-badge success">{{ ucfirst($trade->status) }}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
