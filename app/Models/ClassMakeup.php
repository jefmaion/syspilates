<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassMakeup extends BaseModel
{
    public $guarded = ['id'];

    /** @use HasFactory<\Database\Factories\ClassMakeupFactory> */
    use HasFactory;

    public function origin() {
        return $this->belongsTo(Classes::class, "origin_class_id", "id");
    }
}
