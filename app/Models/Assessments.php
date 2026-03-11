<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assessments extends BaseModel
{
    public $guarded = ['id'];

    /** @use HasFactory<\Database\Factories\AssessmentsFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
