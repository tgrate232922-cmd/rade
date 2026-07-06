@extends('frontend::layouts.user')
@section('title')
    {{ __('Copy Trade Logs') }}
@endsection
@push('style')
<style>
.copy-log-area{
  padding:20px 12px 42px;
}

.copy-dashboard-card{
  padding:18px;
  border-radius:26px;
  background:linear-gradient(180deg,rgba(54,84,120,.28),rgba(16,30,54,.62));
  border:1px solid rgba(125,211,252,.20);
  box-shadow:0 28px 70px rgba(0,0,0,.34), inset 0 1px 0 rgba(255,255,255,.10);
  backdrop-filter:blur(24px) saturate(145%);
}

.copy-log-header{
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:12px;
  flex-wrap:wrap;
  padding-bottom:16px;
}

.copy-log-title{
  color:#eef8ff;
  font-size:20px;
  line-height:1.25;
  font-weight:800;
  margin:0;
}

.copy-log-tabs{
  display:flex;
  align-items:center;
  gap:10px;
  flex-wrap:wrap;
}

.copy-log-tab{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  min-height:38px;
  padding:0 14px;
  border-radius:13px;
  background:rgba(25,43,73,.52);
  border:1px solid rgba(125,211,252,.16);
  color:rgba(226,241,255,.72);
  font-size:12px;
  font-weight:800;
  text-decoration:none;
}

