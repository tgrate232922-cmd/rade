@extends('frontend::layouts.user')
@section('title')
{{ __('DAO Allocation Summary') }}
@endsection

@push('style')
<style>/* PLAN PREVIEW - BLUE GLASS DAO STYLE */

.rock-schema-preview-area{
  display:flex;
  justify-content:center;
  padding:20px 12px 42px;
  background:transparent;
}

.rock-dashboard-card{
  width:100%;
  max-width:760px;
  margin:0 auto;
  overflow:hidden;
  border-radius:28px;
  background:linear-gradient(180deg,rgba(54,84,120,.28),rgba(16,30,54,.62));
  border:1px solid rgba(125,211,252,.20);
  box-shadow:
    0 28px 70px rgba(0,0,0,.34),
    inset 0 1px 0 rgba(255,255,255,.10);
  backdrop-filter:blur(24px) saturate(145%);
  -webkit-backdrop-filter:blur(24px) saturate(145%);
  position:relative;
}

.rock-dashboard-card::before{
  content:"";
  position:absolute;
  inset:0;
  background:
    radial-gradient(circle at 80% 0%, rgba(125,211,252,.18), transparent 25%),
    linear-gradient(120deg, transparent 0%, rgba(255,255,255,.04) 48%, transparent 72%);
  pointer-events:none;
}

.rock-dashboard-card > *{
  position:relative;
  z-index:2;
}

.rock-dashboard-title-inner{
  padding:20px 22px 12px;
}

.rock-dashboard-tile{
  color:#eef8ff;
  font-size:22px;
  font-weight:800;
  margin:0;
  letter-spacing:-.02em;
}

.rock-schema-preview-forrm{
  padding:10px 22px 22px;
}

.rock-custom-table .contents{
  overflow:hidden;
  border-radius:22px;
  background:rgba(25,43,73,.42);
  border:1px solid rgba(125,211,252,.16);
}

.site-table-list{
  display:flex;
  flex-direction:column;
  padding:15px 16px;
  border-bottom:1px solid rgba(255,255,255,.06);
}

.site-table-list:last-child{
  border-bottom:none;
}

.site-table-col:first-child span{
  display:block;
  margin-bottom:6px;
  color:rgba(226,241,255,.55);
  font-size:11px;
  font-weight:800;
  text-transform:uppercase;
  letter-spacing:.08em;
}

.site-table-col:last-child span{
  color:#eef8ff;
  font-size:15px;
  font-weight:700;
}

#return-interest,
#number-period,
#capital_back,
#amount{
  color:#67e8f9 !important;
  font-size:16px !important;
  font-weight:900 !important;
}

/* inputs */
.rock-single-input select,
.input-field input,
.mobile-input,
#select-schema-mobile,
#selectWallet,
#selectWallet-mobile{
  width:100%;
  min-height:48px;
  background:rgba(25,43,73,.72) !important;
  border:1px solid rgba(125,211,252,.16) !important;
  border-radius:15px !important;
  color:#ffffff !important;
  padding:0 14px !important;
  outline:none !important;
}

.rock-single-input select:focus,
.input-field input:focus,
.mobile-input:focus,
#select-schema-mobile:focus,
#selectWallet:focus,
#selectWallet-mobile:focus{
  border-color:rgba(56,189,248,.55) !important;
  box-shadow:0 0 0 4px rgba(56,189,248,.10) !important;
}

.input-group{
  display:flex;
  align-items:center;
}

.input-group-text{
  min-height:48px;
  background:rgba(56,189,248,.10) !important;
  color:#67e8f9 !important;
  border:1px solid rgba(125,211,252,.16) !important;
  border-left:none !important;
  border-radius:0 15px 15px 0 !important;
}

/* mobile cards */
.mobile-preview{
  display:none;
}

.mobile-card{
  background:rgba(25,43,73,.42);
  border:1px solid rgba(125,211,252,.16);
  border-radius:18px;
  padding:14px;
  margin-bottom:12px;
}

.mobile-card label{
  display:block;
  margin-bottom:7px;
  color:rgba(226,241,255,.55);
  font-size:11px;
  font-weight:800;
  text-transform:uppercase;
  letter-spacing:.08em;
}

.mobile-value{
  color:#eef8ff;
  font-size:14px;
  font-weight:700;
}

.mobile-highlight{
  color:#67e8f9;
  font-size:15px;
  font-weight:900;
}

/* submit button */
.rock-input-btn-wrap{
  margin-top:20px;
}

