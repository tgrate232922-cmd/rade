@extends('backend.layouts.app')
@section('title')
    {{ __('Copy Trades') }}
@endsection
@section('content')
    <div class="main-content">
        <div class="page-title">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="title-content">
                            <h2 class="title">
                                {{ $selectedTrader ? __('Users Copying') . ' ' . $selectedTrader->name : __('All Copy Trades') }}
                            </h2>
                            <a href="{{ route('admin.copy-trades.create') }}" class="title-btn">
                                <i icon-name="plus-circle"></i>{{ __('Add User Copy') }}
                            </a>
                            <a href="{{ route('admin.copy-traders.index') }}" class="title-btn">
                                <i icon-name="users"></i>{{ __('Manage Traders') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="site-card">
                        <div class="site-card-body">
                            <form action="{{ $selectedTrader ? route('admin.copy-trades.index', $selectedTrader->id) : route('admin.copy-trades.index') }}" method="get" class="row mb-4">
                                <div class="col-xl-4 col-md-6">
                                    <div class="site-input-groups">
                                        <label class="box-input-label">{{ __('Status') }}</label>
                                        <select name="status" class="form-select">
                                            <option value="">{{ __('All Status') }}</option>
                                            @foreach([\App\Models\UserCopyTrade::STATUS_RUNNING, \App\Models\UserCopyTrade::STATUS_PAUSED, \App\Models\UserCopyTrade::STATUS_COMPLETED, \App\Models\UserCopyTrade::STATUS_CANCELLED] as $status)
                                                <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-md-6 d-flex align-items-end">
                                    <button type="submit" class="site-btn-sm primary-btn">{{ __('Filter') }}</button>
                                    <a href="{{ route('admin.copy-trades.index') }}" class="site-btn-sm red-btn ms-2">{{ __('Reset') }}</a>
                                </div>
                            </form>

                            <div class="site-table table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Trader') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Daily Profit') }}</th>
                                        <th>{{ __('Total Profit') }}</th>
                                        <th>{{ __('Dates') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($copyTrades as $copyTrade)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.user.edit', $copyTrade->user_id) }}">
                                                    {{ $copyTrade->user->full_name }}
                                                </a><br>
                                                <small>ID: {{ $copyTrade->user_id }}</small>
                                            </td>
                                            <td>
                                                <strong>{{ $copyTrade->trader->name }}</strong><br>
                                                <small>{{ ucfirst($copyTrade->trader->risk_level) }} {{ __('Risk') }}</small>
                                            </td>
                                            <td>{{ $currencySymbol }}{{ $copyTrade->amount_copied }}</td>
                                            <td>
                                                {{ $currencySymbol }}{{ $copyTrade->daily_profit_amount }}<br>
                                                <small>{{ $copyTrade->daily_profit_percentage }}%</small>
                                            </td>
                                            <td>{{ $currencySymbol }}{{ $copyTrade->total_profit_earned }}</td>
                                            <td>
                                                {{ __('Start') }}: {{ $copyTrade->started_at }}<br>
                                                {{ __('End') }}: {{ $copyTrade->ends_at }}<br>
                                                {{ __('Next') }}: {{ $copyTrade->next_profit_time }}
                                            </td>
                                            <td>
                                                <span class="site-badge {{ $copyTrade->status === \App\Models\UserCopyTrade::STATUS_COMPLETED ? 'success' : ($copyTrade->status === \App\Models\UserCopyTrade::STATUS_RUNNING ? 'pending' : 'danger') }}">
                                                    {{ ucfirst($copyTrade->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    <a href="{{ route('admin.copy-trades.edit', $copyTrade->id) }}" class="site-btn-sm primary-btn">{{ __('Edit') }}</a>
                                                    @if($copyTrade->status === \App\Models\UserCopyTrade::STATUS_RUNNING)
                                                        <form action="{{ route('admin.copy-trades.pause', $copyTrade->id) }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="site-btn-sm red-btn">{{ __('Pause') }}</button>
                                                        </form>
                                                    @endif

                                                    @if($copyTrade->status === \App\Models\UserCopyTrade::STATUS_PAUSED)
                                                        <form action="{{ route('admin.copy-trades.resume', $copyTrade->id) }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="site-btn-sm primary-btn">{{ __('Open') }}</button>
                                                        </form>
                                                    @endif

                                                    @if($copyTrade->status !== \App\Models\UserCopyTrade::STATUS_COMPLETED)
                                                        <form action="{{ route('admin.copy-trades.complete', $copyTrade->id) }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="site-btn-sm primary-btn" onclick="return confirm('{{ __('Complete this copied trade?') }}')">{{ __('Close') }}</button>
                                                        </form>
                                                    @endif
                                                </div>

                                                @if($copyTrade->status !== \App\Models\UserCopyTrade::STATUS_COMPLETED)
                                                    <form action="{{ route('admin.copy-trades.adjust', $copyTrade->id) }}" method="post" class="mt-2">
                                                        @csrf
                                                        <input type="text" name="amount" class="box-input mb-1" placeholder="{{ __('Profit + / Loss -') }}" required>
                                                        <input type="text" name="message" class="box-input mb-1" placeholder="{{ __('Adjustment note') }}">
                                                        <button type="submit" class="site-btn-sm primary-btn w-100">{{ __('Apply P/L') }}</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @if($copyTrade->logs->isNotEmpty())
                                            <tr>
                                                <td colspan="8">
                                                    <strong>{{ __('Recent Trade Logs') }}</strong>
                                                    <ul class="mb-0 mt-2">
                                                        @foreach($copyTrade->logs as $log)
                                                            <li>
                                                                {{ $log->created_at->format('M d, Y H:i') }} -
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
                                            <td colspan="8" class="text-center">{{ __('No copied trades found.') }}</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{ $copyTrades->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
