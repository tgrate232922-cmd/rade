<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('copy_traders', function (Blueprint $table) {
            $table->unsignedInteger('display_users_copying')->default(0)->after('risk_level');
            $table->decimal('win_rate', 5, 2)->default(0)->after('display_users_copying');
        });
    }

    public function down(): void
    {
        Schema::table('copy_traders', function (Blueprint $table) {
            $table->dropColumn(['display_users_copying', 'win_rate']);
        });
    }
};
