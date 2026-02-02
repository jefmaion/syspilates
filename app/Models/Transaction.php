<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends BaseModel
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    public $guarded = ['id'];
}
