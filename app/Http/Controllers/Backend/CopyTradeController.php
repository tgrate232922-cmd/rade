<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CopyTrader;
use App\Models\UserCopyTrade;
use App\Services\CopyTradeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CopyTradeController extends Controller
{
    public function __construct(private CopyTradeService $copyTradeService)
    {
    }

    public function index(Request $request, $id = null)
    {
        $selectedTrader = $id ? CopyTrader::find($id) : null;
        $query = UserCopyTrade::with(['user', 'trader', 'logs' => fn ($logQuery) => $logQuery->latest()->take(5)])->latest();

        if ($selectedTrader) {
            $query->where('copy_trader_id', $selectedTrader->id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $copyTrades = $query->paginate(20)->withQueryString();
        $traders = CopyTrader::orderBy('name')->get();
        $currency = setting('site_currency', 'global');
        $currencySymbol = setting('currency_symbol', 'global');

        return view('backend.copy_trade.index', compact('copyTrades', 'traders', 'selectedTrader', 'currency', 'currencySymbol'));
    }

    public function pause(UserCopyTrade $copyTrade)
    {
        if ($copyTrade->status !== UserCopyTrade::STATUS_RUNNING) {
            notify()->warning('Only running copied trades can be paused.', 'Warning');
            return redirect()->back();
        }

        $this->copyTradeService->pause($copyTrade);

        notify()->success('Copied trade paused successfully.', 'Success');
        return redirect()->back();
    }

    public function resume(UserCopyTrade $copyTrade)
    {
        if ($copyTrade->status !== UserCopyTrade::STATUS_PAUSED) {
            notify()->warning('Only paused copied trades can be reopened.', 'Warning');
            return redirect()->back();
        }

        $this->copyTradeService->resume($copyTrade);

        notify()->success('Copied trade reopened successfully.', 'Success');
        return redirect()->back();
    }

    public function complete(UserCopyTrade $copyTrade)
    {
        $this->copyTradeService->complete($copyTrade);

        notify()->success('Copied trade completed successfully.', 'Success');
        return redirect()->back();
    }

    public function adjust(Request $request, UserCopyTrade $copyTrade)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|not_in:0',
            'message' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');
            return redirect()->back();
        }

        $this->copyTradeService->adjust($copyTrade, (float) $request->amount, $request->message);

        notify()->success('Copied trade adjustment saved successfully.', 'Success');
        return redirect()->back();
    }
}
