<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'category' => $this->faker->randomElement(['Plumbing', 'Electrical', 'Cleaning', 'Carpentry', 'Painting']),
            'price' => $this->faker->randomFloat(2, 20, 500),
            'description' => $this->faker->sentence(),
        ];
    }
}
