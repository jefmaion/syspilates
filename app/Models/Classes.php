<?php

declare(strict_types = 1);

namespace App\Models;

use App\Enums\ClassStatusEnum;
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
