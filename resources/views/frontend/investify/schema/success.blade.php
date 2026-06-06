@extends('frontend::layouts.user')
@section('title') {{ __('Stake Successful') }} @endsection

@push('style')
<style>/* SUCCESS PAGE - BLUE GLASS DAO STYLE */

.success-shell{
  max-width:720px;
  margin:0 auto;
  padding:20px 12px 42px;
}

.success-card{
  position:relative;
  overflow:hidden;
  padding:24px;
  border-radius:28px;
  color:#eef8ff;
  background:linear-gradient(180deg,rgba(54,84,120,.28),rgba(16,30,54,.62));
  border:1px solid rgba(125,211,252,.20);
  box-shadow:
    0 28px 70px rgba(0,0,0,.34),
    inset 0 1px 0 rgba(255,255,255,.10);
  backdrop-filter:blur(24px) saturate(145%);
}

.success-card::before{
  content:"";
  position:absolute;
  inset:0;
  background:
    radial-gradient(circle at 80% 0%, rgba(125,211,252,.18), transparent 25%),
    linear-gradient(120deg, transparent 0%, rgba(255,255,255,.04) 48%, transparent 72%);
  pointer-events:none;
}

.success-card > *{
  position:relative;
  z-index:2;
}

.success-head{
  display:flex;
  align-items:center;
  gap:16px;
  margin-bottom:18px;
}

.success-icon{
  width:66px;
  height:66px;
  min-width:66px;
  border-radius:50%;
  display:grid;
  place-items:center;
  color:#ffffff;
  font-size:30px;
  font-weight:900;
  background:linear-gradient(135deg,#67e8f9 0%,#2563eb 100%);
  box-shadow:
    0 16px 36px rgba(37,99,235,.35),
    0 0 0 7px rgba(56,189,248,.08);
}

.success-title{
  font-size:23px;
  line-height:1.2;
  font-weight:900;
  margin:0 0 5px;
  color:#eef8ff;
}

.success-sub{
  color:rgba(226,241,255,.62);
  font-size:14px;
  line-height:1.55;
  margin:0;
}

.detail-list{
  margin-top:18px;
  border-top:1px solid rgba(255,255,255,.07);
}

.detail-row{
  display:flex;
  justify-content:space-between;
  gap:16px;
  padding:12px 0;
  border-bottom:1px solid rgba(255,255,255,.06);
}

.detail-row span.label{
  color:rgba(226,241,255,.55);
  font-size:12px;
  font-weight:800;
  text-transform:uppercase;
  letter-spacing:.06em;
}

.detail-row span.value{
  color:#67e8f9;
  font-size:14px;
  font-weight:900;
  text-align:right;
  word-break:break-word;
}

.actions{
  display:flex;
  gap:10px;
  margin-top:20px;
  flex-wrap:wrap;
}

.btn-ghost,
.btn-primary{
  flex:1 1 180px;
  min-height:48px;
  display:flex;
  align-items:center;
  justify-content:center;
  text-align:center;
  padding:0 14px;
  border-radius:15px;
  text-decoration:none;
  font-size:14px;
  font-weight:900;
}

.btn-ghost{
  border:1px solid rgba(125,211,252,.22);
  color:#67e8f9 !important;
  background:rgba(25,43,73,.42);
}

.btn-primary{
  border:none;
  color:#ffffff !important;
  background:linear-gradient(135deg,#67e8f9 0%,#2563eb 100%);
  box-shadow:0 16px 36px rgba(37,99,235,.30);
}

.btn-primary:hover,
.btn-ghost:hover{
  transform:translateY(-1px);
}

@media(max-width:600px){
  .success-shell{
    padding:16px 10px 36px;
  }

  .success-card{
    padding:18px;
    border-radius:24px;
  }

  .success-head{
    gap:12px;
    align-items:flex-start;
  }

  .success-icon{
    width:52px;
    height:52px;
    min-width:52px;
    font-size:24px;
  }

  .success-title{
    font-size:19px;
  }

  .success-sub{
    font-size:13px;
    line-height:1.5;
  }

  .detail-row{
    flex-direction:column;
    gap:5px;
    padding:11px 0;
  }

  .detail-row span.value{
    text-align:left;
    font-size:13px;
    line-height:1.45;
  }

  .btn-ghost,
  .btn-primary{
    flex:1 1 100%;
    min-height:46px;
    font-size:13px;
  }
}</style>
@endpush

@section('content')
<div class="container-fluid default-page">
  <div class="success-shell">
    <div class="success-card">
      <div class="success-head">
        <div class="success-icon">✓</div>
        <div>
          <h3 class="success-title">{{ __('Stake Successful') }}</h3>
          <p class="success-sub">{{ __('Your capital has been allocated to the selected DAO pool.') }}</p>
        </div>
      </div>

      <div class="detail-list">
        <div class="detail-row">
          <span class="label">{{ __('Pool') }}</span>
          <span class="value">{{ $schema->name ?? __('N/A') }}</span>
        </div>
        <div class="detail-row">
          <span class="label">{{ __('Committed Capital') }}</span>
          <span class="value">{{ ($currency ?? '$') }} {{ number_format($amount ?? 0, 2) }}</span>
        </div>
        <div class="detail-row">
          <span class="label">{{ __('Yield Rate') }}</span>
          <span class="value">
            @if(isset($schema) && $schema->interest_type === 'percentage')
              {{ $schema->return_interest }}%
            @else
              {{ ($currency ?? '$') }}{{ $schema->return_interest ?? 0 }}
            @endif
            @if(isset($schema) && $schema->schedule)
  / (Cycle)
@endif
          </span>
        </div>
        <div class="detail-row">
          <span class="label">{{ __('Locked Period') }}</span>
          <span class="value">
            @if(isset($schema) && $schema->return_type === 'period')
              {{ $schema->number_of_period }} {{ $schema->number_of_period == 1 ? __('Day') : __('Days') }}
            @else
              {{ __('Unlimited') }}
            @endif
          </span>
        </div>
        <div class="detail-row">
          <span class="label">{{ __('Principal Return') }}</span>
          <span class="value">{{ (isset($schema) && $schema->capital_back) ? __('Enabled') : __('No') }}</span>
        </div>
        @if(!empty($txid))
        <div class="detail-row">
          <span class="label">{{ __('Reference') }}</span>
          <span class="value">{{ $txid }}</span>
        </div>
        @endif
      </div>

      @php
    $plansUrl = Route::has('user.schema.index')
        ? route('user.schema.index')
        : ((Route::has('user.schema.preview') && isset($schema))
            ? route('user.schema.preview', $schema->id)
            : url()->previous());
@endphp

<div class="actions">
    <a class="btn-ghost" href="{{ $plansUrl }}">{{ __('View Other Plans') }}</a>
    <a class="btn-primary" href="{{ route('user.invest-logs') }}">{{ __('Go to Portfolio') }}</a>
</div>
    </div>
  </div>
</div>
@endsection