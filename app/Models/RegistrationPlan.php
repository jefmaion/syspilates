<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationPlan extends BaseModel
{
    /** @use HasFactory<\Database\Factories\RegistrationPlanFactory> */
    use HasFactory;

    public $guarded = ['id'];

    public $casts = [
        'start' => 'date',
        'end'   => 'date',
        'value' => 'float',
    ];
}
