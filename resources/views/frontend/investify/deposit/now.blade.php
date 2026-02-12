@extends('frontend::layouts.user')
@section('title',__('Deposit'))
@section('content')
<div class="container-fluid default-page">
    <div class="row gy-30">
        <div class="col-xxl-12">
            <div class="rock-add-money-area">
                <div class="rock-dashboard-card">
                    <div class="rock-dashboard-title-inner">
                        <div class="content">
                            <h3 class="rock-dashboard-tile">{{ __('Deposit Amount') }}</h3>
                            <p class="description">{{ __('Enter your deposit details') }}</p>
                        </div>
                        <a class="site-btn gradient-btn radius-12" href="{{ route('user.deposit.log') }}">{{ __('Deposit History') }}</a>
                    </div>
                    <div class="rock-add-mony-wrapper">
                        <form action="{{ route('user.deposit.now') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-30">
                                <div class="col-xxl-6 col-xl-6 col-lg-6 ">
                                    <div class="rock-single-input">
                                        <label class="input-label" for="">{{ __('Payment Method') }}</label>
                                        <div class="input-select">
                                            <select name="gateway_code" id="gatewaySelect" class="site-nice-select">
                                                <option selected disabled>--{{ __('Select Gateway') }}--</option>
                                                @foreach($gateways as $gateway)
                                                <option value="{{ $gateway->gateway_code }}">{{ $gateway->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <p class="input-description charge"></p>
                                    </div>
                                    <div class="rock-single-input">
                                        <label class="input-label" for="">{{ __('Enter Amount:') }}</label>
                                        <div class="input-field">
                                            <input type="text" class="box-input" name="amount" id="amount" oninput="this.value = validateDouble(this.value)" aria-label="Amount">
                                            <span class="input-icon">
                                                <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4"
                                                        d="M22 12.5C22 18.0228 17.5228 22.5 12 22.5C6.47715 22.5 2 18.0228 2 12.5C2 6.97715 6.47715 2.5 12 2.5C17.5228 2.5 22 6.97715 22 12.5Z"
                                                        fill="white" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M12 6.25C12.4142 6.25 12.75 6.58579 12.75 7V7.85352C13.9043 8.17998 14.75 9.24122 14.75 10.5C14.75 10.9142 14.4142 11.25 14 11.25C13.5858 11.25 13.25 10.9142 13.25 10.5C13.25 9.80964 12.6904 9.25 12 9.25C11.3096 9.25 10.75 9.80964 10.75 10.5C10.75 11.1904 11.3096 11.75 12 11.75C13.5188 11.75 14.75 12.9812 14.75 14.5C14.75 15.7588 13.9043 16.82 12.75 17.1465V18C12.75 18.4142 12.4142 18.75 12 18.75C11.5858 18.75 11.25 18.4142 11.25 18V17.1465C10.0957 16.82 9.25 15.7588 9.25 14.5C9.25 14.0858 9.58579 13.75 10 13.75C10.4142 13.75 10.75 14.0858 10.75 14.5C10.75 15.1904 11.3096 15.75 12 15.75C12.6904 15.75 13.25 15.1904 13.25 14.5C13.25 13.8096 12.6904 13.25 12 13.25C10.4812 13.25 9.25 12.0188 9.25 10.5C9.25 9.24122 10.0957 8.17998 11.25 7.85352V7C11.25 6.58579 11.5858 6.25 12 6.25Z"
                                                        fill="white" />
                                                </svg>
                                            </span>
                                        </div>
                                        <p class="input-description min-max"></p>
                                    </div>

                                  <div class="row manual-row">
  <div id="manual-credentials" class="col-12"></div>
  <div id="manual-fields" class="col-12"></div>  <!-- NEW: manual inputs (incl. file) go here -->
</div>
                                </div>

                                <div class="col-xxl-6 col-xl-6 col-lg-6 ">
                                    <div class="rock-add-mony-details">
                                        <h4 class="title">{{ __('Review Details') }}</h4>
                                        <div class="rock-add-mony-list">
                                            <ul>
                                                <li>
                                                    <span class="title">{{ __('Amount') }}</span>
                                                    <span class="info"><span class="amount"></span> <span class="currency"></span></span>
                                                </li>
                                                <li>
                                                    <span class="title">{{ __('Charge') }}</span>
                                                    <span class="info charge2"></span>
                                                </li>
                                                <li>
                                                    <span class="title">{{ __('Payment Method') }}</span>
                                                    <span class="tumb" id="logo">
                                                        <img src="" class="payment-method">
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="title">{{ __('Total') }}</span>
                                                    <span class="title total"></span>
                                                </li>
                                                <li>
                                                    <span class="title">{{ __('Conversion Rate') }}</span>
                                                    <span class="info conversion-rate"></span>
                                                </li>
                                                <li>
                                                    <span class="title">{{ __('Pay Amount') }}</span>
                                                    <span class="info pay-amount"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="rock-input-btn-wrap justify-content-end">
                                    <button type="submit" class="site-btn gradient-btn radius-10">
                                        {{ __('Proceed to Payment') }}
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
var globalData;
var currency = @json($currency)

$("#gatewaySelect").on('change', function (e) {
  "use strict";
  e.preventDefault();

  const code = $(this).val();
  const url  = '{{ route("user.deposit.gateway",":code") }}'.replace(':code', code);

  // Loading state only once
  $('#manual-credentials').html('<div class="col-12"><em>Loading…</em></div>');
  $('#manual-fields').empty();

  $.get(url)
    .done(function (data) {
      globalData = data;

      // Side summary
      $('.charge').text('Charge ' + data.charge + ' ' + (data.charge_type === 'percentage' ? '%' : currency));
      $('.conversion-rate').text('1 ' + currency + ' = ' + data.rate + ' ' + data.currency);
      $('.min-max').text('Minimum ' + data.minimum_deposit + ' ' + currency + ' and Maximum ' + data.maximum_deposit + ' ' + currency);
      $('#logo').html(`<img class="payment-method" src='${data.gateway_logo}'>`);

      // Totals (if amount already typed)
      var amount = $('#amount').val();
      if (Number(amount) > 0) {
        $('.amount').text(Number(amount));
        var charge = data.charge_type === 'percentage' ? calPercentage(amount, data.charge) : data.charge;
        $('.charge2').text(charge + ' ' + currency);
        var total = Number(amount) + Number(charge);
        $('.total').text(total + ' ' + currency);
        $('.pay-amount').text(total * data.rate + ' ' + data.currency);
      } else {
        $('.amount, .charge2, .total, .pay-amount').text('');
      }

    // Replace (don’t append) credentials + dynamic fields
// Replace (don’t append) credentials + dynamic fields
var cred = (data && data.credentials)
  ? data.credentials
  : '<div class="col-12"><em>No instructions yet.</em></div>';

$('#manual-credentials').html(cred);

// Draw our own QR from the wallet address (and keep only one)
ensureQrLib().then(() => {
  renderWalletQR();             // first pass
  setTimeout(renderWalletQR, 80);  // second pass after layout/fonts
  setTimeout(dedupeQR, 120);       // remove any extra QR elements
});


// Re-apply helpers
if (typeof imagePreview === 'function') imagePreview();
enhanceFileInputs();


  // Clean rebind amount handler
  $('#amount').off('keyup').on('keyup', function () {
    var amount = $(this).val();
    $('.amount').text(Number(amount));
    $('.currency').text(currency);

    var charge = globalData.charge_type === 'percentage'
      ? calPercentage(amount, globalData.charge)
      : globalData.charge;

    $('.charge2').text(charge + ' ' + currency);

    var total = Number(amount) + Number(charge);
    $('.total').text(total + ' ' + currency);
    $('.pay-amount').text(total * globalData.rate + ' ' + globalData.currency);
  });

}); // <-- closes $.get(...).done(...)
}); // <-- closes $("#gatewaySelect").on('change', ...)
</script>

<script>
function dedupeQR(){
  // Remove any extra QR-like elements, keep the first
  const $qrs = $('#manual-credentials .qr-code, #manual-credentials [data-qr], #manual-credentials #qr, #manual-credentials img[alt*="QR"], #manual-credentials canvas.qr');
  if ($qrs.length > 1) { $qrs.slice(1).remove(); }
}
</script>
<script>
// Load qrcode.js once (CDN)
let qrLibPromise;
function ensureQrLib(){
  if (window.QRCode) return Promise.resolve();
  if (qrLibPromise) return qrLibPromise;
  qrLibPromise = new Promise((resolve, reject) => {
    const s = document.createElement('script');
    s.src = 'https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js';
    s.onload = resolve;
    s.onerror = reject;
    document.head.appendChild(s);
  });
  return qrLibPromise;
}

// Read wallet address from the widget and render a QR
function renderWalletQR(){
  const wrap = document.querySelector('#manual-credentials .wallet-widget');
  if (!wrap) return;

  const addrEl = wrap.querySelector('[data-wallet], .wallet-address');
  const val = (addrEl?.getAttribute('data-wallet') || addrEl?.textContent || '').trim();
  if (!val) return;

  // ensure a holder just above the final note line
  let holder = wrap.querySelector('.qr-holder');
  if (!holder) {
    holder = document.createElement('div');
    holder.className = 'qr-holder';
    holder.style.margin = '10px 0 14px';
    const last = wrap.lastElementChild;
    if (last) wrap.insertBefore(holder, last); else wrap.appendChild(holder);
  }
  holder.innerHTML = ''; // clear previous

  new QRCode(holder, {
    text: val,
    width: 140,
    height: 140,
    correctLevel: QRCode.CorrectLevel.M
  });
}

// If server also injects a QR, remove extras (but keep the one inside .qr-holder)
function dedupeQR(){
  const all = document.querySelectorAll(
    '#manual-credentials .qr-code, ' +
    '#manual-credentials [data-qr], '  +
    '#manual-credentials #qr, '        +
    '#manual-credentials canvas.qr, '  +
    '#manual-credentials img[alt*="QR"]'
  );
  let keptOne = false;
  all.forEach(el => {
    // Keep elements that are inside our own holder
    const insideOurHolder = el.closest('.qr-holder') !== null;
    if (insideOurHolder) { keptOne = true; return; }

    // Otherwise keep only the first, remove the rest
    if (keptOne) { el.remove(); }
    else { keptOne = true; }
  });
}
</script>

<script>
document.addEventListener('click', async (e) => {
  const btn = e.target.closest('.wallet-widget .copy-btn, .copy-btn');
  if (!btn) return;
  const wrap = btn.closest('.wallet-widget') || document;
  const el = wrap.querySelector('[data-wallet], .wallet-address, #walletAddress');
  const text = (el?.getAttribute('data-wallet') || el?.textContent || '').trim();
  if (!text) return;
  try { await navigator.clipboard.writeText(text); }
  catch { const t=document.createElement('textarea'); t.value=text; document.body.appendChild(t);
          t.select(); document.execCommand('copy'); t.remove(); }
  const old = btn.textContent; btn.textContent = 'Copied! ✅';
  setTimeout(()=> btn.textContent = old, 1200);
});
</script>
<script>
function enhanceFileInputs(){
  // Wrap any raw file inputs and hide duplicate helpers
  $('#manual-credentials input[type="file"], #manual-fields input[type="file"]').each(function(){
    var $input = $(this);
    if ($input.data('boxed')) return; // prevent double-wrapping
    $input.data('boxed', true);

    var $group = $input.closest('.site-input-groups');
    var $origLabel = $group.find('label.box-input-label').first();
    var labelText = ($origLabel.text() || '').trim() || 'Upload file';

    // Hide original label + small helpers to prevent duplicates
    $origLabel.attr({'aria-hidden':'true'}).css('display','none');
    $group.find('small, .input-description, .text-muted').hide();

    // Accessibility
    $input.attr('aria-label', labelText);

    // Build the box and move the input inside
    var $box = $(`
      <label class="file-box">
        <div class="label">${labelText}</div>
        <div class="hint">Click here to upload (PNG, JPG, PDF)</div>
        <div class="chosen"></div>
      </label>
    `);
    $input.after($box);
    $box.prepend($input);

    // Show selected filename
    $input.on('change', function(){
      var name = this.files && this.files.length ? this.files[0].name : '';
      var $chosen = $box.find('.chosen');
      if (name){ $chosen.text('Selected: ' + name).show(); }
      else { $chosen.hide(); }
    });
  });
}
</script>




<style>
  /* === Wallet widget theme tokens (edit these) === */
  :root{
    --wallet-bg: #0e17265c;         /* background */
    --wallet-border: #1b2a41;     /* border */
    --wallet-text: #e8f1ff;       /* main text */
    --wallet-muted: #33c18b;      /* hint text */
    --wallet-btn: #196ed2;        /* copy button */
    --wallet-btn-hover: #1558a3;  /* copy hover */
  }

  /* Force our colors over the inline styles */
  .wallet-widget{
    background: var(--wallet-bg) !important;
    border-color: var(--wallet-border) !important;
    color: var(--wallet-text) !important;
  }
  .wallet-widget *{
    color: var(--wallet-text) !important;
  }
  /* Make the last line (the note) slightly muted */
  .wallet-widget > div:last-child small{
    color: var(--wallet-muted) !important;
  }
  /* Address line keeps monospace but uses our color */
  .wallet-widget .wallet-address{
    color: var(--wallet-text) !important;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", monospace;
  }
  /* Copy button */
  .wallet-widget .copy-btn{
    background: var(--wallet-btn) !important;
    color: #fff !important;
  }
  .wallet-widget .copy-btn:hover{
    background: var(--wallet-btn-hover) !important;
  }
</style>
<style>
  :root{
    --wallet-gap: 20px; /* space between intro text and address row */
  }

  /* First line inside the widget (the intro sentence) */
  .wallet-widget > div:first-child{
    margin-bottom: var(--wallet-gap) !important;
    padding-bottom: 2px; /* optional tiny cushion */
  }
</style>
<style>
  /* Upload Box styling inside the injected credentials area */
 /* Upload Box styling inside the injected credentials/fields area */
#manual-credentials .file-box,
#manual-fields .file-box{
  border:2px dashed #33c18b;
  background:rgba(59,130,246,.06);
  border-radius:12px;
  padding:22px;
  text-align:center;
  position:relative;
  transition:background .2s, border-color .2s;
}
#manual-credentials .file-box:hover,
#manual-fields .file-box:hover{
  background:rgba(59,130,246,.10);
  border-color:#2563eb;
}
#manual-credentials .file-box input[type=file],
#manual-fields .file-box input[type=file]{
  position:absolute;
  inset:0;
  opacity:0;
  cursor:pointer;
}
#manual-credentials .file-box .label,
#manual-fields .file-box .label{ font-weight:600; margin-bottom:6px; }
#manual-credentials .file-box .hint,
#manual-fields .file-box .hint{ font-size:12px; color:#64748b; margin-top:2px; }
#manual-credentials .file-box .chosen,
#manual-fields .file-box .chosen{
  font-size:12px; color:#0f172a; margin-top:10px; display:none; word-break:break-all;
}

</style>
<style>
  /* Make the wallet address text smaller */
  .wallet-widget .wallet-address{
    font-size: 10px !important;   /* try 11px if you want it smaller */
    line-height: 1.25;
    letter-spacing: .2px;
  }
</style>
<style>
  /* Add vertical gap between address row and the text below */
  .wallet-widget > div:nth-of-type(2){
    margin-bottom: 35px !important;  /* space under the wallet row */
  }
</style>
<style>
.wallet-widget .qr-holder canvas,
.wallet-widget .qr-holder img{
  display:block;
  margin:0;
}
</style>

@endsection
