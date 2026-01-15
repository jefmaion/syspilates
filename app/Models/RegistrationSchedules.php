<?php

declare(strict_types = 1);

namespace App\Models;

use App\Enums\WeekdaysEnum;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationSchedules extends BaseModel
{
    /** @use HasFactory<\Database\Factories\RegistrationSchedulesFactory> */
    use HasFactory;

    public $guarded = ['id'];

    public $casts = [
        'weekday' => WeekdaysEnum::class,
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function dates($start = null, $end = null)
    {
        $start = Carbon::parse($start) ?? $this->registration->start;
        $end   = Carbon::parse($end) ?? $this->registration->end;

        $period = CarbonPeriod::create($start, $end);

        $classes = [];

        foreach ($period as $date) {
            if (($date->dayOfWeek === $this->weekday) && $date->between($start, $end) && $date->between($this->registration->start, $this->registration->end)) {
                $classes[] = $date->format('Y-m-d') . 'T' . $this->time;
            }
        }

        return $classes;
    }
}
