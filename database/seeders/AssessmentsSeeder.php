<?php

namespace Database\Seeders;

use App\Models\Assessments;
use Database\Factories\AssessmentsFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssessmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Assessments::factory(5)->create();
    }
}
