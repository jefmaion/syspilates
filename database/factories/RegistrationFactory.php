<?php

declare(strict_types = 1);

namespace Database\Factories;

use App\Models\Modality;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date     = fake()->dateTimeBetween('-1 months');
        $duration = fake()->randomElements([30, 60, 90, 120, 150, 180])[0];

        return [
            'student_id'     => Student::inRandomOrder()->first()->id,
            'modality_id'    => Modality::inRandomOrder()->first()->id,
            'duration'       => $duration,
            'class_per_week' => rand(1, 3),
            'value'          => fake()->randomFloat(2, 0, 500),
            'deadline'       => rand(1, 28),
            'start'          => $date,
            'end'            => Carbon::parse($date)->addDays($duration)->format('Y-m-d'),
            'status'         => 'active',
        ];
    }
}
