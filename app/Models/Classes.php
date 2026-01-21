<?php

declare(strict_types = 1);

namespace App\Models;

use App\Enums\ClassStatusEnum;
use App\Enums\ClassTypesEnum;
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
        'type'=> ClassTypesEnum::class
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
