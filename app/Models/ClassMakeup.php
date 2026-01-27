<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassMakeup extends BaseModel
{
    /** @use HasFactory<\Database\Factories\ClassMakeupFactory> */
    use HasFactory;

    public $guarded = ['id'];

    public $casts = [
        'expires_at' => 'datetime',
    ];

    public function origin()
    {
        return $this->belongsTo(Classes::class, "origin_class_id", "id");
    }

    public function makeup()
    {
        return $this->belongsTo(Classes::class, "used_class_id", "id");
    }
}
