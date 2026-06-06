@extends('frontend::layouts.user')
@section('title') {{ __('Yield') }} @endsection

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
<style>/* PLAN PAGE - BLUE GLASS DAO STYLE */

.staking-page-shell{
  max-width:1260px;
  margin:0 auto;
  padding:18px 14px 42px;
}

/* page background safety */
.container-fluid.default-page{
  background:transparent !important;
}

/* section header */
.staking-plans-section{
  margin:0 0 22px;
  padding:0;
  background:transparent;
}

.staking-plans-header{
  display:flex;
  justify-content:center;
  align-items:center;
  margin:8px 4px 18px;
}

.staking-plans-header h6{
  color:#eef8ff;
  font-size:24px;
  font-weight:700;
  letter-spacing:-.02em;
}

/* swiper */
.swiper{
  width:100% !important;
  padding:12px 4px 42px !important;
}

.swiper-slide{
  display:flex;
  justify-content:center;
  height:auto !important;
  padding:0 8px;
}

.swiper-pagination-bullet{
  background:rgba(226,241,255,.35);
  opacity:1;
}

.swiper-pagination-bullet-active{
  background:#67e8f9;
  width:22px;
  border-radius:999px;
}

.swiper-button-prev,
.swiper-button-next{
  color:#67e8f9;
  width:36px;
  height:36px;
}

/* plan card */
.staking-plan-card{
  position:relative;
  overflow:hidden;
  width:100%;
  min-width:280px;
  max-width:360px;
  padding:22px 20px 20px;
  border-radius:26px;
  background:
    linear-gradient(180deg,rgba(54,84,120,.28),rgba(16,30,54,.62));
  border:1px solid rgba(125,211,252,.20);
  box-shadow:
    0 28px 70px rgba(0,0,0,.34),
    inset 0 1px 0 rgba(255,255,255,.10);
  backdrop-filter:blur(24px) saturate(145%);
  -webkit-backdrop-filter:blur(24px) saturate(145%);
}

.staking-plan-card::before{
  content:"";
  position:absolute;
  inset:0;
  background:
    radial-gradient(circle at 75% 0%, rgba(125,211,252,.20), transparent 24%),
    linear-gradient(120deg, transparent 0%, rgba(255,255,255,.05) 45%, transparent 70%);
  pointer-events:none;
}

.staking-plan-card > *{
  position:relative;
  z-index:2;
}

/* card top */
.plan-top{
  display:flex;
  align-items:center;
  gap:12px;
  margin-bottom:14px;
}

.plan-logo{
  width:52px;
  height:52px;
  min-width:52px;
  border-radius:16px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  background:linear-gradient(135deg,rgba(103,232,249,.22),rgba(37,99,235,.18));
  border:1px solid rgba(125,211,252,.35);
  box-shadow:0 0 26px rgba(56,189,248,.18);
}

.plan-logo img,
.plan-logo svg{
  max-width:34px;
  max-height:34px;
  object-fit:contain;
}

.plan-title{
  color:#eef8ff;
  font-size:16px;
  line-height:1.25;
  font-weight:800;
}

/* APY */
.apy-box{
  background:rgba(56,189,248,.08);
  border:1px solid rgba(125,211,252,.22);
  border-radius:16px;
  padding:13px 14px;
  margin:2px 0 14px;
}

.apy-label{
  color:rgba(226,241,255,.58);
  font-size:11px;
  font-weight:700;
  letter-spacing:.08em;
  text-transform:uppercase;
}

.big-apy{
  color:#67e8f9;
  font-size:26px;
  line-height:1;
  font-weight:900;
  margin-top:6px;
}

/* info rows */
.infobox{
  display:flex;
  align-items:center;
  padding:8px 0;
  border-bottom:1px solid rgba(255,255,255,.06);
  color:rgba(226,241,255,.70);
  font-size:13px;
  line-height:1.45;
}

.infobox:last-child{
  border-bottom:none;
}

.infobox svg{
  margin-right:10px;
  color:#67e8f9;
  opacity:.85;
  width:18px;
  height:18px;
  flex-shrink:0;
}

.infobox strong{
  color:#eef8ff;
  font-weight:800;
  margin-left:6px;
}

