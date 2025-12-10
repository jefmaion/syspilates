<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modality extends BaseModel
{
    /** @use HasFactory<\Database\Factories\ModalityFactory> */
    use HasFactory;

    public $guarded = ['id'];
}
