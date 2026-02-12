<?php

namespace App\Models;

use App\Enums\ComissionTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InstructorComission extends BaseModel
{
    public $guarded = ['id'];

    /** @use HasFactory<\Database\Factories\InstructorComissionFactory> */
    use HasFactory;

    public $casts = [
        'datetime' => 'datetime',
        'comission_type' => ComissionTypeEnum::class
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
