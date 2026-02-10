<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ClassStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExperimentalClass extends BaseModel
{
    /** @use HasFactory<\Database\Factories\ExperimentalClassFactory> */
    use HasFactory;

    public $guarded = ['id'];

    public $casts = [
        'datetime' => 'datetime',
        'status'   => ClassStatusEnum::class,
    ];

    /**
     * @return Attribute<string, string>
     */
    protected function value(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return brlToUsd($value);
            }
        );
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }
}
