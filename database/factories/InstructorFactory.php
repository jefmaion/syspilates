<?php

declare(strict_types = 1);

namespace Database\Factories;

use App\Models\Modality;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'    => User::factory()->create()->id,
            'profession' => fake()->randomElements(['Fisioterapeuta', 'Educador(a) Físico', 'Osteopata'])[0],
            'document'   => fake()->randomElements(['CRM', 'CRO', 'CREFITO'])[0] . '-' . fake()->numberBetween(100000, 999999),
            'comments'   => fake()->sentence(20),
        ];
    }

    public function withModalities(int $count = 3)
    {
        return $this->afterCreating(function ($instructor) use ($count) {
            // cria entre 1 e 3 modalidades

            // foreach ($modalities as $modality) {
            for ($i = 1;$i <= $count;$i++) {
                $instructor->modalities()->attach(Modality::inRandomOrder()->first()->id, [
                    'commission_type'                => fake()->randomElement(['percent', 'fixed']),
                    'commission_value'               => fake()->randomFloat(2, 5, 50),
                    'calculate_on_justified_absence' => fake()->boolean(),
                ]);
            }
        });
    }
}
