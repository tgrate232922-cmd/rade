<div class="row">
    <div class="col-xl-12">
        <div class="site-card">
            <div class="site-card-header">
                <h3 class="title">
                    {{ $status === \App\Models\UserCopyTrade::STATUS_COMPLETED ? __('Completed Copy Trades') : __('Active Copy Trades') }}
                </h3>
            </div>
            <div class="site-card-body">
                <div class="row mb-3">
                    <div class="col-md-4 mb-2">
                        <a href="{{ route('user.copy-trade.index') }}" class="site-btn grad-btn w-100 centered">{{ __('Copy Traders') }}</a>
                    </div>
                    <div class="col-md-4 mb-2">
                        <a href="{{ route('user.copy-trade.active') }}" class="site-btn grad-btn w-100 centered">{{ __('Active') }}</a>
                    </div>
                    <div class="col-md-4 mb-2">
                        <a href="{{ route('user.copy-trade.completed') }}" class="site-btn red-btn w-100 centered">{{ __('Completed') }}</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{ __('Trader') }}</th>
                            <th>{{ __('Amount Copied') }}</th>
                            <th>{{ __('Daily Profit') }}</th>
                            <th>{{ __('Total Profit') }}</th>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('End Date') }}</th>
                            <th>{{ __('Next Profit') }}</th>
                            <th>{{ __('Status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($trades as $trade)
                            <tr>
                                <td>
                                    <strong>{{ $trade->trader->name }}</strong><br>
                                    <small>{{ ucfirst($trade->trader->risk_level) }} {{ __('Risk') }}</small>
                                </td>
                                <td>{{ $currencySymbol }}{{ $trade->amount_copied }}</td>
                                <td>{{ $currencySymbol }}{{ $trade->daily_profit_amount }}</td>
                                <td>{{ $currencySymbol }}{{ $trade->total_profit_earned }}</td>
                                <td>{{ $trade->started_at }}</td>
                                <td>{{ $trade->ends_at }}</td>
                                <td>{{ $trade->next_profit_time }}</td>
                                <td>
                                    <span class="site-badge {{ $trade->status === \App\Models\UserCopyTrade::STATUS_COMPLETED ? 'success' : 'pending' }}">
                                        {{ ucfirst($trade->status) }}
                                    </span>
                                </td>
                            </tr>
                            @if($trade->logs->isNotEmpty())
                                <tr>
                                    <td colspan="8">
                                        <strong>{{ __('Recent Trade Logs') }}</strong>
                                        <ul class="mb-0 mt-2">
                                            @foreach($trade->logs as $log)
                                                <li>
                                                    {{ ucfirst(str_replace('_', ' ', $log->type)) }}
                                                    @if($log->amount !== null)
                                                        ({{ $currencySymbol }}{{ $log->amount }})
                                                    @endif
                                                    - {{ $log->message }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">{{ __('No copy trades found.') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $trades->links() }}
            </div>
        </div>
    </div>
</div>
