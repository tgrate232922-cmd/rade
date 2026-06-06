@extends('frontend::layouts.user')
@section('title')
    {{ __('Withdraw Successful') }}
@endsection

@push('style')
<style>
.withdraw-success-page{
  --bg-deep-1:#031a16;
  --bg-deep-2:#062b22;
  --card-grad-1:#0d2e25;
  --card-grad-2:#0b231c;
  --border-soft:#1f4e3a;
  --text-main:#eafff4;
  --text-sub:#9fd9c3;
  --accent:#b4ff32;
  --accent-2:#38f9c9;
  --warning:#ffc877;
  --muted:#b7c9c0;

  display:flex;
  justify-content:center;
  padding:24px 12px 40px;
}

.withdraw-success-card{
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

.withdraw-success-top{
  text-align:center;
  padding-bottom:22px;
  border-bottom:1px solid rgba(255,255,255,.06);
}

.withdraw-tag{
  display:inline-flex;
  align-items:center;
  gap:8px;
  padding:6px 12px;
  border-radius:999px;
  background:rgba(56,249,201,.08);
  border:1px solid rgba(56,249,201,.18);
  color:var(--accent-2);
  font-size:12px;
  font-weight:800;
  margin-bottom:12px;
}

.withdraw-icon-wrap{
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

.withdraw-icon-wrap::before,
.withdraw-icon-wrap::after{
  content:"";
  position:absolute;
  width:6px;
  height:6px;
  border-radius:50%;
  background:rgba(255,255,255,.32);
  top:10px;
}

.withdraw-icon-wrap::before{
  left:-24px;
  box-shadow:
    10px 12px 0 rgba(255,255,255,.20),
    22px -2px 0 rgba(180,255,50,.55),
    30px 18px 0 rgba(255,255,255,.26),
    36px 2px 0 rgba(255,255,255,.18);
}

.withdraw-icon-wrap::after{
  right:-24px;
  box-shadow:
    -10px 12px 0 rgba(255,255,255,.20),
    -22px -2px 0 rgba(180,255,50,.55),
    -30px 18px 0 rgba(255,255,255,.26),
    -36px 2px 0 rgba(255,255,255,.18);
}

.withdraw-check{
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

.withdraw-success-title{
  font-size:18px;
  font-weight:800;
  margin:0 0 10px;
  color:#ffffff;
}

.withdraw-success-sub{
  max-width:440px;
  margin:0 auto;
  font-size:14px;
  line-height:1.6;
  color:var(--muted);
}

.withdraw-body{
  padding-top:18px;
}

.withdraw-detail-row{
  display:grid;
  grid-template-columns: 1fr auto;
  gap:14px;
  align-items:start;
  padding:14px 0;
  border-bottom:1px solid rgba(255,255,255,.06);
}

.withdraw-detail-row:last-of-type{
  border-bottom:none;
}

.withdraw-detail-label{
  font-size:13px;
  color:var(--text-sub);
  font-weight:700;
}

.withdraw-detail-value{
  text-align:right;
  font-size:16px;
  color:#ffffff;
  font-weight:800;
  max-width:260px;
  word-break:break-word;
}

.withdraw-detail-value.soft{
  font-size:15px;
  color:var(--text-main);
  font-weight:700;
}

.transaction-badge-custom{
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

.withdraw-note{
  margin-top:18px;
  padding:16px 18px;
  border-radius:18px;
  border:1px solid rgba(255,255,255,.06);
  background:rgba(255,255,255,.03);
  color:var(--muted);
  font-size:13px;
  line-height:1.6;
}

.withdraw-actions{
  display:flex;
  gap:12px;
  flex-wrap:wrap;
  margin-top:22px;
}

.withdraw-btn{
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

.withdraw-btn-secondary{
  background:rgba(25,43,73,.50);
  border:1px solid rgba(125,211,252,.18);
  color:#67e8f9;
  backdrop-filter:blur(10px);
}

.withdraw-btn-secondary:hover{
  border-color:rgba(56,189,248,.45);
  box-shadow:0 0 16px rgba(56,189,248,.18);
  color:#7dd3fc;
}

/* primary button */
.withdraw-btn-primary{
  background:linear-gradient(135deg,#67e8f9 0%, #2563eb 100%);
  color:#ffffff;
  border:none;
  box-shadow:0 14px 28px rgba(37,99,235,.30);
  transition:all .25s ease;
}

.withdraw-btn-primary:hover{
  filter:brightness(1.06);
  box-shadow:0 18px 36px rgba(37,99,235,.40);
  color:#ffffff;
  transform:translateY(-1px);
}

.withdraw-btn-primary span{
  display:inline-flex;
  align-items:center;
  margin-left:8px;
}

@media(max-width:768px){
  .withdraw-success-page{
    padding:16px 10px 28px;
  }

  .withdraw-success-card{
    padding:22px 16px 18px;
    border-radius:22px;
  }

  .withdraw-icon-wrap{
    width:72px;
    height:72px;
    margin-bottom:14px;
  }

  .withdraw-check{
    width:40px;
    height:40px;
    font-size:24px;
  }

  .withdraw-success-title{
    font-size:16px;
  }

  .withdraw-success-sub{
    font-size:13px;
  }

  .withdraw-detail-row{
    grid-template-columns:1fr;
    gap:6px;
    padding:12px 0;
  }

  .withdraw-detail-value{
    text-align:left;
    max-width:none;
    font-size:15px;
  }

  .withdraw-detail-value.soft{
    font-size:14px;
  }

  .withdraw-actions{
    flex-direction:column;
  }

  .withdraw-btn{
    width:100%;
    flex:none;
    min-height:44px;
  }
}

@media(max-width:480px){
  .withdraw-success-sub{
    font-size:12px;
  }

  .withdraw-tag{
    font-size:11px;
    padding:5px 10px;
  }

  .withdraw-detail-label{
    font-size:12px;
  }

  .withdraw-detail-value{
    font-size:14px;
  }
}
</style>
@endpush

@section('content')
<div class="withdraw-success-page">
    <div class="withdraw-success-card">

        <div class="withdraw-success-top">
            <div class="withdraw-tag">
                {{ __('Withdrawal Update') }}
            </div>

            <div class="withdraw-icon-wrap">
                <div class="withdraw-check">✓</div>
            </div>

            <h1 class="withdraw-success-title">{{ $notify['title'] }}</h1>

            <p class="withdraw-success-sub">
                {{ $notify['p'] }}
            </p>
        </div>

        <div class="withdraw-body">

            <div class="withdraw-detail-row">
                <div class="withdraw-detail-label">{{ __('Receipt Title') }}</div>
                <div class="withdraw-detail-value soft">{{ $notify['card-header'] }}</div>
            </div>

            <div class="withdraw-detail-row">
                <div class="withdraw-detail-label">{{ __('Transaction Reference') }}</div>
                <div class="withdraw-detail-value">
                    <span class="transaction-badge-custom">{{ $notify['strong'] }}</span>
                </div>
            </div>

            <div class="withdraw-detail-row">
                <div class="withdraw-detail-label">{{ __('Username') }}</div>
                <div class="withdraw-detail-value">{{ auth()->user()->username ?? auth()->user()->name ?? '—' }}</div>
            </div>

            <div class="withdraw-detail-row">
                <div class="withdraw-detail-label">{{ __('Date & Time') }}</div>
                <div class="withdraw-detail-value">{{ now()->format('D, M d, Y h:i A') }}</div>
            </div>

            <div class="withdraw-note">
                {{ __('Your withdrawal request has been processed successfully. You can review the full record in your withdrawal history or continue with the action provided below.') }}
            </div>

            <div class="withdraw-actions">
                <a class="withdraw-btn withdraw-btn-secondary" href="{{ route('user.withdraw.log') }}">
                    {{ __('Withdraw History') }}
                </a>

                <a class="withdraw-btn withdraw-btn-primary" href="{{ $notify['action'] }}">
                    {{ $notify['a'] }}
                    <span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4"
                                d="M19 13C19 17.4183 15.4183 21 11 21C6.58172 21 3 17.4183 3 13C3 8.58172 6.58172 5 11 5C15.4183 5 19 8.58172 19 13Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M16 3.75C15.5858 3.75 15.25 3.41421 15.25 3C15.25 2.58579 15.5858 2.25 16 2.25H21C21.4142 2.25 21.75 2.58579 21.75 3V8C21.75 8.41421 21.4142 8.75 21 8.75C20.5858 8.75 20.25 8.41421 20.25 8V4.81066L10.5303 14.5303C10.2374 14.8232 9.76256 14.8232 9.46967 14.5303C9.17678 14.2374 9.17678 13.7626 9.46967 13.4697L19.1893 3.75H16Z"
                                fill="white" />
                        </svg>
                    </span>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection