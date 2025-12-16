<?php

declare(strict_types = 1);

namespace App\Models;

use App\Enums\RegistrationStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Registration extends BaseModel
{
    /** @use HasFactory<\Database\Factories\RegistrationFactory> */
    use HasFactory;

    public $guarded = ['id'];

    public $casts = [
        'status' => RegistrationStatusEnum::class,
    ];

    public function schedule()
    {
        return $this->hasMany(RegistrationSchedules::class);
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

    public function Modality(): BelongsTo
    {
        return $this->belongsTo(Modality::class);
    }
}