/* buttons */
.stake-now-btn,
.calc-stake-btn,
.calculator-row button{
  background:linear-gradient(135deg,#67e8f9 0%,#2563eb 100%);
  color:#ffffff !important;
  font-weight:800;
  border:none;
  border-radius:15px;
  box-shadow:0 16px 36px rgba(37,99,235,.30);
  text-decoration:none;
  transition:all .22s ease;
}

.stake-now-btn{
  display:block;
  width:100%;
  text-align:center;
  padding:13px 0;
  margin-top:16px;
  font-size:14px;
}

.calc-stake-btn{
  display:block;
  width:100%;
  text-align:center;
  margin-top:14px;
  padding:13px 16px;
}

.calculator-row button{
  padding:12px 16px;
  cursor:pointer;
}

.stake-now-btn:hover,
.calc-stake-btn:hover,
.calculator-row button:hover{
  transform:translateY(-1px);
  box-shadow:0 20px 46px rgba(37,99,235,.42);
}

/* calculator */
.calculator-card{
  position:relative;
  overflow:hidden;
  padding:20px;
  margin:20px 4px 0;
  border-radius:26px;
  background:
    linear-gradient(180deg,rgba(54,84,120,.28),rgba(16,30,54,.62));
  border:1px solid rgba(125,211,252,.20);
  box-shadow:
    0 28px 70px rgba(0,0,0,.34),
    inset 0 1px 0 rgba(255,255,255,.10);
  backdrop-filter:blur(24px) saturate(145%);
  -webkit-backdrop-filter:blur(24px) saturate(145%);
}

.calculator-card::before{
  content:"";
  position:absolute;
  inset:0;
  background:
    radial-gradient(circle at 82% 0%, rgba(125,211,252,.16), transparent 26%),
    linear-gradient(120deg, transparent 0%, rgba(255,255,255,.04) 48%, transparent 72%);
  pointer-events:none;
}

.calculator-card > *{
  position:relative;
  z-index:2;
}

.calculator-title{
  color:#eef8ff;
  font-size:20px;
  font-weight:800;
  margin:0 0 14px;
}

.calculator-row{
  display:flex;
  gap:10px;
  flex-wrap:wrap;
  align-items:flex-end;
}

.calculator-row .field{
  flex:1 1 180px;
}

.calculator-row label{
  display:block;
  color:rgba(226,241,255,.62);
  font-size:12px;
  font-weight:700;
  margin-bottom:6px;
}

.calculator-row input{
  width:100%;
  height:48px;
  border-radius:15px;
  border:1px solid rgba(125,211,252,.14);
  background:rgba(25,43,73,.72);
  color:#ffffff;
  padding:0 14px;
  outline:none;
}

.calculator-row input:focus{
  border-color:rgba(56,189,248,.55);
  box-shadow:0 0 0 4px rgba(56,189,248,.10);
}

.calc-results{
  display:flex;
  gap:12px;
  flex-wrap:wrap;
  margin-top:14px;
  align-items:flex-start;
}

.result-box{
  flex:1 1 220px;
  padding:13px;
  border-radius:16px;
  background:rgba(25,43,73,.44);
  border:1px solid rgba(125,211,252,.16);
  color:#eef8ff;
}

.result-label{
  font-size:11px;
  color:rgba(226,241,255,.52);
  margin-bottom:5px;
}

.result-box strong{
  color:#67e8f9;
  font-size:15px;
  display:block;
  line-height:1.35;
}

.chart-box{
  flex:1 1 100%;
  width:100%;
  height:250px;
  display:flex;
  align-items:center;
  justify-content:center;
}

.chart-box canvas{
  width:100% !important;
  height:100% !important;
  max-height:260px;
}

/* responsive */
@media(max-width:768px){
  .staking-page-shell{
    padding:14px 10px 34px;
  }

  .staking-plans-header h6{
    font-size:20px;
  }

  .calculator-row{
    flex-direction:column;
    align-items:stretch;
    gap:10px;
  }

  .calculator-row .field{
    flex:unset;
  }

  .staking-plan-card{
    max-width:340px;
    padding:20px 16px 18px;
  }

  .chart-box{
    height:220px;
  }
}

@media(max-width:480px){
  .staking-plan-card{
    min-width:240px;
    border-radius:22px;
  }

  .plan-logo{
    width:46px;
    height:46px;
    min-width:46px;
  }

  .plan-title{
    font-size:14px;
  }

  .big-apy{
    font-size:23px;
  }

  .calculator-card{
    padding:16px;
    border-radius:22px;
  }
}</style>
@endpush

@push('script')
@php
    $schemasJson = $schemas->map(function ($s) {
        return [
            'id'           => $s->id,
            'name'         => $s->name,
            'type'         => $s->type, // fixed|range
            'min'          => $s->type == 'range' ? $s->min_amount : $s->fixed_amount,
            'max'          => $s->type == 'range' ? $s->max_amount : $s->fixed_amount,
            'fixed_amount' => $s->fixed_amount,
            'interest'     => $s->return_interest,
            'interest_type'=> $s->interest_type, // percentage|fixed
            'periods'      => $s->number_of_period,
            'return_type'  => $s->return_type, // period|unlimited
            'capital_back' => (bool) $s->capital_back,
            'schedule'     => optional($s->schedule)->name,
            'stake_url'    => route('user.schema.preview', $s->id),
        ];
    })->values()->toJson(JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);

    $currencyJson = json_encode($currencySymbol ?? '$', JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT);
@endphp

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.staking-plans-slider', {
        slidesPerView: 1,
        spaceBetween: 12,
        breakpoints: { 700: { slidesPerView: 2, spaceBetween: 18 }, 1100: { slidesPerView: 3, spaceBetween: 20 } },
        loop: false,
        centeredSlides: false,
        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        pagination: { el: '.swiper-pagination', clickable: true },
    });

    const currency = {!! $currencyJson !!};
    const schemas  = {!! $schemasJson !!};

    const amountInput = document.getElementById('calc-amount');
    const bestPlanEl  = document.getElementById('calc-best-plan');
    const roiEl       = document.getElementById('calc-roi');
    const totalEl     = document.getElementById('calc-total');
    const durationEl  = document.getElementById('calc-duration');
    const stakeLink   = document.getElementById('calc-stake-link');
    let chart;

    function formatMoney(v) {
        return currency + Number(v || 0).toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2});
    }

    function pickBest(amount) {
        const fits = schemas.filter(s => {
            if (s.type === 'range') return amount >= s.min && amount <= s.max;
            return amount === s.fixed_amount;
        });
        if (!fits.length) return null;
        return fits.sort((a,b)=> b.interest - a.interest)[0];
    }

    function compute(plan, amount) {
        if (!plan) return {roi:0, total:0, label:'N/A', chart:[0,0]};
        const isPct   = plan.interest_type === 'percentage';
        const periods = plan.return_type === 'period' ? plan.periods : 0;
        const roiPerPeriod = isPct ? amount * (plan.interest/100) : plan.interest;
        let totalReturn, label;
        if (plan.return_type === 'period') {
            const roiTotal = roiPerPeriod * periods;
            totalReturn = roiTotal + (plan.capital_back ? amount : 0);
            label = `${periods} ${periods === 1 ? 'Day' : 'Days'} `;
        } else {
            totalReturn = Infinity;
            label = 'Unlimited';
        }
        return { roi: roiPerPeriod, total: totalReturn, label, chart: plan.return_type === 'period' ? [amount, totalReturn - amount] : [amount, roiPerPeriod] };
    }

    function updateChart(data) {
        const ctx = document.getElementById('calc-chart').getContext('2d');
        if (chart) chart.destroy();
        chart = new Chart(ctx, {
            type: 'doughnut',
            data: { labels: ['Principal', 'Earnings'], datasets: [{ data, backgroundColor: ['#0fa36c', '#c6ff37'], borderWidth: 0 }] },
           options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: true,
            labels: { color: '#e6f7ec' }
        }
    },
    cutout: '65%'
}

        });
    }

   function updateCalc() {
    const amount = parseFloat(amountInput.value);
    if (isNaN(amount) || amount <= 0) {
        bestPlanEl.textContent = '—'; roiEl.textContent = '—'; totalEl.textContent = '—'; durationEl.textContent = '—';
        stakeLink.style.display = 'none'; if (chart) chart.destroy(); return;
    }
    const plan = pickBest(amount);
    const res  = compute(plan, amount);
    if (!plan) {
        bestPlanEl.textContent = 'No matching plan for this amount'; roiEl.textContent = '—'; totalEl.textContent = '—'; durationEl.textContent = '—';
        stakeLink.style.display = 'none'; if (chart) chart.destroy(); return;
    }
    bestPlanEl.textContent = plan.name;
    roiEl.textContent = formatMoney(res.roi) + (plan.return_type === 'period' ? ' ' : '');
    totalEl.textContent = res.total === Infinity ? 'Unlimited' : formatMoney(res.total);
    durationEl.textContent = res.label;

    // Append amount to stake URL so the next page can use it
    const url = new URL(plan.stake_url, window.location.origin);
    url.searchParams.set('amount', amount.toString());
    stakeLink.href = url.toString();

    stakeLink.style.display = 'inline-block';
    updateChart(res.chart);
}
    amountInput.addEventListener('input', updateCalc);
});
</script>
@endpush

