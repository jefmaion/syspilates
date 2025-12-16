<?php

declare(strict_types = 1);

namespace Database\Factories;

use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegistrationPlan>
 */
class RegistrationPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date     = fake()->date();
        $duration = fake()->randomElements([30, 60, 90, 120, 150, 180])[0];

        return [
            'registration_id' => Registration::inRandomOrder()->first()->id,
            'duration'        => $duration,
            'class_per_week'  => rand(1, 3),
            'value'           => fake()->randomFloat(2, 0, 500),
            'deadline'        => rand(1, 28),
            'start'           => $date,
            'end'             => Carbon::parse($date)->addDays($duration)->format('Y-m-d'),
            'status'          => 'active',
        ];
    }
}
