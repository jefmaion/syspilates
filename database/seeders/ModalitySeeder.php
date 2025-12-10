<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\Modality;
use Illuminate\Database\Seeder;

class ModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Modality::create(['name' => 'Pilates', 'acronym' => 'PLT']);
    }
}
