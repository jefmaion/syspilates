<?php

declare(strict_types = 1);

namespace App\Actions;

use App\Models\Classes;
use App\Models\Registration;
use Carbon\CarbonPeriod;

class GenerateClasses
{
    public static function run(Registration $registration, Classes $classes = null)
    {
        $events = [];
        $period = CarbonPeriod::create($registration->start, $registration->end);

        foreach ($period as $date) {
            foreach ($registration->schedule as $schedule) {
                if ($date->dayOfWeek === $schedule->weekday->value) {
                    $key          = $date->format('Y-m-d') . '.' . $schedule->id;
                    $events[$key] = array_merge($schedule->toArray(), ['datetime' => $date->format('Y-m-d ' . $schedule->time)]);
                }
            }
        }

        if ($classes) {
            dd('classes');
        }

        dd($events);
    }

    private static function make()
    {
    }
}
