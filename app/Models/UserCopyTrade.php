<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCopyTrade extends Model
{
    use HasFactory;

    public const STATUS_RUNNING = 'running';
    public const STATUS_PAUSED = 'paused';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    protected $guarded = ['id'];

    protected $casts = [
        'amount_copied' => 'decimal:2',
        'daily_profit_percentage' => 'decimal:2',
        'daily_profit_amount' => 'decimal:2',
        'total_profit_earned' => 'decimal:2',
        'capital_return' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'next_profit_at' => 'datetime',
        'last_profit_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function trader()
    {
        return $this->belongsTo(CopyTrader::class, 'copy_trader_id')->withDefault([
            'name' => 'Deleted Trader',
            'risk_level' => 'medium',
        ]);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class)->withDefault();
    }

    public function logs()
    {
        return $this->hasMany(CopyTradeLog::class);
    }

    public function getStartedAtAttribute(): string
    {
        return $this->start_date ? $this->start_date->format('M d, Y H:i') : '-';
    }

    public function getEndsAtAttribute(): string
    {
        return $this->end_date ? $this->end_date->format('M d, Y H:i') : '-';
    }

    public function getNextProfitTimeAttribute(): string
    {
        return $this->next_profit_at ? $this->next_profit_at->format('M d, Y H:i') : '-';
    }

    public function scopeDueForProfit($query)
    {
        return $query->where('status', self::STATUS_RUNNING)
            ->whereNotNull('next_profit_at')
            ->where('next_profit_at', '<=', Carbon::now());
    }
}
