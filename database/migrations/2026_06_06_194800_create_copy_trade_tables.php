<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('copy_traders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->decimal('daily_profit_percentage', 8, 2)->default(0);
            $table->decimal('min_amount', 18, 2)->default(0);
            $table->decimal('max_amount', 18, 2)->default(0);
            $table->unsignedInteger('duration_days')->default(1);
            $table->boolean('capital_return')->default(true);
            $table->boolean('status')->default(true);
            $table->boolean('approved')->default(false);
            $table->string('risk_level')->default('medium');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('user_copy_trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('copy_trader_id')->nullable()->constrained('copy_traders')->nullOnDelete();
            $table->foreignId('transaction_id')->nullable()->constrained('transactions')->nullOnDelete();
            $table->decimal('amount_copied', 18, 2);
            $table->decimal('daily_profit_percentage', 8, 2)->default(0);
            $table->decimal('daily_profit_amount', 18, 2)->default(0);
            $table->decimal('total_profit_earned', 18, 2)->default(0);
            $table->unsignedInteger('duration_days')->default(1);
            $table->unsignedInteger('periods_paid')->default(0);
            $table->boolean('capital_return')->default(true);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamp('next_profit_at')->nullable();
            $table->timestamp('last_profit_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('status')->default('running');
            $table->timestamps();

            $table->index(['status', 'next_profit_at']);
        });

        Schema::create('copy_trade_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_copy_trade_id')->nullable()->constrained('user_copy_trades')->cascadeOnDelete();
            $table->foreignId('copy_trader_id')->nullable()->constrained('copy_traders')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type');
            $table->decimal('amount', 18, 2)->nullable();
            $table->text('message')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('copy_trade_logs');
        Schema::dropIfExists('user_copy_trades');
        Schema::dropIfExists('copy_traders');
    }
};
