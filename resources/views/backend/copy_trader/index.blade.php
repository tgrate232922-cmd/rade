@extends('backend.layouts.app')
@section('title')
    {{ __('Copy Traders') }}
@endsection
@section('content')
    <div class="main-content">
        <div class="page-title">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="title-content">
                            <h2 class="title">{{ __('Copy Traders') }}</h2>
                            <a href="{{ route('admin.copy-traders.create') }}" class="title-btn">
                                <i icon-name="plus-circle"></i>{{ __('Add New') }}
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
                            <div class="site-table table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Trader') }}</th>
                                        <th>{{ __('Daily Profit') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Duration') }}</th>
                                        <th>{{ __('Risk') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Users') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($traders as $trader)
                                        <tr>
                                            <td><img class="avatar" src="{{ $trader->image_url }}" alt="{{ $trader->name }}"></td>
                                            <td>
                                                <strong>{{ $trader->name }}</strong><br>
                                                <small>{{ $trader->approved ? __('Approved Expert') : __('Pending Approval') }}</small>
                                            </td>
                                            <td>{{ $trader->daily_profit_percentage }}%</td>
                                            <td>{{ $currencySymbol }}{{ $trader->min_amount }} - {{ $currencySymbol }}{{ $trader->max_amount }}</td>
                                            <td>{{ $trader->duration_days }} {{ __('Days') }}</td>
                                            <td>{{ ucfirst($trader->risk_level) }}</td>
                                            <td>
                                                <span class="site-badge {{ $trader->status ? 'success' : 'danger' }}">
                                                    {{ $trader->status ? __('Active') : __('Inactive') }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.copy-trades.index', $trader->id) }}">
                                                    {{ $trader->running_copied_trades_count }} {{ __('running') }}
                                                </a>
                                                / {{ $trader->copied_trades_count }} {{ __('total') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.copy-traders.edit', $trader->id) }}" class="round-icon-btn primary-btn">
                                                    <i icon-name="edit-3"></i>
                                                </a>
                                                <form action="{{ route('admin.copy-traders.destroy', $trader->id) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="round-icon-btn red-btn" onclick="return confirm('{{ __('Delete this copy trader?') }}')">
                                                        <i icon-name="trash-2"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">{{ __('No copy traders found.') }}</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
