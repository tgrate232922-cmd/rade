<?php

namespace App\Support;

use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleInterval
{
    public const SCHEDULE_UNITS = ['instantly', 'seconds', 'minutes', 'hours', 'days', 'months'];

    public const PERIOD_UNITS = ['times', 'minutes', 'hours', 'days'];

    public static function toSeconds(int $time, string $unit = 'hours'): int
    {
        return match ($unit) {
            'instantly' => 0,
            'seconds' => $time,
            'minutes' => $time * 60,
            'hours' => $time * 3600,
            'days' => $time * 86400,
            'months' => $time * 2592000,
            default => $time * 3600,
        };
    }

    public static function fromSchedule(Schedule $schedule): int
    {
        return self::toSeconds((int) $schedule->time, $schedule->time_unit ?? 'hours');
    }

    public static function addInterval(Carbon $carbon, int $seconds): Carbon
    {
        if ($seconds <= 0) {
            return $carbon->copy();
        }

        return $carbon->copy()->addSeconds($seconds);
    }

    public static function scheduleLabel(int $time, string $unit): string
    {
        if ($unit === 'instantly') {
            return __('Instantly');
        }

        $labels = [
            'seconds' => [__('Second'), __('Seconds')],
            'minutes' => [__('Minute'), __('Minutes')],
            'hours' => [__('Hour'), __('Hours')],
            'days' => [__('Day'), __('Days')],
            'months' => [__('Month'), __('Months')],
        ];

        [$singular, $plural] = $labels[$unit] ?? $labels['hours'];

        return $time . ' ' . ($time === 1 ? $singular : $plural);
    }

    public static function periodLabel(int $count, string $unit = 'times'): string
    {
        if ($unit === 'times') {
            return $count . ' ' . ($count === 1 ? __('Time') : __('Times'));
        }

        $labels = [
            'minutes' => [__('Minute'), __('Minutes')],
            'hours' => [__('Hour'), __('Hours')],
            'days' => [__('Day'), __('Days')],
        ];

        [$singular, $plural] = $labels[$unit] ?? $labels['days'];

        return $count . ' ' . ($count === 1 ? $singular : $plural);
    }
}
