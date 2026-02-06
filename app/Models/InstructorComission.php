<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstructorComission extends BaseModel
{
    public $guarded = ['id'];

    /** @use HasFactory<\Database\Factories\InstructorComissionFactory> */
    use HasFactory;

    public $casts = [
        'datetime' => 'datetime'
    ];
}
