@extends('frontend::layouts.user')
@section('title') {{ __('Yield Logs') }} @endsection

@push('style')
<style>.rock-schema-logs-area{
  padding:20px 12px 42px;
}

.rock-dashboard-card{
  padding:18px;
  border-radius:26px;
  background:linear-gradient(180deg,rgba(54,84,120,.28),rgba(16,30,54,.62));
  border:1px solid rgba(125,211,252,.20);
  box-shadow:0 28px 70px rgba(0,0,0,.34), inset 0 1px 0 rgba(255,255,255,.10);
  backdrop-filter:blur(24px) saturate(145%);
}

/* filter */
.rock-filter-table{
  padding-bottom:14px;
}

.rock-filter-table-form{
  display:flex;
  gap:12px;
  align-items:center;
  flex-wrap:wrap;
}

.input-field input.box-input,
.filter-length select{
  min-height:42px;
  background:rgba(25,43,73,.72);
  border:1px solid rgba(125,211,252,.16);
  color:#eef8ff;
  border-radius:14px;
  padding:0 14px;
  font-size:13px;
}

.input-field input.box-input:focus,
.filter-length select:focus{
  border-color:rgba(56,189,248,.55);
  box-shadow:0 0 0 4px rgba(56,189,248,.10);
}

/* log card */
.log-card{
  position:relative;
  overflow:hidden;
  padding:15px;
  margin-bottom:12px;
  border-radius:22px;
  background:rgba(25,43,73,.42);
  border:1px solid rgba(125,211,252,.16);
  transition:.22s ease;
}

.log-card:hover{
  background:rgba(25,43,73,.58);
  transform:translateY(-1px);
}

.log-top{
  display:flex;
  align-items:center;
  gap:12px;
  flex-wrap:wrap;
}

