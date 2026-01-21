<?php

declare(strict_types = 1);

namespace App\Models;

use App\Enums\PlanEnum;
use App\Enums\RegistrationStatusEnum;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends BaseModel
{
    /** @use HasFactory<\Database\Factories\RegistrationFactory> */
    use HasFactory;

    public $guarded = ['id'];

    public $casts = [
        'start'    => 'date',
        'end'      => 'date',
        'status'   => RegistrationStatusEnum::class,
        'duration' => PlanEnum::class,
        'value'    => 'float',
    ];

    public function scopeJustActives(Builder $query)
    {
        return $query->whereIn('status', ['scheduled', 'active']);
    }

    /**
     * @return Attribute<string, string>
     */
    protected function planDescription(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return $this->duration->label() . ' (' . $this->schedule()->count() . 'x)';
            }
        );
    }

    public function getScheduleClasses($start = null, $end = null)
    {
        $start = $start ?? $this->start;
        $end   = $end ?? $this->end;

        $period  = CarbonPeriod::create($start, $end);
        $classes = [];

        foreach ($period as $date) {
            if (! $date->between($start, $end)) {
                continue;
            }

            foreach ($this->schedule as $schedule) {
                if ($date->dayOfWeek === $schedule->weekday->value) {
                    $key           = $date->format('Y-m-d') . '.' . $schedule->id;
                    $classes[$key] = array_merge($schedule->toArray(), ['datetime' => $date->format('Y-m-d ' . $schedule->time)]);
                }
            }
        }

        return $classes;
    }

    public function scopeWithinRange(Builder $query, $start, $end): Builder
    {
        $start = Carbon::parse($start)->startOfDay();
        $end   = Carbon::parse($end)->endOfDay();

        return $query->where(function ($q) use ($start, $end) {
            $q->where('start', '<=', $end)->where(function ($qq) use ($start) {
                $qq->where('end', '>=', $start)->orWhereNull('end');
            });
        });
    }

    public function isCanceled()
    {
        return $this->status->value === RegistrationStatusEnum::CANCELED->value;
    }

    public function schedule()
    {
        return $this->hasMany(RegistrationSchedules::class);
    }

    public function classes()
    {
        return $this->hasMany(Classes::class)->with('instructor.user')->orderBy('created_at', 'desc');
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

    public function modality(): BelongsTo
    {
        return $this->belongsTo(Modality::class);
    }
}
