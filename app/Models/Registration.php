<?php

declare(strict_types = 1);

namespace App\Models;

use App\Enums\ClassStatusEnum;
use App\Enums\RegistrationStatusEnum;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends BaseModel
{
    /** @use HasFactory<\Database\Factories\RegistrationFactory> */
    use HasFactory;

    public $guarded = ['id'];

    public $casts = [
        'start'  => 'date',
        'end'    => 'date',
        'status' => RegistrationStatusEnum::class,
        'value'  => 'float',
    ];

    public function isCanceled()
    {
        return $this->status->value === RegistrationStatusEnum::CANCELED->value;
    }

    public function preClasses()
    {
        $this->load('schedule.instructor.user');
        $period = CarbonPeriod::create($this->start, $this->end);

        $classes = [];

        foreach ($period as $date) {
            foreach ($this->schedule as $schedule) {
                if ($date->dayOfWeek === $schedule->weekday) {
                    $classes[] = [
                        'date'       => $date,
                        'time'       => $schedule->time,
                        'datetime'   => $date . 'T' . $schedule->time,
                        'instructor' => $schedule->instructor,
                        'status'     => ClassStatusEnum::SCHEDULED,
                        'type'       => 'schedule',
                    ];
                }
            }
        }

        return $classes;
    }

    public function schedule()
    {
        return $this->hasMany(RegistrationSchedules::class);
    }

    public function plan()
    {
        return $this->hasOne(RegistrationPlan::class)->where('status', 'active')->latest('start');
    }

    public function plans()
    {
        return $this->hasMany(RegistrationPlan::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function Modality(): BelongsTo
    {
        return $this->belongsTo(Modality::class);
    }
}
