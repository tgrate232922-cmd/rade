<?php

namespace App\Http\Controllers\Frontend;

use App\Enums\TxnStatus;
use App\Enums\TxnType;
use App\Models\DepositMethod;
use App\Models\Transaction;
use App\Traits\ImageUpload;
use App\Traits\NotifyTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Txn;
use Validator;

class DepositController extends GatewayController
{
    use ImageUpload, NotifyTrait;

    public function deposit()
    {
        if (!setting('user_deposit', 'permission') || !\Auth::user()->deposit_status) {
            abort('403', 'Deposit Disable Now');
        }

        $isStepOne = 'current';
        $isStepTwo = '';
        $gateways = DepositMethod::where('status', 1)->get();

        return view('frontend::deposit.now', compact('isStepOne', 'isStepTwo', 'gateways'));
    }

    public function depositNow(Request $request)
    {
        if (!setting('user_deposit', 'permission') || !\Auth::user()->deposit_status) {
            abort('403', 'Deposit Disable Now');
        }

        $validator = Validator::make($request->all(), [
            'gateway_code' => 'required',
            'amount' => ['required', 'regex:/^[0-9]+(\.[0-9][0-9]?)?$/'],
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');
            return redirect()->back();
        }

        $input = $request->all();

        $gatewayInfo = DepositMethod::code($input['gateway_code'])->first();
        $amount = $input['amount'];

        if ($amount < $gatewayInfo->minimum_deposit || $amount > $gatewayInfo->maximum_deposit) {
            $currencySymbol = setting('currency_symbol', 'global');
            $message = 'Please Deposit the Amount within the range ' . $currencySymbol . $gatewayInfo->minimum_deposit . ' to ' . $currencySymbol . $gatewayInfo->maximum_deposit;
            notify()->error($message, 'Error');
            return redirect()->back();
        }

        $charge = $gatewayInfo->charge_type == 'percentage'
            ? (($gatewayInfo->charge / 100) * $amount)
            : $gatewayInfo->charge;

        $finalAmount = (float)$amount + (float)$charge;
        $payAmount = $finalAmount * $gatewayInfo->rate;
        $depositType = TxnType::Deposit;

        if (isset($input['manual_data'])) {
            $depositType = TxnType::ManualDeposit;
            $manualData = $input['manual_data'];

            foreach ($manualData as $key => $value) {
                // save uploaded files
                if ($value instanceof \Illuminate\Http\UploadedFile) {
                    $manualData[$key] = self::imageUploadTrait($value);
                }
            }
        }

        $txnInfo = Txn::new(
            $input['amount'],
            $charge,
            $finalAmount,
            $gatewayInfo->gateway_code,
            'Deposit With ' . $gatewayInfo->name,
            $depositType,
            TxnStatus::Pending,
            $gatewayInfo->currency,
            $payAmount,
            auth()->id(),
            null,
            'User',
            $manualData ?? []
        );

        return self::depositAutoGateway($gatewayInfo->gateway_code, $txnInfo);
    }

    public function depositLog()
    {
        $deposits = Transaction::search(request('query'), function ($query) {
            $query->where('user_id', auth()->user()->id)
                ->when(request('date'), function ($query) {
                    $query->whereDay('created_at', '=', Carbon::parse(request('date'))->format('d'));
                })
                ->whereIn('type', [TxnType::Deposit, TxnType::ManualDeposit]);
        })->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('frontend::deposit.log', compact('deposits'));
    }

   public function gatewayInfo($code)
{
    if (!setting('user_deposit', 'permission') || !\Auth::user()->deposit_status) {
        abort(403, 'Deposit Disable Now');
    }

    $method = \App\Models\DepositMethod::where('gateway_code', $code)
        ->where('status', 1)->firstOrFail();

    // Human label like "Bitcoin" / "Ethereum"
    $label = $method->name
        ?: (isset($method->currency) ? strtoupper($method->currency) : ($method->gateway_code ?? 'Wallet'));

    // A) Wallet widget HTML saved in admin (patch sentence to include asset name)
    $detailsHtmlRaw = $method->payment_details ?? '';
    if ($detailsHtmlRaw) {
        if (
            stripos($detailsHtmlRaw, 'wallet address below') !== false &&
            stripos($detailsHtmlRaw, 'using the '.$label.' wallet address below') === false
        ) {
            $detailsHtmlRaw = preg_replace(
                '/using the\s+(?:<[^>]*>\s*)*wallet address below/i',
                'using the ' . e($label) . ' wallet address below',
                $detailsHtmlRaw,
                1
            );
        }
    }

    // B) Try partial for extra fields, then strip any wallet fragments
    $viewName = view()->exists('frontend::deposit.partials.manual_credentials')
        ? 'frontend::deposit.partials.manual_credentials'
        : (view()->exists('frontend.deposit.partials.manual_credentials')
            ? 'frontend.deposit.partials.manual_credentials'
            : null);
    $fieldsHtml = $viewName ? view($viewName, compact('method'))->render() : '';

    $stripWalletFragments = function (string $html): string {
        $html = preg_replace('/<!--\s*WALLET_WIDGET_START\s*-->[\s\S]*?<!--\s*WALLET_WIDGET_END\s*-->/i', '', $html);
        $html = preg_replace('/<div[^>]*class="[^"]*\bwallet-widget\b[^"]*"[^>]*>[\s\S]*?<\/div>/i', '', $html);
        $html = preg_replace('/<span[^>]*class="[^"]*\bwallet-address\b[^"]*"[^>]*>[\s\S]*?<\/span>/i', '', $html);
        $html = preg_replace('/<button[^>]*class="[^"]*\bcopy-btn\b[^"]*"[^>]*>[\s\S]*?<\/button>/i', '', $html);
        $html = preg_replace('/<[^>]*>\s*(?:After sending,)?\s*upload your payment proof[^<]*<\/[^>]*>/i', '', $html);
        return $html;
    };
    $fieldsHtml = $stripWalletFragments($fieldsHtml);

    // C) ALWAYS build inputs from field_options (ensures file upload shows)
    $built = '';
    $options = $method->field_options ? json_decode($method->field_options, true) : [];

    if (is_array($options) && count($options)) {
        foreach ($options as $idx => $opt) {
            $fname   = $opt['name'] ?? ('field_'.$idx);
            $ftype   = strtolower($opt['type'] ?? 'text'); // 'text' | 'textarea' | 'file'
            $fval    = $opt['validation'] ?? 'nullable';
            $reqAttr = ($fval === 'required') ? 'required' : '';
            $safeKey = preg_replace('/[^a-zA-Z0-9_\-]/', '_', strtolower($fname));

            if ($ftype === 'file') {
                $built .= '
<div class="col-12">
  <div class="site-input-groups">
    <label class="box-input-label">'.e($fname).'</label>
    <input type="file" name="manual_data['.$safeKey.']" class="form-control" '.$reqAttr.' />
  </div>
</div>';
            } elseif ($ftype === 'textarea') {
                $built .= '
<div class="col-12">
  <div class="site-input-groups">
    <label class="box-input-label">'.e($fname).'</label>
    <textarea name="manual_data['.$safeKey.']" class="form-control" rows="3" '.$reqAttr.'></textarea>
  </div>
</div>';
            } else { // text
                $built .= '
<div class="col-12">
  <div class="site-input-groups">
    <label class="box-input-label">'.e($fname).'</label>
    <input type="text" name="manual_data['.$safeKey.']" class="form-control" '.$reqAttr.' />
  </div>
</div>';
            }
        }
    }

    // D) Final HTML: single wallet widget + fields from partial + fields from options
    $credentialsHtml = '';
    if ($detailsHtmlRaw) {
        $credentialsHtml .= '<div class="col-12">'.$detailsHtmlRaw.'</div>';
    }
    if ($fieldsHtml) {
        $credentialsHtml .= $fieldsHtml;
    }
    if ($built) {
        $credentialsHtml .= $built;
    }

    return response()->json([
        'gateway_logo'     => asset($method->logo ?? optional($method->gateway)->logo),
        'name'             => $method->name,
        'currency'         => $method->currency,
        'gateway_code'     => $method->gateway_code,
        'charge'           => (float) $method->charge,
        'charge_type'      => $method->charge_type,
        'rate'             => (float) $method->rate,
        'minimum_deposit'  => (float) $method->minimum_deposit,
        'maximum_deposit'  => (float) $method->maximum_deposit,
        'credentials'      => $credentialsHtml,
    ]);
}


    
}
