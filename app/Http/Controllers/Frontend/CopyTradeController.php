<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CopyTrader;
use App\Models\UserCopyTrade;
use App\Services\CopyTradeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CopyTradeController extends Controller
{
    public function __construct(private CopyTradeService $copyTradeService)
    {
    }

    public function index()
    {
        $traders = CopyTrader::where('status', true)
            ->where('approved', true)
            ->withCount('runningCopiedTrades')
            ->latest()
            ->get();

        $activeTrades = UserCopyTrade::with('trader')
            ->where('user_id', Auth::id())
            ->where('status', UserCopyTrade::STATUS_RUNNING)
            ->latest()
            ->take(5)
            ->get();

        $completedTrades = UserCopyTrade::with('trader')
            ->where('user_id', Auth::id())
            ->where('status', UserCopyTrade::STATUS_COMPLETED)
            ->latest()
            ->take(5)
            ->get();

        $currency = setting('site_currency', 'global');
        $currencySymbol = setting('currency_symbol', 'global');

        return view('frontend::copy_trade.index', compact('traders', 'activeTrades', 'completedTrades', 'currency', 'currencySymbol'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'copy_trader_id' => 'required|exists:copy_traders,id',
            'amount' => 'required|numeric|min:1',
            'wallet' => 'required|in:main,profit',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');
            return redirect()->back()->withInput();
        }

        $user = Auth::user();
        $trader = CopyTrader::where('status', true)
            ->where('approved', true)
            ->find($request->copy_trader_id);

        if (! $trader) {
            notify()->error('This copy trader is not available right now.', 'Error');
            return redirect()->back();
        }

        $amount = (float) $request->amount;

        if ($amount < (float) $trader->min_amount || $amount > (float) $trader->max_amount) {
            notify()->error('Copy amount must be within the trader amount range.', 'Error');
            return redirect()->back()->withInput();
        }

        if ($request->wallet === 'main' && (float) $user->balance < $amount) {
            notify()->error('Insufficient balance in your main wallet.', 'Error');
            return redirect()->back()->withInput();
        }

        if ($request->wallet === 'profit' && (float) $user->profit_balance < $amount) {
            notify()->error('Insufficient balance in your profit wallet.', 'Error');
            return redirect()->back()->withInput();
        }

        $this->copyTradeService->start($user, $trader, $amount, $request->wallet);

        notify()->success('Copy trade started successfully.', 'Success');
        return redirect()->route('user.copy-trade.active');
    }

    public function active()
    {
        return $this->logs(UserCopyTrade::STATUS_RUNNING);
    }

    public function completed()
    {
        return $this->logs(UserCopyTrade::STATUS_COMPLETED);
    }

    private function logs(string $status)
    {
        $trades = UserCopyTrade::with(['trader', 'logs' => fn ($query) => $query->latest()->take(5)])
            ->where('user_id', Auth::id())
            ->where('status', $status)
            ->latest()
            ->paginate(15);

        $currency = setting('site_currency', 'global');
        $currencySymbol = setting('currency_symbol', 'global');

        return view('frontend::copy_trade.log', compact('trades', 'status', 'currency', 'currencySymbol'));
    }
}
