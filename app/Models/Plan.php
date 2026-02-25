<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends BaseModel
{
    public $guarded = ['id'];

    public $casts = [
        'value'    => 'float',
    ];

    /** @use HasFactory<\Database\Factories\PlanFactory> */
    use HasFactory;


    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