@section('content')
<div class="container-fluid default-page">
    <div class="staking-page-shell">

    

        {{-- Existing listing --}}
        <section class="staking-plans-section">
            <div class="staking-plans-header">
                <h6>Available Staking Pools</h6>
            </div>

            <div class="staking-plans-slider swiper">
                <div class="swiper-wrapper">
                    @foreach($schemas as $schema)
                    <div class="swiper-slide">
                        <div class="staking-plan-card">
                            <div class="plan-top">
                                <div class="plan-logo">
                                    @if(!empty($schema->icon))
                                        <img src="{{ asset($schema->icon) }}" alt="{{ $schema->name }} logo">
                                    @else
                                        <svg width="36" height="36"><circle cx="18" cy="18" r="16" fill="#c6ff37" /></svg>
                                    @endif
                                </div>
                                <div class="plan-title">{{ $schema->name }}</div>
                            </div>

                            <div class="apy-box">
                                <div class="apy-label">APY</div>
                                <div class="big-apy">
                                    {{ $schema->interest_type=='percentage' ? $schema->return_interest.'%' : $currencySymbol.$schema->return_interest }}
                                </div>
                            </div>

                            <div class="infobox">
                                <svg viewBox="0 0 22 22" aria-hidden="true"><path d="M17.076 11.621A6.878 6.878 0 1 1 4.5 7.39" stroke="#9cba91" stroke-width="1.6"/><path stroke="#e7ef26" stroke-width="1.5" d="M11 6.5v6h3.25"/></svg>
                                Min Stake <strong>{{ $currencySymbol }}{{ number_format($schema->type=='range' ? $schema->min_amount : $schema->fixed_amount, 2) }}</strong>
                            </div>
                            <div class="infobox">
                                <svg viewBox="0 0 22 22" aria-hidden="true"><path d="M17.076 11.621A6.878 6.878 0 1 1 4.5 7.39" stroke="#9cba91" stroke-width="1.6"/><path stroke="#e7ef26" stroke-width="1.5" d="M11 6.5v6h3.25"/></svg>
                                Max Stake <strong>{{ $currencySymbol }}{{ number_format($schema->type=='range' ? $schema->max_amount : $schema->fixed_amount, 2) }}</strong>
                            </div>
                            <div class="infobox">
                                <svg width="20" height="20" fill="none" viewBox="0 0 20 20" aria-hidden="true"><circle cx="10" cy="10" r="9" stroke="#9cba91" stroke-width="1.4"/><path d="M10 6.25v3.75h2.25" stroke="#e7ef26" stroke-width="1.5" stroke-linecap="round"/></svg>
                                Locked Period <strong>
                                    @if($schema->return_type=="period")
                                        {{ $schema->number_of_period }} Days
                                    @else
                                        Unlimited
                                    @endif
                                </strong>
                            </div>

                            <a href="{{ route('user.schema.preview',$schema->id) }}" class="stake-now-btn">→ Stake Now</a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </section>
        
        
        
        
        
            {{-- Calculator --}}
        <div class="calculator-card">
            <div class="calculator-title">Staking Pool Calculator</div>
            <div class="calculator-row">
                <div class="field">
                    <label for="calc-amount">Enter Amount</label>
                    <input type="number" id="calc-amount" min="0" step="0.01" placeholder="e.g. 1000">
                </div>
                <div class="field" style="flex:0 0 auto;">
                    <button type="button" onclick="/* handled by input event */ null">Calculate</button>
                </div>
            </div>

            <div class="calc-results">
                <div class="result-box">
                    <div class="result-label">Available Pool</div>
                    <strong id="calc-best-plan">—</strong>
                </div>
                <div class="result-box">
                    <div class="result-label">Return</div>
                    <strong id="calc-roi">—</strong>
                </div>
                <div class="result-box">
                    <div class="result-label">Total Return</div>
                    <strong id="calc-total">—</strong>
                </div>
                <div class="result-box">
                    <div class="result-label">Locked Period</div>
                    <strong id="calc-duration">—</strong>
                </div>
                <div class="chart-box">
                    <canvas id="calc-chart" height="120"></canvas>
                </div>
            </div>
<br>
            <a id="calc-stake-link" class="calc-stake-btn" href="#" style="display:none;">→ Stake with this plan</a>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    </div>
</div>
@endsection