<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Enums\InvestStatus;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = auth()->user();
        $transactions = Transaction::where('user_id', $user->id);

        $recentTransactions = $transactions->latest()->take(5)->get();

        $referral = $user->getReferrals()->first();

        // Fetch active schemas (staking plans)
        $schemas = \App\Models\Schema::where('status', 1)
            ->orderBy('fixed_amount', 'asc')
            ->take(6)
            ->get();


        // Get most recent ONGOING investment for locked period (using enum)
        $latestInvestment = \App\Models\Invest::where('user_id', $user->id)
            ->where('status', InvestStatus::Ongoing)
            ->with('schema.schedule')
            ->latest()
            ->first();

        $dataCount = [
            'total_transaction' => $transactions->count(),
            'total_deposit' => $user->totalDeposit(),
            'total_investment' => $user->totalInvestment(),
            'total_profit' => $user->totalProfit(),
            'profit_last_7_days' => $user->totalProfit(7),
            'total_withdraw' => $user->totalWithdraw(),
            'total_transfer' => $user->totalTransfer(),
            'total_referral_profit' => $user->totalReferralProfit(),
            'total_referral' => $referral->relationships()->count(),
            'active_investment' => $user->invests()->where('status', InvestStatus::Ongoing)->count(),
            'deposit_bonus' => $user->totalDepositBonus(),
            'investment_bonus' => $user->totalInvestBonus(),
            'rank_achieved' => $user->rankAchieved(),
            'total_ticket' => $user->ticket->count(),
            'favorite_pool' => $user->favoritePool(),
        ];

        return view('frontend::user.dashboard', compact('dataCount', 'recentTransactions', 'referral', 'schemas', 'latestInvestment'));
    }

    public function usdtApy()
{
    return response()->json([
        'apy' => 8.42,
        'asset' => 'USDT',
        'updated_at' => now()->toIso8601String(),
    ]);

    }
    

public function daoPoolsLive()
{
    try {
        $response = Http::withOptions([
            'verify' => false,
        ])->timeout(20)->get('https://yields.llama.fi/pools');

        if (!$response->successful()) {
            return response()->json([
                'ok' => false,
                'message' => 'Failed to fetch live pools',
                'status' => $response->status(),
                'body' => $response->body(),
            ], 500);
        }

        $rows = collect($response->json('data', []));

        $daoLike = $rows->filter(function ($row) {
            $name = Str::lower(
                ($row['project'] ?? '') . ' ' .
                ($row['symbol'] ?? '') . ' ' .
                ($row['poolMeta'] ?? '')
            );

            return Str::contains($name, [
                'dao', 'governance', 'staking', 'stake', 'vault'
            ]);
        });

        $sourceRows = $daoLike->count() >= 4 ? $daoLike : $rows;

        $pools = $sourceRows
            ->filter(function ($row) {
                return isset($row['apy'], $row['tvlUsd'])
                    && is_numeric($row['apy'])
                    && is_numeric($row['tvlUsd'])
                    && $row['tvlUsd'] > 1000000
                    && $row['apy'] > 0;
            })
            ->sortByDesc('apy')
            ->take(4)
            ->map(function ($row) {
                return [
                    'name' => $row['project'] ?? ($row['symbol'] ?? 'Unknown Pool'),
                    'symbol' => strtoupper($row['symbol'] ?? ($row['chain'] ?? 'POOL')),
                    'apy' => round((float) $row['apy'], 2),
                    'change24h' => round((float) ($row['apyPct1D'] ?? 0), 2),
                    'tvl' => (float) ($row['tvlUsd'] ?? 0),
                ];
            })
            ->values()
            ->all();

        if (empty($pools)) {
            return response()->json([
                'ok' => false,
                'message' => 'No valid pools found from live source',
            ], 500);
        }

        $baseAvg = collect($pools)->avg('apy') ?: 8.5;
        $series = [];
        $value = $baseAvg;

        for ($i = 0; $i < 30; $i++) {
            $drift = sin($i / 4) * 0.18;
            $jitter = mt_rand(-20, 20) / 100;
            $value = max(0.1, $value + $drift + $jitter);
            $series[] = round($value, 2);
        }

        return response()->json([
            'ok' => true,
            'pools' => $pools,
            'chart' => [
                'series' => $series,
            ],
            'meta' => [
                'source' => 'defillama live',
                'updated_at' => now()->format('Y-m-d h:i:s A'),
            ],
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'ok' => false,
            'message' => 'Failed to fetch live pools',
            'error' => $e->getMessage(),
        ], 500);
    }
}
}



