<?php

namespace App\Services;

use App\Enums\TxnStatus;
use App\Enums\TxnType;
use App\Models\CopyTradeLog;
use App\Models\CopyTrader;
use App\Models\User;
use App\Models\UserCopyTrade;
use App\Traits\NotifyTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Txn;

class CopyTradeService
{
    use NotifyTrait;

    public function start(User $user, CopyTrader $trader, float $amount, string $wallet, string $actor = 'user'): UserCopyTrade
    {
        return DB::transaction(function () use ($user, $trader, $amount, $wallet, $actor) {
            if ($wallet === 'main') {
                $user->decrement('balance', $amount);
            } else {
                $user->decrement('profit_balance', $amount);
            }

            $dailyProfit = round(($amount * (float) $trader->daily_profit_percentage) / 100, 2);
            $startDate = Carbon::now();
            $endDate = (clone $startDate)->addDays((int) $trader->duration_days);

            $transaction = Txn::new(
                $amount,
                0,
                $amount,
                'system',
                $trader->name . ' Copy Trade Started',
                TxnType::Investment,
                TxnStatus::Success,
                null,
                null,
                $user->id
            );

            $copyTrade = UserCopyTrade::create([
                'user_id' => $user->id,
                'copy_trader_id' => $trader->id,
                'transaction_id' => $transaction->id,
                'amount_copied' => $amount,
                'daily_profit_percentage' => $trader->daily_profit_percentage,
                'daily_profit_amount' => $dailyProfit,
                'total_profit_earned' => 0,
                'duration_days' => $trader->duration_days,
                'periods_paid' => 0,
                'capital_return' => $trader->capital_return,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'next_profit_at' => (clone $startDate)->addDay(),
                'status' => UserCopyTrade::STATUS_RUNNING,
            ]);

            $this->log($copyTrade, 'opened', $amount, ucfirst($actor) . ' started copying ' . $trader->name, [
                'wallet' => $wallet,
                'daily_profit_percentage' => $trader->daily_profit_percentage,
            ]);

            $this->mailNotify($user->email, 'copy_trade_started', $this->shortcodes($copyTrade, [
                '[[txn]]' => $transaction->tnx,
            ]));

            return $copyTrade;
        });
    }

    public function updateFromAdmin(UserCopyTrade $copyTrade, array $data): void
    {
        DB::transaction(function () use ($copyTrade, $data) {
            $copyTrade->update($data);
            $copyTrade->refresh();

            $this->log($copyTrade, 'admin_edit', null, 'Admin updated copied trade settings', [
                'fields' => array_keys($data),
            ]);
        });
    }

    public function accrueDueProfit(UserCopyTrade $copyTrade): void
    {
        DB::transaction(function () use ($copyTrade) {
            $copyTrade->refresh();

            if ($copyTrade->status !== UserCopyTrade::STATUS_RUNNING || ! $copyTrade->next_profit_at) {
                return;
            }

            if (! $copyTrade->trader->status || ! $copyTrade->trader->approved) {
                return;
            }

            while (
                $copyTrade->status === UserCopyTrade::STATUS_RUNNING &&
                $copyTrade->next_profit_at &&
                $copyTrade->next_profit_at->lte(Carbon::now())
            ) {
                $this->creditDailyProfit($copyTrade);

                if ($copyTrade->periods_paid >= $copyTrade->duration_days) {
                    $this->complete($copyTrade, 'system');
                    break;
                }

                $copyTrade->update([
                    'next_profit_at' => $copyTrade->next_profit_at->copy()->addDay(),
                ]);

                $copyTrade->refresh();
            }
        });
    }

    public function pause(UserCopyTrade $copyTrade, string $actor = 'admin'): void
    {
        $copyTrade->update(['status' => UserCopyTrade::STATUS_PAUSED]);
        $this->log($copyTrade, 'paused', null, ucfirst($actor) . ' paused this copied trade');
    }

    public function resume(UserCopyTrade $copyTrade, string $actor = 'admin'): void
    {
        $copyTrade->update([
            'status' => UserCopyTrade::STATUS_RUNNING,
            'next_profit_at' => Carbon::now()->addDay(),
        ]);

        $this->log($copyTrade, 'opened', null, ucfirst($actor) . ' reopened this copied trade');
    }

