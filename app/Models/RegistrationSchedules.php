<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationSchedules extends BaseModel
{
    /** @use HasFactory<\Database\Factories\RegistrationSchedulesFactory> */
    use HasFactory;

    public $guarded = ['id'];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
