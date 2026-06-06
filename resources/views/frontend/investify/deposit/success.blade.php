@extends('frontend::layouts.user')
@section('title',__('Deposit Processing'))

@push('style')
<style>
/* Scope everything under .success-page to avoid affecting sidebar/layout */
.success-page {
  display: flex;
  justify-content: center;
  padding: 24px 12px;
}

/* Card container */
.success-card {
  --bg-deep-1:#031a16;
  --bg-deep-2:#062b22;
  --card-grad-1:#0d2e25;
  --card-grad-2:#0b231c;
  --border-soft:#1f4e3a;
  --text-main:#fff;
  --text-sub:#9fd9c3;
  --accent:#fff;
  --accent-2:#38f9c9;
  --warning:#ffc877;

  position: relative;
  width: 100%;
  max-width: 950px;
  color: var(--text-main);
  padding: 32px 24px;
  border-radius: 30px;
  background:;
}

.success-header{
  text-align:center;
  margin-bottom:35px;
}

.success-header h1{
  font-size: clamp(22px, 5vw, 34px);
  font-weight:900;
  letter-spacing:.5px;
  color:#c8ff00;
}

.success-header p{
  color:var(--text-sub);
  font-size:15px;
  margin-top:6px;
}

/* Hide stepper on mobile only */
.stepper{
  display:flex;
  justify-content:center;
  gap:16px;
  align-items:center;
  font-size:14px;
  font-weight:700;
  margin-top:18px;
  flex-wrap:wrap;
}
.step{ display:flex; align-items:center; gap:8px; color:var(--text-sub); }
.circle{
  width:34px; height:34px; border-radius:50%; 
  display:flex; align-items:center; justify-content:center;
  font-weight:900; font-size:15px; transition:.3s ease;
}
.done{
  background:linear-gradient(135deg,var(--accent),var(--accent-2));
  color:#062b22; box-shadow:0 0 18px rgba(180,255,50,.5);
}


/* Receipt card */
.receipt-card{
  background:linear-gradient(145deg,var(--card-grad-1),var(--card-grad-2));
  border:1px solid var(--border-soft);
  border-radius:28px;
  padding:28px;
  box-shadow:
    0 0 0 1px rgba(255,255,255,0.02),
    0 30px 60px rgba(0,0,0,.6),
    0 0 60px rgba(56,249,201,.08);
  backdrop-filter:blur(10px);
}

.card-top{ display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; }
.card-title{ font-weight:900; font-size:20px; letter-spacing:.3px; }
.ref-badge{
  background:rgba(56,249,201,.08);
  border:1px solid rgba(56,249,201,.35);
  color: #c8ff00;
  padding:8px 14px;
  border-radius:12px;
  font-size:13px;
  font-weight:800;
}

