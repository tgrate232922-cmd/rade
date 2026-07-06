@extends('frontend::layouts.user')
@section('title')
    {{ __('Copy Trade') }}
@endsection
@push('style')
<style>
.copy-trade-shell{
  max-width:1260px;
  margin:0 auto;
  padding:18px 14px 42px;
}

.copy-trade-header{
  display:flex;
  justify-content:center;
  align-items:center;
  margin:8px 4px 18px;
  text-align:center;
}

.copy-trade-header h6{
  color:#eef8ff;
  font-size:24px;
  font-weight:700;
  letter-spacing:-.02em;
  margin:0;
}

.copy-trade-subtitle{
  max-width:760px;
  margin:0 auto 24px;
  color:rgba(226,241,255,.62);
  font-size:13px;
  line-height:1.7;
  text-align:center;
}

.copy-trade-actions{
  display:grid;
  grid-template-columns:repeat(2,minmax(0,1fr));
  gap:14px;
  margin:0 0 22px;
}

.copy-action-card{
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:14px;
  padding:17px 18px;
  border-radius:22px;
  background:linear-gradient(180deg,rgba(54,84,120,.28),rgba(16,30,54,.62));
  border:1px solid rgba(125,211,252,.20);
  box-shadow:0 20px 50px rgba(0,0,0,.24), inset 0 1px 0 rgba(255,255,255,.10);
  color:#eef8ff;
  text-decoration:none;
}

.copy-action-card:hover{
  color:#ffffff;
  transform:translateY(-1px);
}

.copy-action-card span{
  color:rgba(226,241,255,.58);
  font-size:12px;
}

.copy-trader-grid{
  display:grid;
  grid-template-columns:repeat(3,minmax(0,1fr));
  gap:20px;
}

.copy-trader-card{
  position:relative;
  overflow:hidden;
  padding:22px 20px 20px;
  border-radius:26px;
  background:linear-gradient(180deg,rgba(54,84,120,.28),rgba(16,30,54,.62));
  border:1px solid rgba(125,211,252,.20);
  box-shadow:0 28px 70px rgba(0,0,0,.34), inset 0 1px 0 rgba(255,255,255,.10);
  backdrop-filter:blur(24px) saturate(145%);
  -webkit-backdrop-filter:blur(24px) saturate(145%);
}

.copy-trader-card::before{
  content:"";
  position:absolute;
  inset:0;
  background:radial-gradient(circle at 75% 0%, rgba(125,211,252,.20), transparent 24%), linear-gradient(120deg, transparent 0%, rgba(255,255,255,.05) 45%, transparent 70%);
  pointer-events:none;
}

.copy-trader-card > *{
  position:relative;
  z-index:2;
}

.copy-trader-top{
  display:flex;
  align-items:center;
  gap:12px;
  margin-bottom:14px;
}

.copy-trader-avatar{
  width:58px;
  height:58px;
  min-width:58px;
  border-radius:18px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  background:linear-gradient(135deg,rgba(103,232,249,.22),rgba(37,99,235,.18));
  border:1px solid rgba(125,211,252,.35);
  box-shadow:0 0 26px rgba(56,189,248,.18);
  overflow:hidden;
}

.copy-trader-avatar img{
  width:100%;
  height:100%;
  object-fit:cover;
}

.copy-trader-title{
  color:#eef8ff;
  font-size:16px;
  line-height:1.25;
  font-weight:800;
}

.copy-trader-risk{
  margin-top:5px;
  color:rgba(226,241,255,.56);
  font-size:11px;
  text-transform:uppercase;
  letter-spacing:.08em;
}

.copy-profit-box{
  background:rgba(56,189,248,.08);
  border:1px solid rgba(125,211,252,.22);
  border-radius:16px;
  padding:13px 14px;
  margin:2px 0 14px;
}

.copy-profit-label{
  color:rgba(226,241,255,.58);
  font-size:11px;
  font-weight:700;
  letter-spacing:.08em;
  text-transform:uppercase;
}

.copy-profit-value{
  color:#67e8f9;
  font-size:26px;
  line-height:1;
  font-weight:900;
  margin-top:6px;
}

.copy-info-row{
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:12px;
  padding:8px 0;
  border-bottom:1px solid rgba(255,255,255,.06);
  color:rgba(226,241,255,.70);
  font-size:13px;
  line-height:1.45;
}

.copy-info-row:last-child{
  border-bottom:none;
}

.copy-info-row strong{
  color:#eef8ff;
  font-weight:800;
  text-align:right;
}

.copy-trader-description{
  color:rgba(226,241,255,.58);
  font-size:12px;
  line-height:1.6;
  margin:12px 0 0;
}

.copy-form{
  margin-top:16px;
  padding-top:16px;
  border-top:1px solid rgba(255,255,255,.07);
}

.copy-form label{
  color:rgba(226,241,255,.62);
  font-size:11px;
  font-weight:800;
  letter-spacing:.06em;
  text-transform:uppercase;
  margin-bottom:6px;
}

.copy-form .form-control,
.copy-form .form-select{
  min-height:44px;
  background:rgba(25,43,73,.72);
  border:1px solid rgba(125,211,252,.16);
  color:#eef8ff;
  border-radius:14px;
}

.copy-form .input-group-text{
  background:rgba(56,189,248,.10);
  border-color:rgba(125,211,252,.16);
  color:#67e8f9;
  border-radius:0 14px 14px 0;
}

