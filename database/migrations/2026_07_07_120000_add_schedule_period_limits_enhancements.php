<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            if (!Schema::hasColumn('schedules', 'time_unit')) {
                $table->string('time_unit', 20)->default('hours')->after('time');
            }
        });

        Schema::table('schemas', function (Blueprint $table) {
            if (!Schema::hasColumn('schemas', 'period_unit')) {
                $table->string('period_unit', 20)->default('times')->after('number_of_period');
            }
        });

        Schema::table('invests', function (Blueprint $table) {
            if (!Schema::hasColumn('invests', 'period_seconds')) {
                $table->unsignedBigInteger('period_seconds')->nullable()->after('period_hours');
            }
            if (!Schema::hasColumn('invests', 'period_unit')) {
                $table->string('period_unit', 20)->nullable()->after('period_seconds');
            }
        });

        if (!Schema::hasTable('user_schema_limits')) {
            Schema::create('user_schema_limits', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->foreignId('schema_id')->constrained()->cascadeOnDelete();
                $table->unsignedInteger('max_subscriptions')->default(1);
                $table->timestamps();

                $table->unique(['user_id', 'schema_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('user_schema_limits');

        Schema::table('invests', function (Blueprint $table) {
            if (Schema::hasColumn('invests', 'period_unit')) {
                $table->dropColumn('period_unit');
            }
            if (Schema::hasColumn('invests', 'period_seconds')) {
                $table->dropColumn('period_seconds');
            }
        });

        Schema::table('schemas', function (Blueprint $table) {
            if (Schema::hasColumn('schemas', 'period_unit')) {
                $table->dropColumn('period_unit');
            }
        });

        Schema::table('schedules', function (Blueprint $table) {
            if (Schema::hasColumn('schedules', 'time_unit')) {
                $table->dropColumn('time_unit');
            }
        });
    }
};
