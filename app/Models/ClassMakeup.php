<?php

declare(strict_types = 1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassMakeup extends BaseModel
{
    /** @use HasFactory<\Database\Factories\ClassMakeupFactory> */
    use HasFactory;

    public $guarded = ['id'];

    public $casts = [
        'expires_at' => 'datetime',
    ];

    public function daysToExpire(): Attribute
    {
        return Attribute::make(get: function ($value, $attributes) {
            return (int) Carbon::now()->diffInDays($this->expires_at, false);
        });
    }

    public function status(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                // dd($attributes);

                if ($value == 'active') {
                    $days = $this->daysToExpire;

                    if ($days <= 4) {
                        return 'next_to_expire';
                    }

                    if ($days <= 0 || ! is_null($this->used_at)) {
                        return 'expired';
                    }

                    return $value;
                }

                return $value;
            }
        );
    }

    public function origin()
    {
        return $this->belongsTo(Classes::class, "origin_class_id", "id");
    }

    public function makeup()
    {
        return $this->belongsTo(Classes::class, "used_class_id", "id");
    }
}
