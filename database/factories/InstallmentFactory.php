<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Installment>
 */
class InstallmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sale_id' => Sale::factory(),
            'number' => 1,
            'amount' => $this->faker->randomFloat(2, 50, 500),
            'due_date' => $this->faker->dateTimeBetween('now', '+6 months'),
            'paid_at' => $this->faker->boolean(70) ? now() : null,
        ];
    }
}
