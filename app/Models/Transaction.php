<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use App\Enums\TransactionTypeEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Transaction extends BaseModel
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    public $guarded = ['id'];

    public $casts = [
        'date'           => 'date',
        'paid_at'        => 'date',
        'amount'         => 'decimal:2',
        'fine'           => 'decimal:2',
        'fee'            => 'decimal:2',
        'payment_method' => PaymentMethodEnum::class,
        'type'           => TransactionTypeEnum::class,
    ];

    /**
     * @return Attribute<string, string>
     */
    protected function fine(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                if ($this->daysLate > 0) {
                    return $this->amount * 0.02;
                }

                return 0;
            }
        );
    }

    /**
     * @return Attribute<string, string>
     */
    protected function daysLate(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                if (now()->greaterThan($this->date)) {
                    return (int) $this->date->diffInDays(now());
                }

                return 0;
            }
        );
    }

    /**
     * @return Attribute<string, string>
     */
    protected function fee(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                // Juros de 0,33% ao dia
                $daysLate = $this->daysLate;

                if ($daysLate <= 0) {
                    return 0;
                }

                return $this->amount * 0.0033 * $daysLate;
            }
        );
    }

    /**
     * @return Attribute<string, string>
     */
    protected function amountWithFee(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                // Juros de 0,33% ao dia
                return $this->amount + $this->fee + $this->fine;
            }
        );
    }

    /**
     * @return Attribute<string, string>
     */
    protected function isLate(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                // Juros de 0,33% ao dia
                return $this->daysLate > 0;
            }
        );
    }
    /**
     * @return Attribute<string, string>
     */
    protected function amount(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return brlToUsd($value);
            }
        );
    }

    /**
     * @return Attribute<string, string>
     */
    protected function currentStatus(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                $return = [];

                if ($this->payed) {
                    return (object) ['label' => 'Pago', 'color' => 'teal'];
                }

                if ($this->date->isToday()) {
                    return (object) ['label' => 'Vence Hoje', 'color' => 'warning'];
                }

                if ($this->date->isPast()) {
                    return (object) ['label' => 'Atrasado', 'color' => 'danger'];
                }

                if ($this->date->diffInDays(Carbon::today(), true) <= 3) {
                    return (object) ['label' => 'Vence em ' . $this->date->diffInDays(Carbon::today(), true) . ' dia(s)', 'color' => 'warning'];
                }

                return (object) ['label' => 'Agendado', 'color' => 'primary'];
            }
        );
    }

    public function scopeCurrent($q, $filter)
    {
        return match ($filter) {
            'open'  => $q->where('payed', false)->whereDate('date', '>', today()->addDays(3)),
            'payed' => $q->where('payed', true),
            'today' => $q->where('payed', false)->whereDate('date', today()),
            'soon'  => $q->where('payed', false)->whereBetween('date', [today()->addDay(), today()->addDays(3)]),
            'late'  => $q->where('payed', false)->whereDate('date', '<', today()),
            default => $q
        };

        return $q;
    }

    public static function getAmountBefore($date)
    {
        return self::where('payed', 1)->where('date', '<', Carbon::parse($date))->sum(DB::raw("CASE WHEN type = 'C' THEN amount ELSE -amount END"));
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
