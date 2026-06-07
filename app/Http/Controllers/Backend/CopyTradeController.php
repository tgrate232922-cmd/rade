<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CopyTrader;
use App\Models\User;
use App\Models\UserCopyTrade;
use App\Services\CopyTradeService;
use Carbon\Carbon;
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

    public function create()
    {
        $users = User::orderBy('first_name')->orderBy('last_name')->get();
        $traders = CopyTrader::orderBy('name')->get();
        $currency = setting('site_currency', 'global');
        $currencySymbol = setting('currency_symbol', 'global');

        return view('backend.copy_trade.create', compact('users', 'traders', 'currency', 'currencySymbol'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'copy_trader_id' => 'required|exists:copy_traders,id',
            'amount' => 'required|numeric|min:1',
            'wallet' => 'required|in:main,profit',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');
            return redirect()->back()->withInput();
        }

        $user = User::find($request->user_id);
        $trader = CopyTrader::find($request->copy_trader_id);
        $amount = (float) $request->amount;

        if ($amount < (float) $trader->min_amount || $amount > (float) $trader->max_amount) {
            notify()->error('Copy amount must be within the trader amount range.', 'Error');
            return redirect()->back()->withInput();
        }

        if ($request->wallet === 'main' && (float) $user->balance < $amount) {
            notify()->error('Selected user has insufficient main wallet balance.', 'Error');
            return redirect()->back()->withInput();
        }

        if ($request->wallet === 'profit' && (float) $user->profit_balance < $amount) {
            notify()->error('Selected user has insufficient profit wallet balance.', 'Error');
            return redirect()->back()->withInput();
        }

        $copyTrade = $this->copyTradeService->start($user, $trader, $amount, $request->wallet, 'admin');

        notify()->success('User copy trade created successfully.', 'Success');
        return redirect()->route('admin.copy-trades.edit', $copyTrade->id);
    }

    public function edit(UserCopyTrade $copyTrade)
    {
        $copyTrade->load(['user', 'trader']);
        $traders = CopyTrader::orderBy('name')->get();
        $currency = setting('site_currency', 'global');
        $currencySymbol = setting('currency_symbol', 'global');

        return view('backend.copy_trade.edit', compact('copyTrade', 'traders', 'currency', 'currencySymbol'));
    }

    public function update(Request $request, UserCopyTrade $copyTrade)
    {
        $validator = Validator::make($request->all(), [
            'copy_trader_id' => 'required|exists:copy_traders,id',
            'amount_copied' => 'required|numeric|min:1',
            'daily_profit_percentage' => 'required|numeric|min:0',
            'daily_profit_amount' => 'required|numeric|min:0',
            'total_profit_earned' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'periods_paid' => 'required|integer|min:0',
            'capital_return' => 'required|boolean',
            'status' => 'required|in:running,paused,completed,cancelled',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'next_profit_at' => 'nullable|date',
            'last_profit_at' => 'nullable|date',
            'completed_at' => 'nullable|date',
            'trader_display_users_copying' => 'required|integer|min:0',
            'trader_win_rate' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->errors()->first(), 'Error');
            return redirect()->back()->withInput();
        }

        $data = [
            'copy_trader_id' => $request->copy_trader_id,
            'amount_copied' => $request->amount_copied,
            'daily_profit_percentage' => $request->daily_profit_percentage,
            'daily_profit_amount' => $request->daily_profit_amount,
            'total_profit_earned' => $request->total_profit_earned,
            'duration_days' => $request->duration_days,
            'periods_paid' => $request->periods_paid,
            'capital_return' => $request->capital_return,
            'status' => $request->status,
            'start_date' => $this->dateOrNull($request->start_date),
            'end_date' => $this->dateOrNull($request->end_date),
            'next_profit_at' => $request->status === UserCopyTrade::STATUS_RUNNING ? $this->dateOrNull($request->next_profit_at) : null,
            'last_profit_at' => $this->dateOrNull($request->last_profit_at),
            'completed_at' => $request->status === UserCopyTrade::STATUS_COMPLETED
                ? ($this->dateOrNull($request->completed_at) ?: Carbon::now())
                : $this->dateOrNull($request->completed_at),
        ];

        CopyTrader::where('id', $request->copy_trader_id)->update([
            'display_users_copying' => $request->trader_display_users_copying,
            'win_rate' => $request->trader_win_rate,
        ]);

        $this->copyTradeService->updateFromAdmin($copyTrade, $data);

        notify()->success('User copy trade updated successfully.', 'Success');
        return redirect()->route('admin.copy-trades.edit', $copyTrade->id);
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

    private function dateOrNull(?string $value): ?Carbon
    {
        return $value ? Carbon::parse($value) : null;
    }
}
