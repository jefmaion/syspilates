<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{

    protected $connection = 'landlord';

    public $guarded = ['id'];

    /** @use HasFactory<\Database\Factories\Admin\TenantFactory> */
    use HasFactory;
}
