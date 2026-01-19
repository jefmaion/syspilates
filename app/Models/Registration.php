<?php

declare(strict_types=1);

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
        'start'  => 'date',
        'end'    => 'date',
        'status' => RegistrationStatusEnum::class,
        'duration' => PlanEnum::class,
        'value'  => 'float',
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

    protected function nextClass(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $dates = $this->classScheduled(now(), $this->end);
                return array_shift($dates)->data;
            }
        );
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

    public function getClasses($start = null, $end = null)
    {
        $start = $start ?? $this->start;
        $end   = $end ?? $this->end;

        $scheduled = $this->classScheduled($start, $end);

        foreach ($this->classes()->with('student.user')->whereBetween('date', [$start, $end])->get() as $class) {
            $date = $class->date->format('Y-m-d');

            if (isset($scheduled[$date])) {
                $scheduled[$date]->type = 'class';
                $scheduled[$date]->data = $class;

                continue;
            }
        }

        return $scheduled;
    }

    protected function plannedClasses(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {

                $schedules = $this->schedule()->with('instructor.user')->get();
                $period = CarbonPeriod::create($this->start, $this->end);
                $data = [];
                foreach ($period as $date) {
                    foreach ($schedules as $schedule) {
                        if ($date->dayOfWeek === $schedule->weekday->value) {
                            if (isset($classes[$date->format('Y-m-d')])) {
                                continue;
                            }

                            $data[$date->format('Y-m-d')] = (object) [
                                'type' => 'scheduled',
                                'data' => (object) [
                                    'registration_id' => $this->id,
                                    'instructor_id' => $schedule->instructor_id,
                                    'student_id' => $this->student_id,
                                    'date'       => $date,
                                    'time'       => $schedule->time,
                                    'datetime'   => $date->format('Y-m-d') . 'T' . $schedule->time,

                                ],
                            ];
                        }
                    }
                }

                return $data;
            }
        );
    }

    public function classScheduled($start = null, $end = null)
    {
        $start = $start ?? $this->start;
        $end   = $end ?? $this->end;

        $this->load('schedule.instructor.user');

        $scheduleds = [];

        $period = CarbonPeriod::create($start, $end);

        foreach ($period as $date) {
            foreach ($this->schedule as $schedule) {
                if ($date->dayOfWeek === $schedule->weekday->value) {
                    if (isset($classes[$date->format('Y-m-d')])) {
                        continue;
                    }

                    $scheduleds[$date->format('Y-m-d')] = (object) [
                        'type' => 'scheduled',
                        'data' => (object) [
                            'date'       => $date,
                            'time'       => $schedule->time,
                            'datetime'   => $date->format('Y-m-d') . 'T' . $schedule->time,
                            'instructor' => $schedule->instructor,
                        ],
                    ];
                }
            }
        }

        return $scheduleds;
    }

    public function isCanceled()
    {
        return $this->status->value === RegistrationStatusEnum::CANCELED->value;
    }

    public function getInstructorByWeekday($weekday)
    {
        return $this->schedule()->with('instructor.user')->where('weekday', $weekday)->first();
    }

    public function scheduledClasses($start = null, $end = null)
    {
        $this->load('schedule.instructor.user');

        $start = $start ?? $this->start;
        $end   = $end ?? $this->end;

        $period = CarbonPeriod::create($start, $end);

        $classes = [];

        foreach ($period as $date) {
            foreach ($this->schedule as $schedule) {
                if ($date->dayOfWeek === $schedule->weekday->value && $date->between($start, $end) && $date->dayOfWeek <> 0) {
                    $classes[] = [
                        'date'       => $date->format('Y-m-d'),
                        'time'       => $schedule->time,
                        'datetime'   => $date->format('Y-m-d') . 'T' . $schedule->time,
                        'instructor' => $schedule->instructor,
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
