<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['T-shirt', 'Cap', 'Pant', 'Hat']),
            'description' => $this->faker->paragraphs(4, true),
            'price' => $this->faker->numberBetween(500, 4500)
        ];
    }
}
