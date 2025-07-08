<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isInstallment = $this->faker->boolean(50);
        $installments = $isInstallment ? $this->faker->numberBetween(2, 6) : null;

        return [
            'client_id' => Client::factory(),
            'total' => $this->faker->randomFloat(2, 100, 2000),
            'payment_type' => $isInstallment ? 'installment' : 'cash',
            'installments_count' => $installments,
        ];
    }
}
