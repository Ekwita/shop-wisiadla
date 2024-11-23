<?php

namespace Database\Factories;

use App\Models\Category;
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
            'name' => fake()->unique()->word(),
            'description' => fake()->name(),
            'price' => fake()->randomFloat(2, 0.10, 99.99),
            'quantity' => fake()->numberBetween(1, 100),
            'category_id' => Category::inRandomOrder()->pluck('id')->first(),
        ];
    }
}