.amount-box{
  margin-top:25px;
  background:linear-gradient(135deg, #c8ff00 0%, #081317 50%, #025443 100%);
  border:1px solid var(--border-soft);
  border-radius:22px;
  padding:35px 25px;
  text-align:center;
  box-shadow:inset 0 0 40px rgba(180,255,50,.05);
}
.amount-box .label{ color:var(--text-sub); font-weight:700; font-size:14px; letter-spacing:.4px; }
.amount-box .value{ font-size:42px; font-weight:900; margin:10px 0 6px; color:#fff; }
.amount-box .note{ font-size:14px; color:var(--text-sub); }

.info-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
  gap:18px;
  margin-top:25px;
}
.info-box{
  background:linear-gradient(145deg,#10392e,#0c2e24);
  border:1px solid var(--border-soft);
  border-radius:18px;
  padding:18px;
}
.info-box .label{ font-size:12px; font-weight:700; color:var(--text-sub); margin-bottom:6px; letter-spacing:.3px; }
.info-box .value{ font-weight:900; font-size:15px; color:#c8ff00; }

.status-pill{
  display:inline-flex; align-items:center; gap:8px;
  padding:7px 14px; border-radius:999px;
  background:rgba(255,199,103,.12);
  border:1px solid rgba(255,199,103,.35);
  color:var(--warning); font-size:13px; font-weight:800;
}

.actions{ display:flex; gap:14px; flex-wrap:wrap; margin-top:30px; }
.btn{ padding:14px 22px; border-radius:16px; font-weight:900; text-decoration:none; text-align:center; transition:.3s ease; }
.btn-secondary{ background:rgba(255,255,255,.05); border:1px solid var(--border-soft); color:var(--text-main); }
.btn-secondary:hover{ border-color:var(--accent); box-shadow:0 0 15px rgba(180,255,50,.2); }
.btn-primary{ background:linear-gradient(135deg,var(--accent),var(--accent-2)); color:#062b22; border:none; box-shadow:0 15px 30px rgba(180,255,50,.25); }
.btn-primary:hover{ filter:brightness(1.05); box-shadow:0 18px 35px rgba(180,255,50,.35); }

@media(max-width:768px){
  .success-card{ padding:25px 14px; }
  .amount-box .value{ font-size:30px; }
  .receipt-card{ padding:20px; }
  .stepper{ display:none !important; }
}

@media (max-width: 768px){
  .success-header h1{
    font-size:26px;
  }
}

@media (max-width: 480px){
  .success-header h1{
    font-size:22px;
  }
}

@push('style')
<style>
.success-page{
  --bg-deep-1:#031a16;
  --bg-deep-2:#062b22;
  --card-grad-1:#0d2e25;
  --card-grad-2:#0b231c;
  --border-soft:#1f4e3a;
  --text-main:#fff;
  --text-sub:#fff;
  --accent:#b4ff32;
  --accent-2:#fff;
  --warning:#ffc877;
  --muted:#b7c9c0;

  display:flex;
  justify-content:center;
  padding:24px 12px 40px;
}


.success-card{
  width:100%;
  max-width:620px;
  color:var(--text-main);
  border-radius:28px;
  padding:28px 22px 24px;
  background:;
  border:1px solid rgba(255,255,255,.05);
  box-shadow:0 28px 60px rgba(0,0,0,.42);
  position:relative;
  overflow:hidden;
}

/* top success area */
.success-top{
  text-align:center;
  padding-bottom:22px;
  border-bottom:1px solid rgba(255,255,255,.06);
}

.success-icon-wrap{
  width:86px;
  height:86px;
  margin:0 auto 16px;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  background:radial-gradient(circle, rgba(56,249,201,.22), rgba(56,249,201,.06));
  box-shadow:
    0 0 0 12px rgba(56,249,201,.06),
    0 0 30px rgba(56,249,201,.16);
  position:relative;
}

.success-icon-wrap::before,
.success-icon-wrap::after{
  content:"";
  position:absolute;
  width:6px;
  height:6px;
  border-radius:50%;
  background:rgba(255,255,255,.32);
  top:10px;
}

.success-icon-wrap::before{
  left:-24px;
  box-shadow:
    10px 12px 0 rgba(255,255,255,.20),
    22px -2px 0 rgba(180,255,50,.55),
    30px 18px 0 rgba(255,255,255,.26),
    36px 2px 0 rgba(255,255,255,.18);
}

.success-icon-wrap::after{
  right:-24px;
  box-shadow:
    -10px 12px 0 rgba(255,255,255,.20),
    -22px -2px 0 rgba(180,255,50,.55),
    -30px 18px 0 rgba(255,255,255,.26),
    -36px 2px 0 rgba(255,255,255,.18);
}

.success-check{
  width:48px;
  height:48px;
  border-radius:50%;
  background:linear-gradient(135deg,var(--accent-2),#56ffab);
  display:flex;
  align-items:center;
  justify-content:center;
  color:#062b22;
  font-size:28px;
  font-weight:900;
}

.success-title{
  font-size:18px;
  font-weight:800;
  margin:0 0 10px;
  color:#ffffff;
}

.success-amount{
  font-size:40px;
  line-height:1.05;
  font-weight:900;
  margin:0 0 12px;
  color:#ffffff;
}

.success-sub{
  max-width:420px;
  margin:0 auto;
  font-size:14px;
  line-height:1.6;
  color:var(--muted);
}

/* details body */
.receipt-body{
  padding-top:18px;
}

.detail-row{
  display:grid;
  grid-template-columns: 1fr auto;
  gap:14px;
  align-items:start;
  padding:14px 0;
  border-bottom:1px solid rgba(255,255,255,.06);
}

.detail-row:last-of-type{
  border-bottom:none;
}

.detail-label{
  font-size:13px;
  color:var(--text-sub);
  font-weight:700;
}

.detail-value{
  text-align:right;
  font-size:16px;
  color:#ffffff;
  font-weight:800;
  max-width:260px;
  word-break:break-word;
}

.detail-value.soft{
  font-size:15px;
  color:var(--text-main);
  font-weight:700;
}

.detail-value.accent{
  color:var(--accent);
}

.ref-inline{
  display:inline-flex;
  align-items:center;
  gap:8px;
  flex-wrap:wrap;
  padding:8px 12px;
  border-radius:12px;
  background:rgba(56,249,201,.08);
  border:1px solid rgba(56,249,201,.20);
  color:var(--accent);
  font-size:13px;
  font-weight:800;
}

.status-pill{
  display:inline-flex;
  align-items:center;
  gap:8px;
  padding:8px 14px;
  border-radius:999px;
  background:rgba(255,199,103,.12);
  border:1px solid rgba(255,199,103,.30);
  color:var(--warning);
  font-size:13px;
  font-weight:800;
}

.status-dot{
  width:8px;
  height:8px;
  border-radius:50%;
  background:currentColor;
}

/* promo / note style block */
.receipt-note{
  margin-top:18px;
  padding:16px 18px;
  border-radius:18px;
  border:1px solid rgba(255,255,255,.06);
  background:rgba(255,255,255,.03);
  color:var(--muted);
  font-size:13px;
  line-height:1.6;
}

/* buttons */
.actions{
  display:flex;
  gap:12px;
  flex-wrap:wrap;
  margin-top:22px;
}

.btn{
  flex:1 1 180px;
  min-height:48px;
  border-radius:14px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  text-align:center;
  text-decoration:none;
  font-weight:800;
  font-size:14px;
  transition:.25s ease;
  padding:0 16px;
}

.btn-secondary{
  background:rgba(255,255,255,.06);
  border:1px solid var(--border-soft);
  color:var(--text-main);
}

.btn-secondary:hover{
  border-color:rgba(180,255,50,.35);
  box-shadow:0 0 18px rgba(180,255,50,.10);
}

.btn-primary{
  background:linear-gradient(135deg,var(--accent),var(--accent-2));
  color:#062b22;
  border:none;
  box-shadow:0 14px 28px rgba(180,255,50,.18);
}

.btn-primary:hover{
  filter:brightness(1.04);
}

/* small top tag */
.processing-tag{
  display:inline-flex;
  align-items:center;
  gap:8px;
  padding:6px 12px;
  border-radius:999px;
  background:rgba(255,199,103,.08);
  border:1px solid rgba(255,199,103,.18);
  color:var(--warning);
  font-size:12px;
  font-weight:800;
  margin-bottom:12px;
}

/* responsive */
@media(max-width:768px){
  .success-page{
    padding:16px 10px 28px;
  }

  .success-card{
    padding:22px 16px 18px;
    border-radius:22px;
  }

  .success-icon-wrap{
    width:72px;
    height:72px;
    margin-bottom:14px;
  }

  .success-check{
    width:40px;
    height:40px;
    font-size:24px;
  }

  .success-title{
    font-size:16px;
  }

  .success-amount{
    font-size:30px;
  }

  .success-sub{
    font-size:13px;
  }

  .detail-row{
    grid-template-columns:1fr;
    gap:6px;
    padding:12px 0;
  }

  .detail-value{
    text-align:left;
    max-width:none;
    font-size:15px;
  }

  .detail-value.soft{
    font-size:14px;
  }

  .actions{
    flex-direction:column;
  }

  .btn{
    width:100%;
    flex:none;
    min-height:44px;
  }
}

@media(max-width:480px){
  .success-amount{
    font-size:26px;
  }

  .success-sub{
    font-size:12px;
  }

  .processing-tag{
    font-size:11px;
    padding:5px 10px;
  }

  .detail-label{
    font-size:12px;
  }

  .detail-value{
    font-size:14px;
  }
}
</style>
@endpush
</style>
@endpush

@section('content')
@section('content')
@php
  use App\Models\DepositMethod;

  $reference = $notify['tnx'] ?? $notify['transaction'] ?? null;
  if (!$reference && !empty($notify['strong'])) {
      $reference = trim(str_ireplace('Transaction ID:', '', $notify['strong']));
  }

  $txn = $reference ? \App\Models\Transaction::where('tnx', $reference)->first() : null;

  $gatewayModel = $txn && $txn->method
      ? DepositMethod::code($txn->method)->first()
      : null;

  $depositAmount = $txn->pay_amount
      ?? $txn->final_amount
      ?? $txn->amount
      ?? ($notify['final_amount'] ?? $notify['amount'] ?? $notify['pay_amount'] ?? 0);

  $asset = $gatewayModel->currency
      ?? $txn->pay_currency
      ?? $txn->currency
      ?? ($notify['method_currency'] ?? $notify['asset'] ?? $notify['currency'] ?? $notify['gateway'] ?? $notify['method'] ?? setting('site_currency','global'));

  $statusLabel = $notify['title'] ?? ($txn->status->name ?? __('Pending'));
  $gatewayName = $gatewayModel->name ?? $txn->method ?? $asset;
@endphp

<div class="success-page">
  <div class="success-card">

    <div class="success-top">
      <div class="processing-tag">
        {{ __('Processing...') }}
      </div>

      <div class="success-icon-wrap">
        <div class="success-check">✓</div>
      </div>

      <h1 class="success-title">{{ __('Deposit Receipt') }}</h1>

      <div class="success-amount">
        {{ number_format((float)$depositAmount, 2) }} {{ $asset }}
      </div>

      <p class="success-sub">
        {{ __('Transaction in progress. Blockchain validation is underway. If pending, your balance will be credited after network confirmation.') }}
      </p>
    </div>

    <div class="receipt-body">

      <div class="detail-row">
        <div class="detail-label">{{ __('Reference') }}</div>
        <div class="detail-value">
          <span class="ref-inline">{{ $reference ?? '—' }}</span>
        </div>
      </div>

      <div class="detail-row">
        <div class="detail-label">{{ __('Username') }}</div>
        <div class="detail-value accent">{{ auth()->user()->username ?? auth()->user()->name ?? '—' }}</div>
      </div>

      <div class="detail-row">
        <div class="detail-label">{{ __('Date & Time') }}</div>
        <div class="detail-value accent">{{ now()->format('D, M d, Y h:i A') }}</div>
      </div>

      <div class="detail-row">
        <div class="detail-label">{{ __('Deposit Status') }}</div>
        <div class="detail-value">
          <span class="status-pill">
            <span class="status-dot"></span>
            {{ $statusLabel }}
          </span>
        </div>
      </div>

      <div class="detail-row">
        <div class="detail-label">{{ __('Payment Asset') }}</div>
        <div class="detail-value soft">{{ $gatewayName }}</div>
      </div>

      <div class="receipt-note">
        {{ __('Your deposit has been submitted successfully. Network confirmations may take a short while depending on blockchain traffic and gateway processing speed.') }}
      </div>

      <div class="actions">
        <a href="{{ route('user.deposit.amount') }}" class="btn btn-secondary">
          {{ __('Back to Deposits') }}
        </a>

        <a href="{{ route('user.deposit.log') }}" class="btn btn-secondary">
          {{ __('Deposit History') }}
        </a>

        @if (Route::has('ticket.create'))
          <a href="{{ route('ticket.create') }}" class="btn btn-primary">
            {{ __('Support') }}
          </a>
        @endif
      </div>

    </div>
  </div>
</div>

@endsection