.copy-log-tab.active,
.copy-log-tab:hover{
  color:#ffffff;
  background:linear-gradient(135deg,#67e8f9,#2563eb);
  border-color:transparent;
}

.copy-log-card{
  position:relative;
  overflow:hidden;
  padding:15px;
  margin-bottom:12px;
  border-radius:22px;
  background:rgba(25,43,73,.42);
  border:1px solid rgba(125,211,252,.16);
  transition:.22s ease;
}

.copy-log-card:hover{
  background:rgba(25,43,73,.58);
  transform:translateY(-1px);
}

.copy-log-top{
  display:flex;
  align-items:center;
  gap:12px;
  flex-wrap:wrap;
}

.copy-log-icon{
  width:40px;
  height:40px;
  min-width:40px;
  border-radius:13px;
  background:linear-gradient(135deg,rgba(103,232,249,.22),rgba(37,99,235,.18));
  border:1px solid rgba(125,211,252,.30);
  display:flex;
  align-items:center;
  justify-content:center;
  box-shadow:0 0 22px rgba(56,189,248,.16);
}

.copy-log-meta h4{
  color:#eef8ff !important;
  font-size:14px;
  line-height:1.25;
  font-weight:800;
  margin:0;
}

.copy-log-meta p{
  margin:3px 0 0;
  color:rgba(226,241,255,.50);
  font-size:11px;
  line-height:1.35;
}

.copy-log-grid{
  display:grid;
  grid-template-columns:repeat(5,minmax(120px,1fr));
  gap:14px;
  padding-top:14px;
}

.copy-log-label{
  color:rgba(226,241,255,.52);
  font-size:10px;
  font-weight:800;
  letter-spacing:.06em;
  text-transform:uppercase;
  margin-bottom:5px;
}

.copy-log-value{
  color:#eef8ff;
  font-weight:700;
  font-size:12px;
  line-height:1.45;
  word-break:break-word;
}

.copy-log-value.highlight{
  color:#67e8f9;
}

.copy-status-badge{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  min-height:24px;
  padding:0 9px;
  border-radius:999px;
  font-weight:800;
  font-size:10px;
}

.copy-badge-success{
  background:rgba(34,197,94,.14);
  color:#86efac;
}

.copy-badge-warning{
  background:rgba(251,191,36,.14);
  color:#fde68a;
}

.copy-badge-danger{
  background:rgba(248,113,113,.14);
  color:#fecaca;
}

.copy-recent-logs{
  margin-top:14px;
  padding:12px;
  border-radius:16px;
  background:rgba(56,189,248,.06);
  border:1px solid rgba(125,211,252,.14);
}

.copy-recent-logs strong{
  color:#eef8ff;
  font-size:12px;
}

.copy-recent-logs ul{
  margin:8px 0 0;
  padding-left:18px;
  color:rgba(226,241,255,.66);
  font-size:12px;
  line-height:1.7;
}

.copy-empty{
  background:rgba(25,43,73,.42);
  border:1px solid rgba(125,211,252,.16);
  color:rgba(226,241,255,.70);
  border-radius:16px;
  padding:18px;
  text-align:center;
  font-size:13px;
}

.pagination{
  margin-top:14px;
}

.page-link{
  background:rgba(25,43,73,.72) !important;
  border-color:rgba(125,211,252,.16) !important;
  color:#67e8f9 !important;
  border-radius:10px !important;
  font-size:12px;
}

.page-item.active .page-link{
  background:linear-gradient(135deg,#67e8f9,#2563eb) !important;
  color:#ffffff !important;
}

@media(max-width:992px){
  .copy-log-grid{
    grid-template-columns:repeat(2,1fr);
  }
}

@media(max-width:768px){
  .copy-log-area{
    padding:12px 8px 36px;
  }

  .copy-dashboard-card{
    padding:12px;
    border-radius:22px;
  }

  .copy-log-card{
    padding:13px;
    border-radius:18px;
  }

  .copy-log-grid{
    grid-template-columns:1fr;
    gap:11px;
    padding-top:12px;
  }
}
</style>
@endpush
@section('content')
    <div class="container-fluid default-page">
        <div class="row gy-30">
            <div class="col-xl-12">
                <div class="copy-log-area">
                    <div class="copy-dashboard-card">
                        <div class="copy-log-header">
                            <h3 class="copy-log-title">
                                {{ $status === \App\Models\UserCopyTrade::STATUS_COMPLETED ? __('Completed Copy Trades') : __('Active Copy Trades') }}
                            </h3>
                            <div class="copy-log-tabs">
                                <a href="{{ route('user.copy-trade.index') }}" class="copy-log-tab">{{ __('Copy Traders') }}</a>
                                <a href="{{ route('user.copy-trade.active') }}" class="copy-log-tab {{ $status === \App\Models\UserCopyTrade::STATUS_RUNNING ? 'active' : '' }}">{{ __('Active') }}</a>
                                <a href="{{ route('user.copy-trade.completed') }}" class="copy-log-tab {{ $status === \App\Models\UserCopyTrade::STATUS_COMPLETED ? 'active' : '' }}">{{ __('Completed') }}</a>
                            </div>
                        </div>

                        <div class="copy-log-list">
                            @forelse($trades as $trade)
                                <div class="copy-log-card">
                                    <div class="copy-log-top">
                                        <div class="copy-log-icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.4" d="M4 19C4 18.4477 4.44772 18 5 18H20C20.5523 18 21 18.4477 21 19C21 19.5523 20.5523 20 20 20H5C4.44772 20 4 19.5523 4 19Z" fill="#67e8f9"/>
                                                <path d="M6 15.5C6 14.6716 6.67157 14 7.5 14C8.32843 14 9 14.6716 9 15.5V19H6V15.5Z" fill="#67e8f9"/>
                                                <path d="M11 10.5C11 9.67157 11.6716 9 12.5 9C13.3284 9 14 9.67157 14 10.5V19H11V10.5Z" fill="#67e8f9"/>
                                                <path d="M16 6.5C16 5.67157 16.6716 5 17.5 5C18.3284 5 19 5.67157 19 6.5V19H16V6.5Z" fill="#67e8f9"/>
                                            </svg>
                                        </div>
                                        <div class="copy-log-meta">
                                            <h4>{{ $trade->trader->name }}</h4>
                                            <p>{{ $trade->started_at }} • {{ ucfirst($trade->trader->risk_level) }} {{ __('Risk') }}</p>
                                        </div>
                                        <div class="ms-auto">
                                            @if($trade->status === \App\Models\UserCopyTrade::STATUS_RUNNING)
                                                <span class="copy-status-badge copy-badge-success">{{ __('Active') }}</span>
                                            @elseif($trade->status === \App\Models\UserCopyTrade::STATUS_COMPLETED)
                                                <span class="copy-status-badge copy-badge-success">{{ __('Completed') }}</span>
                                            @elseif($trade->status === \App\Models\UserCopyTrade::STATUS_PAUSED)
                                                <span class="copy-status-badge copy-badge-warning">{{ __('Paused') }}</span>
                                            @else
                                                <span class="copy-status-badge copy-badge-danger">{{ ucfirst($trade->status) }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="copy-log-grid">
                                        <div>
                                            <div class="copy-log-label">{{ __('Amount Copied') }}</div>
                                            <div class="copy-log-value highlight">{{ $currencySymbol }}{{ $trade->amount_copied }}</div>
                                        </div>
                                        <div>
                                            <div class="copy-log-label">{{ __('Daily Profit') }}</div>
                                            <div class="copy-log-value">{{ $currencySymbol }}{{ $trade->daily_profit_amount }} ({{ $trade->daily_profit_percentage }}%)</div>
                                        </div>
                                        <div>
                                            <div class="copy-log-label">{{ __('Total Profit') }}</div>
                                            <div class="copy-log-value">{{ $currencySymbol }}{{ $trade->total_profit_earned }}</div>
                                        </div>
                                        <div>
                                            <div class="copy-log-label">{{ __('Duration') }}</div>
                                            <div class="copy-log-value">{{ $trade->duration_days }} {{ __('Days') }} / {{ $trade->periods_paid }} {{ __('Paid') }}</div>
                                        </div>
                                        <div>
                                            <div class="copy-log-label">{{ __('Timeline') }}</div>
                                            <div class="copy-log-value">
                                                {{ __('End') }}: {{ $trade->ends_at }}<br>
                                                {{ __('Next') }}: {{ $trade->next_profit_time }}
                                            </div>
                                        </div>
                                    </div>

                                    @if($trade->logs->isNotEmpty())
                                        <div class="copy-recent-logs">
                                            <strong>{{ __('Recent Trade Logs') }}</strong>
                                            <ul>
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
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <div class="copy-empty">
                                    {{ __('No copy trades found.') }}
                                </div>
                            @endforelse
                        </div>

                        <div class="d-flex justify-content-end">
                            {{ $trades->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
