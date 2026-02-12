<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
use App\Enums\PlanEnum;
use App\Enums\RegistrationComputedStatusEnum;
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
    protected function registrarionStatus(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                if ($this->status === RegistrationStatusEnum::CANCELED) {
                    return RegistrationStatusEnum::CANCELED;
                }

                if (! $this->end) {
                    return RegistrationStatusEnum::ACTIVE;
                }

                $days = now()->startOfDay()->diffInDays(Carbon::parse($this->end)->startOfDay(), false);

                if ($days < 0) {
                    return RegistrationComputedStatusEnum::EXPIRED;
                }

                if ($days <= 7) {
                    // return 'Vence em ' . $days . ' dias';
                    return RegistrationComputedStatusEnum::EXPIRING;
                }

                return RegistrationComputedStatusEnum::WORKING;
            }
        );
    }

    protected function daysToExpire(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return now()->startOfDay()->diffInDays(Carbon::parse($this->end)->startOfDay(), false);
            }
        );
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

    /**
     * @return Attribute<string, string>
     */
    protected function classPerWeek(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return $this->schedule()->count();
            }
        );
    }

    /**
     * @return Attribute<string, string>
     */
    protected function nextClass(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return $this->classes()->where('type', ClassTypesEnum::REGULAR)->where('status', ClassStatusEnum::SCHEDULED)->where('datetime', '>', now())->first();
            }
        );
    }

    /**
     * @return Attribute<string, string>
     */
    protected function nextTransaction(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return $this->transactions()->whereNull('paid_at')->where('date', '>', now())->first();
            }
        );
    }

    /**
     * @return Attribute<string, string>
     */
    protected function hasUnpaidTransactions(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return $this->transactions()->whereNull('paid_at')->where('date', '<', now())->count();
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
                    $key           = $date->format('Y-m-d ' . $schedule->time) . '.' . $schedule->id . '.' . $this->id;
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

    public function scopeCurrent($q, $filter)
    {
        return match ($filter) {
            'active'  => $q->where('status', RegistrationStatusEnum::ACTIVE)->whereDate('end', '>=', now()->startOfDay()),
            'canceled' => $q->where('status', RegistrationStatusEnum::CANCELED),
            'expired' => $q->where('status', RegistrationStatusEnum::ACTIVE)->whereDate('end', '<', now()->startOfDay()),
            'expiring'  => $q->where('status', RegistrationStatusEnum::ACTIVE)->whereBetween('end', [now()->startOfDay(), now()->endOfWeek()->startOfDay()]),

            'late'  => $q->whereHas('transactions', function ($t) {
                return $t->whereNull('paid_at')->where('date', '<', now());
            }),
            default => $q
        };

        return $q;
    }

    public function isCanceled()
    {
        return $this->status->value === RegistrationStatusEnum::CANCELED->value;
    }

    public function schedule()
    {
        return $this->hasMany(RegistrationSchedules::class)->orderBy('weekday');
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

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function makeups()
    {
        return $this->hasMany(ClassMakeup::class);
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
