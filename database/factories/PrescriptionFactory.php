<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::query()->inRandomOrder()->first()?->id ?? Client::factory(),
            'image_path' => 'prescriptions/sample.jpg',
            'notes' => $this->faker->sentence(),
            'issued_at' => $this->faker->date(),
        ];
    }
}
