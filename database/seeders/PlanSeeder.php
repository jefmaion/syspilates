<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $plans = [
            'Mensal' => 30,
            // 'Bimestral' => 60,
            'Trimestral' => 90,
            // 'Quadrimestral' => 120,
            // 'Semestral' => 180,
            // 'Anual' => 365
        ];

        foreach ($plans as $name => $duration) {
            for ($i = 1; $i <= 3; $i++) {
                Plan::create([
                    'name' => $name . ' (' . $i . 'x)',
                    'duration' => $duration,
                    'classes_per_week' => $i,
                    'value' => fake()->randomFloat(2, 100, 500)
                ]);
            }
        }
    }
}
