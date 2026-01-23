<?php

declare(strict_types = 1);

namespace App\Models;

use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends BaseModel
{
    /** @use HasFactory<\Database\Factories\ClassesFactory> */
    use HasFactory;

    public $guarded = ['id'];

    public $casts = [
        'datetime'           => 'datetime',
        'scheduled_datetime' => 'datetime',
        'status'             => ClassStatusEnum::class,
        'type'               => ClassTypesEnum::class,
    ];

    //     use Carbon\Carbon;

    // $data = Carbon::parse('2026-01-20 14:00:00'); // exemplo
    // $agora = Carbon::now();

    // // diferença em horas
    // if ($agora->diffInHours($data) >= 24 && $agora->greaterThan($data)) {
    //     echo "Já se passaram 24 horas!";
    // } else {
    //     echo "Ainda não se passaram 24 horas.";
    // }

    protected function canEdit(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return ! $this->created_at->lt(Carbon::now()->subHours(24));
            }
        );
    }

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function modality()
    {
        return $this->belongsTo(Modality::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function makeupClass()
    {
        return $this->belongsTo(ClassMakeup::class, 'id', 'origin_class_id');
    }

    public function originMakeupClass()
    {
        return $this->belongsTo(ClassMakeup::class, 'id', 'used_class_id');
    }
}
