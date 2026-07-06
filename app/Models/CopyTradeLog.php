<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopyTradeLog extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'amount' => 'decimal:2',
        'meta' => 'array',
    ];

    public function copyTrade()
    {
        return $this->belongsTo(UserCopyTrade::class, 'user_copy_trade_id')->withDefault();
    }

    public function trader()
    {
        return $this->belongsTo(CopyTrader::class, 'copy_trader_id')->withDefault([
            'name' => 'Deleted Trader',
            'risk_level' => 'medium',
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
