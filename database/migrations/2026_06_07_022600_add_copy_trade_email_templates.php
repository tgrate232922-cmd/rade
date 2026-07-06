<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();
        $shortCodes = json_encode([
            '[[full_name]]',
            '[[trader_name]]',
            '[[amount]]',
            '[[daily_profit]]',
            '[[total_profit]]',
            '[[daily_profit_percentage]]',
            '[[duration]]',
            '[[start_date]]',
            '[[end_date]]',
            '[[txn]]',
            '[[site_title]]',
            '[[site_url]]',
        ]);

        $templates = [
            [
                'name' => 'Copy Trade Started',
                'code' => 'copy_trade_started',
                'for' => 'User',
                'subject' => 'Your copy trade with [[trader_name]] has started',
                'title' => 'Copy Trade Started',
                'salutation' => 'Hello [[full_name]],',
                'message_body' => 'Your copy trade with [[trader_name]] has been started successfully.<br><br>Amount copied: [[amount]]<br>Daily profit: [[daily_profit]] ([[daily_profit_percentage]]%)<br>Duration: [[duration]] days<br>Start date: [[start_date]]<br>End date: [[end_date]]<br>Transaction ID: [[txn]]',
                'bottom_title' => 'Track your copy trade',
                'bottom_body' => 'You can view active and completed copy trades from your account dashboard.',
            ],
            [
                'name' => 'Copy Trade Daily Profit',
                'code' => 'copy_trade_profit',
                'for' => 'User',
                'subject' => 'Copy trade profit credited from [[trader_name]]',
                'title' => 'Daily Copy Trade Profit Credited',
                'salutation' => 'Hello [[full_name]],',
                'message_body' => 'Your daily copy-trade profit from [[trader_name]] has been credited.<br><br>Profit credited: [[daily_profit]]<br>Total profit earned: [[total_profit]]<br>Transaction ID: [[txn]]',
                'bottom_title' => 'Profit added to your wallet',
                'bottom_body' => 'This profit has been added to your profit wallet.',
            ],
            [
                'name' => 'Copy Trade Completed',
                'code' => 'copy_trade_completed',
                'for' => 'User',
                'subject' => 'Your copy trade with [[trader_name]] has ended',
                'title' => 'Copy Trade Session Completed',
                'salutation' => 'Hello [[full_name]],',
                'message_body' => 'Your copy trade with [[trader_name]] has ended.<br><br>Amount copied: [[amount]]<br>Total profit earned: [[total_profit]]<br>Started: [[start_date]]<br>Ended: [[end_date]]<br>Transaction ID: [[txn]]',
                'bottom_title' => 'Session closed',
                'bottom_body' => 'You can view completed copy trades from your dashboard.',
            ],
        ];

        $columns = Schema::getColumnListing('email_templates');

        foreach ($templates as $template) {
            $data = array_intersect_key(array_merge([
                'banner' => null,
                'button_level' => 'View Copy Trades',
                'button_link' => '[[site_url]]/user/copy-trade/active',
                'footer_status' => 1,
                'footer_body' => 'Thank you for using [[site_title]].',
                'bottom_status' => 1,
                'short_codes' => $shortCodes,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ], $template), array_flip($columns));

            DB::table('email_templates')->updateOrInsert(
                ['code' => $template['code']],
                $data
            );
        }
    }

    public function down(): void
    {
        DB::table('email_templates')
            ->whereIn('code', ['copy_trade_started', 'copy_trade_profit', 'copy_trade_completed'])
            ->delete();
    }
};