    public function complete(UserCopyTrade $copyTrade, string $actor = 'admin'): void
    {
        $copyTrade->refresh();

        if ($copyTrade->status === UserCopyTrade::STATUS_COMPLETED) {
            return;
        }

        $copyTrade->update([
            'status' => UserCopyTrade::STATUS_COMPLETED,
            'next_profit_at' => null,
            'completed_at' => Carbon::now(),
        ]);

        $transaction = null;

        if ($copyTrade->capital_return) {
            $copyTrade->user->increment('balance', $copyTrade->amount_copied);

            $transaction = Txn::new(
                $copyTrade->amount_copied,
                0,
                $copyTrade->amount_copied,
                'system',
                $copyTrade->trader->name . ' Copy Trade Capital Return',
                TxnType::Refund,
                TxnStatus::Success,
                null,
                null,
                $copyTrade->user_id
            );
        }

        $this->log($copyTrade, 'closed', null, ucfirst($actor) . ' completed this copied trade', [
            'capital_return' => $copyTrade->capital_return,
        ]);

        $this->mailNotify($copyTrade->user->email, 'copy_trade_completed', $this->shortcodes($copyTrade, [
            '[[txn]]' => $transaction?->tnx ?? 'N/A',
        ]));
    }

    public function adjust(UserCopyTrade $copyTrade, float $amount, string $message = null): void
    {
        DB::transaction(function () use ($copyTrade, $amount, $message) {
            $copyTrade->refresh();
            $user = $copyTrade->user;
            $description = $message ?: 'Copy trade profit/loss adjustment';

            if ($amount > 0) {
                $user->increment('profit_balance', $amount);
                $copyTrade->increment('total_profit_earned', $amount);

                Txn::new($amount, 0, $amount, 'system', $description, TxnType::Interest, TxnStatus::Success, null, null, $user->id);
                $this->log($copyTrade, 'profit_adjustment', $amount, $description);

                return;
            }

            $loss = abs($amount);
            $deducted = min($loss, (float) $user->profit_balance);
            if ($deducted > 0) {
                $user->decrement('profit_balance', $deducted);
            }

            $copyTrade->update([
                'total_profit_earned' => max(0, (float) $copyTrade->total_profit_earned - $loss),
            ]);

            Txn::new($loss, 0, $loss, 'system', $description, TxnType::Subtract, TxnStatus::Success, null, null, $user->id);
            $this->log($copyTrade, 'loss_adjustment', $amount, $description, ['deducted_from_profit_wallet' => $deducted]);
        });
    }

    private function creditDailyProfit(UserCopyTrade $copyTrade): void
    {
        $amount = (float) $copyTrade->daily_profit_amount;

        $copyTrade->user->increment('profit_balance', $amount);
        $copyTrade->increment('total_profit_earned', $amount);
        $copyTrade->increment('periods_paid');
        $copyTrade->update(['last_profit_at' => Carbon::now()]);

        $transaction = Txn::new(
            $amount,
            0,
            $amount,
            'system',
            $copyTrade->trader->name . ' Copy Trade Daily Profit',
            TxnType::Interest,
            TxnStatus::Success,
            null,
            null,
            $copyTrade->user_id
        );

        $this->log($copyTrade, 'daily_profit', $amount, 'Daily copy-trade profit credited');
        $copyTrade->refresh();

        $this->mailNotify($copyTrade->user->email, 'copy_trade_profit', $this->shortcodes($copyTrade, [
            '[[txn]]' => $transaction->tnx,
        ]));
    }

    private function log(UserCopyTrade $copyTrade, string $type, ?float $amount, ?string $message, array $meta = []): void
    {
        CopyTradeLog::create([
            'user_copy_trade_id' => $copyTrade->id,
            'copy_trader_id' => $copyTrade->copy_trader_id,
            'user_id' => $copyTrade->user_id,
            'type' => $type,
            'amount' => $amount,
            'message' => $message,
            'meta' => $meta ?: null,
        ]);
    }

    private function shortcodes(UserCopyTrade $copyTrade, array $extra = []): array
    {
        $currency = setting('site_currency', 'global');

        return array_merge([
            '[[full_name]]' => $copyTrade->user->full_name,
            '[[trader_name]]' => $copyTrade->trader->name,
            '[[amount]]' => $copyTrade->amount_copied . ' ' . $currency,
            '[[daily_profit]]' => $copyTrade->daily_profit_amount . ' ' . $currency,
            '[[total_profit]]' => $copyTrade->total_profit_earned . ' ' . $currency,
            '[[daily_profit_percentage]]' => $copyTrade->daily_profit_percentage,
            '[[duration]]' => $copyTrade->duration_days,
            '[[start_date]]' => $copyTrade->start_date?->format('M d, Y H:i') ?? '-',
            '[[end_date]]' => $copyTrade->end_date?->format('M d, Y H:i') ?? '-',
            '[[txn]]' => 'N/A',
            '[[site_title]]' => setting('site_title', 'global'),
            '[[site_url]]' => route('home'),
        ], $extra);
    }
}
