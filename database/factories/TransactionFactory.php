<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\TransactionTypeEnum;
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
        $inicio = Carbon::create('2026-01-01');
        $fim    = now()->endOfMonth();
        $date = fake()->dateTimeBetween($inicio, $fim)->format('Y-m-d');

        $types = ['C', 'D'];
        $type = $types[rand(0, 1)];

        $amount = fake()->randomFloat(2, 10, 1000);

        return [
            'student_id'     => rand(1, 50),
            'date'           => $date,
            'origin_amount'    => $amount,
            'amount'         => $amount,
            'type'           =>  $type,
            'payment_method' => fake()->randomElement(['pix', 'credit', 'debit']),
            'category_id'    => rand(2, 3),
            'description'    => fake()->sentence(),
            // 'paid_at' => fake()->randomElement([1, 0]),
        ];
    }
}