.log-icon{
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

.log-icon svg{
  width:22px;
  height:22px;
}

.log-meta h4{
  color:#eef8ff !important;
  font-size:14px;
  line-height:1.25;
  font-weight:800;
  margin:0;
}

.log-meta p{
  margin:3px 0 0;
  color:rgba(226,241,255,.50);
  font-size:11px;
  line-height:1.35;
}

.log-grid{
  display:grid;
  grid-template-columns:repeat(5,minmax(120px,1fr));
  gap:14px;
  padding-top:14px;
}

.log-item-label{
  color:rgba(226,241,255,.52);
  font-size:10px;
  font-weight:800;
  letter-spacing:.06em;
  text-transform:uppercase;
  margin-bottom:5px;
}

.log-item-value{
  color:#eef8ff;
  font-weight:700;
  font-size:12px;
  line-height:1.45;
  word-break:break-word;
}

/* replace inline green look */
.log-item-value[style]{
  color:#67e8f9 !important;
}

/* timeline */
.timeline-row{
  display:flex;
  align-items:center;
  gap:10px;
  flex-wrap:wrap;
}

.timeline-row .timer{
  color:#eef8ff;
  font-weight:800;
  font-size:11px;
  min-width:112px;
}

.timeline-percent{
  color:#67e8f9;
  font-weight:900;
  font-size:11px;
}

.timeline-circle{
  width:50px;
  height:50px;
  min-width:50px;
  border-radius:50%;
  background:conic-gradient(#67e8f9 0deg, rgba(255,255,255,.08) 0deg);
  display:flex;
  align-items:center;
  justify-content:center;
  position:relative;
}

.timeline-circle::after{
  content:'';
  position:absolute;
  inset:6px;
  background:#0a2030;
  border-radius:50%;
}

.circle-text{
  position:relative;
  z-index:1;
  font-weight:900;
  font-size:11px;
  color:#eef8ff;
}

.progress{
  height:7px;
  background:rgba(255,255,255,.08);
  border-radius:999px;
  overflow:hidden;
  min-width:120px;
}

.progress-bar{
  background:linear-gradient(135deg,#67e8f9,#2563eb) !important;
}

/* badges */
.badge-status{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  min-height:24px;
  padding:0 9px;
  border-radius:999px;
  font-weight:800;
  font-size:10px;
}

.badge-success{
  background:rgba(34,197,94,.14);
  color:#86efac;
}

.badge-warning{
  background:rgba(251,191,36,.14);
  color:#fde68a;
}

.badge-danger{
  background:rgba(248,113,113,.14);
  color:#fecaca;
}

/* empty + pagination */
.alert-table{
  background:rgba(25,43,73,.42);
  border:1px solid rgba(125,211,252,.16);
  color:rgba(226,241,255,.70);
  border-radius:16px;
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

/* responsive */
@media(max-width:992px){
  .log-grid{
    grid-template-columns:repeat(2,1fr);
  }
}

@media(max-width:768px){
  .rock-schema-logs-area{
    padding:12px 8px 36px;
  }

  .rock-dashboard-card{
    padding:12px;
    border-radius:22px;
  }

  .rock-filter-table-form{
    gap:8px;
  }

  .input-field input.box-input,
  .filter-length select{
    width:100%;
    min-height:40px;
    font-size:12px;
  }

  .log-card{
    padding:13px;
    border-radius:18px;
  }

  .log-top{
    gap:10px;
  }

  .log-icon{
    width:36px;
    height:36px;
    min-width:36px;
  }

  .log-meta h4{
    font-size:13px;
  }

  .log-meta p{
    font-size:10px;
  }

  .log-grid{
    grid-template-columns:1fr;
    gap:11px;
    padding-top:12px;
  }

  .log-item-label{
    font-size:9px;
    margin-bottom:3px;
  }

  .log-item-value{
    font-size:11px;
  }

  .timeline-circle{
    width:44px;
    height:44px;
    min-width:44px;
  }

  .circle-text,
  .timeline-row .timer,
  .timeline-percent{
    font-size:10px;
  }

  .badge-status{
    font-size:9px;
    min-height:22px;
  }
}</style>
@endpush

@section('content')
<div class="container-fluid default-page">
    <div class="row gy-30">
        <div class="col-xl-12">
            <div class="rock-schema-logs-area">
                <div class="rock-dashboard-card">
                    <div class="rock-filter-table">
                        <form action="">
                            <div class="rock-filter-table-form">
                                <div class="rock-single-input">
                                    <div class="input-field">
                                        <input type="text" class="box-input" name="query" value="{{ request('query') }}" placeholder="Search here...">
                                        <div class="input-icon">
                                            <button type="submit">
                                                <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M16.9697 17.4697C17.2626 17.1768 17.7374 17.1768 18.0303 17.4697L22.5303 21.9697C22.8232 22.2626 22.8232 22.7374 22.5303 23.0303C22.2374 23.3232 21.7626 23.3232 21.4697 23.0303L16.9697 18.5303C16.6768 18.2374 16.6768 17.7626 16.9697 17.4697Z"
                                                        fill="white" />
                                                    <circle cx="9.5" cy="9.5" r="9.5" transform="matrix(1 0 0 -1 2 21.5)" fill="white" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="filter-length">
                                    <div class="filter-length-select">
                                        <select name="limit">
                                            <option value="10" {{ request('limit') == 10 ? 'selected' : '' }}>10</option>
                                            <option value="15" {{ request('limit') == 15 ? 'selected' : '' }}>15</option>
                                            <option value="20" {{ request('limit') == 20 ? 'selected' : '' }}>20</option>
                                            <option value="25" {{ request('limit') == 25 ? 'selected' : '' }}>25</option>
                                            <option value="30" {{ request('limit') == 30 ? 'selected' : '' }}>30</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @php
                        $logs = $data->when(request('query'),function($query){
                            $query->whereHas('schema',function($schemaQuery){
                                $schemaQuery->where('name','LIKE','%'.request('query').'%');
                            });
                        })->paginate(request()->integer('limit',15))->withQueryString();
                    @endphp

                    {{-- Desktop head --}}
                    

                    <div class="rock-schema-logs-table">
                        <div class="rock-custom-table">
                            <div class="contents">
                                @foreach ($logs as $invest)
                                    @php
                                        $calculateInterest = ($invest->interest * $invest->invest_amount) / 100;
                                        $interest = $invest->interest_type != 'percentage' ? $invest->interest : $calculateInterest;
                                        $periodText = $invest->return_type != 'period'
                                            ? __('Unlimited')
                                            : $invest->number_of_period . ($invest->number_of_period < 2 ? ' Day' : ' Days');
                                    @endphp
                                    <div class="log-card">
                                        <div class="log-top">
                                            <div class="log-icon">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
         xmlns="http://www.w3.org/2000/svg">

        <!-- Outer pool ring -->
        <circle cx="12" cy="12" r="9"
                stroke="url(#poolGradient)"
                stroke-width="2.5"/>

        <!-- Inner DAO nodes -->
        <circle cx="12" cy="7" r="1.8" fill="url(#poolGradient)"/>
        <circle cx="7" cy="14" r="1.8" fill="url(#poolGradient)"/>
        <circle cx="17" cy="14" r="1.8" fill="url(#poolGradient)"/>

        <!-- Connection lines -->
        <line x1="12" y1="7" x2="7" y2="14"
              stroke="url(#poolGradient)"
              stroke-width="1.5"/>
        <line x1="12" y1="7" x2="17" y2="14"
              stroke="url(#poolGradient)"
              stroke-width="1.5"/>
        <line x1="7" y1="14" x2="17" y2="14"
              stroke="url(#poolGradient)"
              stroke-width="1.5"/>

        <!-- Gradient -->
        <defs>
            <linearGradient id="poolGradient" x1="0" y1="0" x2="24" y2="24">
                <stop offset="0%" stop-color="#c6ff37"/>
                <stop offset="100%" stop-color="#38ff9c"/>
            </linearGradient>
        </defs>

    </svg>
</div>

                                            <div class="log-meta">
                                                <h4 class="title gradient-text-1 fw-7">{{ $invest->schema->name }}</h4>
                                                <p class="description">{{ $invest->created_at }}</p>
                                            </div>
                                            <div class="ms-auto">
                                                @if($invest->status->value == 'ongoing')
                                                    <span class="badge-status badge-success">{{ __('Active') }}</span>
                                                @elseif($invest->status->value == 'pending')
                                                    <span class="badge-status badge-warning">{{ __('Pending') }}</span>
                                                @elseif($invest->status->value == 'completed')
                                                    <span class="badge-status badge-success">{{ __('Completed') }}</span>
                                                @else
                                                    <span class="badge-status badge-danger">{{ __('Cancelled') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="log-grid">
                                            
                                            <div>
                                                <div class="log-item-label">{{ __('Stake Amount') }}</div>
                                                <div class="log-item-value" style="color:#41d990;">{{ $currencySymbol.$invest->invest_amount }}</div>
                                            </div>
                                            <div>
                                                <div class="log-item-label">{{ __('Yield Rate') }}</div>
                                                <div class="log-item-value">{{ $invest->interest_type == 'percentage' ? $invest->interest.'%' : $currencySymbol.$invest->interest }}</div>
                                            </div>
                                            <div>
                                                <div class="log-item-label">{{ __('Yield Return') }}</div>
                                                <div class="log-item-value">{{ $invest->already_return_profit.' x '.$interest.' = '.($invest->already_return_profit*$interest).' '.$currency }}</div>
                                            </div>
                                            <div>
                                                <div class="log-item-label">{{ __('Locked Period') }}</div>
                                                <div class="log-item-value">{{ $periodText }}</div>
                                            </div>
                                            
                                            <div>
                                                <div class="log-item-label">{{ __('Pool Timeline') }}</div>
                                                @if($invest->status->value == 'ongoing')
<div class="timeline-row">
    <span class="timer" id="timer{{ $invest->id }}">0D : 0H : 0M : 0S</span>
    <div class="timeline-circle" id="circle{{ $invest->id }}">
        <span class="circle-text" id="circle-text{{ $invest->id }}">0%</span>
    </div>
    <div class="single-progress d-none d-md-block">
        <div class="progress">
            <div class="progress-bar" id="time-progress{{ $invest->id }}" role="progressbar" style="width: 0%;"></div>
        </div>
    </div>
    <span class="timeline-percent d-none d-md-block" id="percent-text{{ $invest->id }}">0%</span>
</div>
@elseif($invest->status->value == 'pending')
    <span class="badge-status badge-warning">{{ __('Pending') }}</span>
@elseif($invest->status->value == 'completed')
    <span class="badge-status badge-success">100%</span>
@else
    <span class="badge-status badge-danger">{{ __('Cancelled') }}</span>
@endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @if(count($logs) == 0)
                                    <div class="alert alert-table mt-20 text-center" role="alert">
                                        {{ __('No Data Found') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
"use strict";

(function ($) {

    const second = 1000,
          minute = second * 60,
          hour   = minute * 60,
          day    = hour * 24;

    const timezone = @json(setting('site_timezone','global'));

    @foreach ($logs as $invest)
        @if($invest->status->value == 'ongoing')
        (function () {

            const investId = {{ $invest->id }};
            const countDownTime = new Date('{{ $invest->next_profit_time }}').getTime();
            const startTime = new Date('{{ $invest->last_profit_time ?? $invest->created_at }}').getTime();

            const interval = setInterval(function () {

                const nowStr = new Date().toLocaleString("en-US", { timeZone: timezone });
                const now = new Date(nowStr).getTime();

                let distance = countDownTime - now;

                let progress = ((now - startTime) / (countDownTime - startTime)) * 100;
                progress = Math.max(0, Math.min(progress, 100));

                // ===== Desktop Progress Bar =====
                $('#time-progress' + investId).css("width", progress.toFixed(2) + '%');
                $('#percent-text' + investId).text(progress.toFixed(2) + '%');

                // ===== Countdown Timer =====
                const d = Math.floor(distance < 0 ? 0 : distance / day);
                const h = Math.floor(distance < 0 ? 0 : (distance % day) / hour);
                const m = Math.floor(distance < 0 ? 0 : (distance % hour) / minute);
                const s = Math.floor(distance < 0 ? 0 : (distance % minute) / second);

                $('#timer' + investId).text(`${d}D : ${h}H : ${m}M : ${s}S`);

                // ===== Circle Progress (Mobile + Desktop) =====
                const deg = progress * 3.6;
                $('#circle' + investId).css(
                    'background',
                    `conic-gradient(#67e8f9 0deg, #67e8f9 ${deg}deg, rgba(255,255,255,0.08) ${deg}deg 360deg)`
                );

                $('#circle-text' + investId).text(progress.toFixed(0) + '%');

                // Stop interval when completed
                if (distance <= 0) {
                    clearInterval(interval);
                    $('#timer' + investId).text("0D : 0H : 0M : 0S");
                    $('#time-progress' + investId).css("width", "100%");
                    $('#percent-text' + investId).text("100%");
                    $('#circle' + investId).css(
                        'background',
                        `conic-gradient(#67e8f9 0deg, #67e8f9 360deg)`
                    );
                    $('#circle-text' + investId).text("100%");
                }

            }, second);

        })();
        @endif
    @endforeach

})(jQuery);
</script>
@endsection
