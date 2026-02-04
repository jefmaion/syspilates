<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends BaseModel
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    public $guarded = ['id'];
}
