<?php

declare(strict_types = 1);

namespace Database\Factories;

use App\Models\Modality;
use App\Models\Student;
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
        return [
            'student_id'  => Student::inRandomOrder()->first()->id,
            'modality_id' => Modality::inRandomOrder()->first()->id,
            'status'      => fake()->randomElement(['A', 'C', 'F']),
        ];
    }
}