.copy-submit-btn{
  display:block;
  width:100%;
  text-align:center;
  padding:13px 0;
  margin-top:14px;
  background:linear-gradient(135deg,#67e8f9 0%,#2563eb 100%);
  color:#ffffff !important;
  font-weight:800;
  border:none;
  border-radius:15px;
  box-shadow:0 16px 36px rgba(37,99,235,.30);
}

.copy-empty-card{
  grid-column:1/-1;
  padding:30px;
  border-radius:24px;
  background:linear-gradient(180deg,rgba(54,84,120,.28),rgba(16,30,54,.62));
  border:1px solid rgba(125,211,252,.20);
  color:rgba(226,241,255,.70);
  text-align:center;
}

@media(max-width:1180px){
  .copy-trader-grid{
    grid-template-columns:repeat(2,minmax(0,1fr));
  }
}

@media(max-width:768px){
  .copy-trade-shell{
    padding:12px 8px 36px;
  }

  .copy-trade-actions,
  .copy-trader-grid{
    grid-template-columns:1fr;
  }

  .copy-trader-card{
    padding:18px 16px;
    border-radius:22px;
  }
}
</style>
@endpush
@section('content')
    <div class="container-fluid default-page">
        <div class="copy-trade-shell">
            <div class="copy-trade-header">
                <h6>{{ __('Copy Trade Earning Plans') }}</h6>
            </div>
            <p class="copy-trade-subtitle">
                {{ __('Choose an expert trader, enter an amount, and the system will calculate a fixed daily simulated copy-trade profit. This is an earning plan, not a real trading terminal.') }}
            </p>

            <div class="copy-trade-actions">
                <a href="{{ route('user.copy-trade.active') }}" class="copy-action-card">
                    <div>
                        <strong>{{ __('Active Copy Trades') }}</strong><br>
                        <span>{{ __('View running copy sessions') }}</span>
                    </div>
                    <i icon-name="line-chart"></i>
                </a>
                <a href="{{ route('user.copy-trade.completed') }}" class="copy-action-card">
                    <div>
                        <strong>{{ __('Completed Copy Trades') }}</strong><br>
                        <span>{{ __('View closed copy sessions') }}</span>
                    </div>
                    <i icon-name="check-circle"></i>
                </a>
            </div>

            <div class="copy-trader-grid">
                @forelse($traders as $trader)
                    <div class="copy-trader-card">
                        <div class="copy-trader-top">
                            <div class="copy-trader-avatar">
                                <img src="{{ $trader->image_url }}" alt="{{ $trader->name }}">
                            </div>
                            <div>
                                <div class="copy-trader-title">{{ $trader->name }}</div>
                                <div class="copy-trader-risk">{{ ucfirst($trader->risk_level) }} {{ __('Risk') }} • {{ __('Active') }}</div>
                            </div>
                        </div>

                        <div class="copy-profit-box">
                            <div class="copy-profit-label">{{ __('Daily Profit') }}</div>
                            <div class="copy-profit-value">{{ $trader->daily_profit_percentage }}%</div>
                        </div>

                        <div class="copy-info-row">
                            <span>{{ __('Minimum Amount') }}</span>
                            <strong>{{ $currencySymbol }}{{ number_format((float) $trader->min_amount, 2) }}</strong>
                        </div>
                        <div class="copy-info-row">
                            <span>{{ __('Maximum Amount') }}</span>
                            <strong>{{ $currencySymbol }}{{ number_format((float) $trader->max_amount, 2) }}</strong>
                        </div>
                        <div class="copy-info-row">
                            <span>{{ __('Duration') }}</span>
                            <strong>{{ $trader->duration_days }} {{ __('Days') }}</strong>
                        </div>
                        <div class="copy-info-row">
                            <span>{{ __('Capital Return') }}</span>
                            <strong>{{ $trader->capital_return ? __('Yes') : __('No') }}</strong>
                        </div>
                        <div class="copy-info-row">
                            <span>{{ __('Users Copying') }}</span>
                            <strong>{{ $trader->display_users_copying }}</strong>
                        </div>
                        <div class="copy-info-row">
                            <span>{{ __('Trader Win Rate') }}</span>
                            <strong>{{ $trader->win_rate }}%</strong>
                        </div>

                        @if($trader->description)
                            <p class="copy-trader-description">{{ $trader->description }}</p>
                        @endif

                        <form action="{{ route('user.copy-trade.store') }}" method="post" class="copy-form">
                            @csrf
                            <input type="hidden" name="copy_trader_id" value="{{ $trader->id }}">

                            <div class="site-input-groups">
                                <label>{{ __('Amount to Copy') }}</label>
                                <div class="input-group joint-input">
                                    <input type="text" name="amount" class="form-control" oninput="this.value = validateDouble(this.value)" required>
                                    <span class="input-group-text">{{ $currency }}</span>
                                </div>
                            </div>

                            <div class="site-input-groups">
                                <label>{{ __('Wallet') }}</label>
                                <select name="wallet" class="form-select" required>
                                    <option value="main">{{ __('Main Wallet') }}</option>
                                    <option value="profit">{{ __('Profit Wallet') }}</option>
                                </select>
                            </div>

                            <button type="submit" class="copy-submit-btn">{{ __('Start Copying') }}</button>
                        </form>
                    </div>
                @empty
                    <div class="copy-empty-card">
                        {{ __('No active copy traders are available right now.') }}
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
