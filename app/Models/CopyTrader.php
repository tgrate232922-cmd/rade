<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyTrader extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'daily_profit_percentage' => 'decimal:2',
        'min_amount' => 'decimal:2',
        'max_amount' => 'decimal:2',
        'capital_return' => 'boolean',
        'status' => 'boolean',
        'approved' => 'boolean',
    ];

    public function copiedTrades()
    {
        return $this->hasMany(UserCopyTrade::class);
    }

    public function runningCopiedTrades()
    {
        return $this->hasMany(UserCopyTrade::class)->where('status', UserCopyTrade::STATUS_RUNNING);
    }

    public function logs()
    {
        return $this->hasMany(CopyTradeLog::class);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset($this->image) : asset('frontend/images/user.png');
    }
}
