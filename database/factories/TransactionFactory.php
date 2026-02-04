<?php

declare(strict_types = 1);

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $inicio = Carbon::create(now()->year, rand(1, 12), 1);
        $fim    = $inicio->copy()->endOfMonth();
        // gera uma data aleatória dentro do mês
        $date = fake()->dateTimeBetween($inicio, $fim)->format('Y-m-d');

        return [
            'student_id'     => rand(1, 50),
            'date'           => $date,
            'amount'         => fake()->randomFloat(2, 10, 1000),
            'paid_amount'    => fake()->randomFloat(2, 10, 1000),
            'type'           => fake()->randomElement(['D', 'C']),
            'payment_method' => fake()->randomElement(['pix', 'credit', 'debit']),
            'category_id'    => rand(1, 3),
            'description'    => fake()->sentence(),
        ];
    }
}