.site-btn.gradient-btn{
  width:100%;
  min-height:54px;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:10px;
  padding:0 18px;
  border-radius:17px !important;
  background:linear-gradient(135deg,#67e8f9 0%,#2563eb 100%) !important;
  color:#ffffff !important;
  font-size:15px;
  font-weight:900;
  border:none !important;
  box-shadow:0 16px 36px rgba(37,99,235,.30);
  transition:all .22s ease;
}

.site-btn.gradient-btn:hover{
  transform:translateY(-1px);
  box-shadow:0 20px 46px rgba(37,99,235,.42);
}

/* responsive */
@media(max-width:768px){
  .desktop-preview{
    display:none;
  }

  .mobile-preview{
    display:block;
  }

  .rock-schema-preview-area{
    padding:16px 10px 36px;
  }

  .rock-dashboard-card{
    max-width:96vw;
    border-radius:24px;
  }

  .rock-dashboard-title-inner{
    padding:18px 18px 8px;
  }

  .rock-dashboard-tile{
    font-size:19px;
  }

  .rock-schema-preview-forrm{
    padding:10px 16px 18px;
  }
}

@media(max-width:480px){
  .rock-dashboard-card{
    max-width:100%;
    border-radius:22px;
  }

  .rock-dashboard-tile{
    font-size:18px;
  }

  .site-btn.gradient-btn{
    min-height:50px;
    font-size:14px;
  }
}</style>
@endpush
@section('content')


<!-- Schema Preview section start -->
<div class="rock-schema-preview-area">
    <div class="rock-dashboard-card">
        
        <div class="rock-dashboard-title-inner">
            <div class="content">
                <h3 class="rock-dashboard-tile">{{ __('Review and Confirm Stakings') }}</h3>
            </div>
        </div>
        <div class="rock-schema-preview-forrm">
            <form action="{{ route('user.invest-now') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="desktop-preview">
                <div class="schema-preview-table table-responsive">
                    <div class="rock-custom-table">
                        <div class="contents">
                            <div class="site-table-list">
                                <div class="site-table-col">
                                    <span>{{ __('Select Yield:') }}</span>
                                </div>
                                <div class="site-table-col">
                                    <div class="rock-single-input">
                                        <div class="input-select">
                                            <select id="select-schema" name="schema_id" required>
                                                @foreach($schemas as $plan)
                                                    <option value="{{$plan->id}}"@if($plan->id == $schema->id ) selected @endif>{{$plan->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="site-table-list">
                                <div class="site-table-col">
                                    <span>{{ __('Amount:') }}</span>
                                </div>
                                <div class="site-table-col">
                                    <span id="amount">
                                        {{ $schema->type == 'range' ? 'Minimum ' . $schema->min_amount .' '.$currency. ' - ' . 'Maximum ' . $schema->max_amount.' '.$currency :  $schema->fixed_amount.' '.$currency }}
                                    </span>
                                </div>
                            </div>
                            <div class="site-table-list">
                                <div class="site-table-col">
                                    <span>{{ __('Enter Amount:') }}</span>
                                </div>
                                <div class="site-table-col">
                                    <div class="rock-single-input">
                                        <div class="input-field input-group">
                                            <input type="text" placeholder="{{ __('Enter Amount') }}" @if($schema->type == 'fixed') value="{{ $schema->fixed_amount }}" readonly @endif placeholder="Enter Amount" oninput="this.value = validateDouble(this.value)" name="invest_amount" id="enter-amount" required>
                                            <span class="input-group-text">{{ $currency }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="site-table-list">
                                <div class="site-table-col">
                                    <span>{{ __('Select Wallet:') }}</span>
                                </div>
                                <div class="site-table-col">
                                    <div class="rock-single-input">
                                        <div class="input-select">
                                           <select name="wallet" required id="selectWallet">
    <option value="main">{{ __('Funding ( ') . $user->balance.' '. $currency }} )</option>
    <option value="profit">{{ __('Spot ( ') . $user->profit_balance.' '. $currency }} )</option>
    <option value="deposit">{{ __('Make Deposit') }}</option>
</select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="site-table-list gatewaySelect"></div>
                            <div class="site-table-list manual-row"></div>
                            <div class="site-table-list">
                                <div class="site-table-col">
                                    <span>{{ __('Yield Rate:') }}</span>
                                </div>
                                <div class="site-table-col">
                                    <span id="return-interest">
                                        {{ ($schema->interest_type == 'percentage' ? $schema->return_interest.'%' : $schema->return_interest.' '.$currency ) .' ('.$schema->schedule->name .')' }}
                                    </span>
                                </div>
                            </div>
                            <div class="site-table-list">
                                <div class="site-table-col">
                                    <span>{{ __('Locked Period:') }}</span>
                                </div>
                                <div class="site-table-col">
                                    <span id="number-period">
                                        {{( $schema->return_type == 'period' ? $schema->number_of_period : 'Unlimited').($schema->number_of_period == 1 ? ' Day' : ' Days' )  }}
                                    </span>
                                </div>
                            </div>
                            <div class="site-table-list">
                                <div class="site-table-col">
                                    <span>{{ __('Principal Return:') }}</span>
                                </div>
                                <div class="site-table-col">
                                    <span id="capital_back">{{ $schema->capital_back ? 'Enabled' : 'No' }}</span>
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
                </div>
                
                
                <div class="mobile-preview">
       
<div class="mobile-card">
    <label>Select Yield</label>
    <select id="select-schema-mobile" name="schema_id" required>
        @foreach($schemas as $plan)
            <option value="{{ $plan->id }}"
                @if($plan->id == $schema->id) selected @endif>
                {{ $plan->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mobile-card">
    <label>Enter Amount</label>
    <input type="text"
           name="invest_amount"
           id="enter-amount-mobile"
           class="mobile-input"
           @if($schema->type == 'fixed') value="{{ $schema->fixed_amount }}" readonly @endif
           required>
</div>

<div class="mobile-card">
    <label>Select Wallet</label>
    <select name="wallet" required id="selectWallet">
    <option value="main">{{ __('Funding ( ') . $user->balance.' '. $currency }} )</option>
    <option value="profit">{{ __('Spot ( ') . $user->profit_balance.' '. $currency }} )</option>
    <option value="deposit">{{ __('Make Deposit') }}</option>
</select>
</div>


<div class="mobile-card">
    <label>Amount Range</label>
    <div class="mobile-value" id="amount-mobile">
        {{ $schema->type == 'range'
            ? 'Minimum '.$schema->min_amount.' '.$currency.' - Maximum '.$schema->max_amount.' '.$currency
            : $schema->fixed_amount.' '.$currency }}
    </div>
</div>

<div class="mobile-card">
    <label>Stake Returns</label>
    <div class="mobile-highlight" id="return-interest-mobile">
        {{ ($schema->interest_type == 'percentage'
            ? $schema->return_interest.'%'
            : $schema->return_interest.' '.$currency ) .' ('.$schema->schedule->name .')' }}
    </div>
</div>

<div class="mobile-card">
    <label>Locked Period</label>
    <div class="mobile-highlight" id="number-period-mobile">
        {{ $schema->return_type == 'period'
            ? $schema->number_of_period.' Days'
            : 'Unlimited' }}
    </div>
</div>
<div class="mobile-card">
    <label>Principal Return</label>
    <div class="mobile-highlight">
        {{ $schema->capital_back ? 'Enabled' : 'No' }}
    </div>
</div>

    </div>
    
               <div class="rock-input-btn-wrap mt-30">
                                <button type="submit" class="site-btn gradient-btn radius-10" href="add-money-successfully.html">
                                    {{ __('Stake Now') }}
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.4"
                                            d="M19 13C19 17.4183 15.4183 21 11 21C6.58172 21 3 17.4183 3 13C3 8.58172 6.58172 5 11 5C15.4183 5 19 8.58172 19 13Z"
                                            fill="white" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M16 3.75C15.5858 3.75 15.25 3.41421 15.25 3C15.25 2.58579 15.5858 2.25 16 2.25H21C21.4142 2.25 21.75 2.58579 21.75 3V8C21.75 8.41421 21.4142 8.75 21 8.75C20.5858 8.75 20.25 8.41421 20.25 8V4.81066L10.5303 14.5303C10.2374 14.8232 9.76256 14.8232 9.46967 14.5303C9.17678 14.2374 9.17678 13.7626 9.46967 13.4697L19.1893 3.75H16Z"
                                            fill="white" />
                                    </svg>
                                </button>
                            </div>
                
            </form>
        
    </div>
</div>
<!-- Schema Preview section end -->
@endsection
@section('script')
<script>
"use strict";


function updateSchemaDisplay(result) {
    // Desktop labels
    $('#amount').html(result.amount_range);
    $('#return-interest').html(result.return_interest);
    $('#number-period').html(result.number_period);
    $('#capital_back').html(result.capital_back);
    // Mobile labels
    $('#amount-mobile').text(result.amount_range);
    $('#return-interest-mobile').text(result.return_interest);
    $('#number-period-mobile').text(result.number_period);
}

$("#select-schema").on('change', function (e) {
    e.preventDefault();
    const id = $(this).val();
    const invest_amount = $("#enter-amount");
    invest_amount.val('').prop('readonly', false);

    let url = '{{ route("user.schema.select", ":id") }}'.replace(':id', id);
    $.ajax({
        url: url,
        success: function (result) {
            updateSchemaDisplay(result);
            if (result.invest_amount > 0) {
                invest_amount.val(result.invest_amount).prop('readonly', true);
            }
        }
    });
});



$("#enter-amount").on('keyup', function () {
    $("#total-amount").html($(this).val());
});

$("#selectWallet").on('change', function () {
    $('.gatewaySelect').empty();
    $('.manual-row').empty();
    if ($(this).val() === 'gateway') {
        $.get('{{ route('gateway.list') }}', function (data) {
            $('.gatewaySelect').append(data);
            $('select').niceSelect();
        });
    }
});

$('body').on('change', '#gatewaySelect', function (e) {
    e.preventDefault();
    $('.manual-row').empty();
    let code = $(this).val();
    let url = '{{ route("user.deposit.gateway",":code") }}'.replace(':code', code);
    $.get(url, function (data) {
        $('.invest-gateway-charge').text('Charge ' + data.charge_gateway);
        if (data.credentials !== undefined) {
            $('.manual-row').append(data.credentials);
            imagePreview();
        }
    });
});

// Prefill from query string (?amount=)
(function () {
    const params = new URLSearchParams(window.location.search);
    const qAmount = params.get('amount');
    if (!qAmount) return;
    const amt = parseFloat(qAmount);
    if (isNaN(amt) || amt <= 0) return;
    const investAmount = $("#enter-amount");
    if (!investAmount.prop('readonly')) {
        investAmount.val(amt);
        $("#total-amount").html(amt);
    }
})();

/* ---------- Mobile sync + toggle submitability ---------- */
function syncDesktopToMobile() {
    $("#select-schema-mobile").val($("#select-schema").val());
    $("#selectWallet-mobile").val($("#selectWallet").val());
    $("#enter-amount-mobile").val($("#enter-amount").val());
}
function syncMobileToDesktop() {
    $("#select-schema").val($("#select-schema-mobile").val()).trigger('change');
    $("#selectWallet").val($("#selectWallet-mobile").val()).trigger('change');
    $("#enter-amount").val($("#enter-amount-mobile").val()).trigger('keyup');
}
function toggleSubmitTargets() {
    const isMobile = window.matchMedia("(max-width: 768px)").matches;
    // Only enable inputs for the visible layout
    $('.mobile-preview :input').prop('disabled', !isMobile);
    $('.desktop-preview :input').prop('disabled', isMobile);
    if (isMobile) { syncDesktopToMobile(); } else { syncMobileToDesktop(); }
}
$("#select-schema-mobile").on('change', syncMobileToDesktop);
$("#selectWallet-mobile").on('change', syncMobileToDesktop);
$("#enter-amount-mobile").on('keyup', syncMobileToDesktop);

window.addEventListener('resize', toggleSubmitTargets);
toggleSubmitTargets();

$("#selectWallet").on('change', function () {
    const wallet = $(this).val();
    $('.gatewaySelect').empty();
    $('.manual-row').empty();

    if (wallet === 'deposit') {
        window.location.href = "{{ route('user.deposit.amount') }}";
        return;
    }

    // If you still need gateway handling, keep it below; otherwise remove:
    if (wallet === 'gateway') {
        $.get('{{ route('gateway.list') }}', function (data) {
            $('.gatewaySelect').append(data);
            $('select').niceSelect();
        });
    }
});
// Intercept submit: if wallet == deposit, go to deposit page
$('form[action="{{ route('user.invest-now') }}"]').on('submit', function (e) {
    const wallet = $('#selectWallet').val();
    if (wallet === 'deposit') {
        e.preventDefault();
        window.location.href = "{{ route('user.deposit.amount') }}";
    }
});
$("#selectWallet-mobile").on('change', function () {
    $("#selectWallet").val($(this).val());
});
</script>
@endsection
