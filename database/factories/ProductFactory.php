<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductAttribute;
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
            'name' => fake()->word(),
            'description' => fake()->text(30),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            // Create 3 attributes for each product after the product is created
            $product->attributes()->createMany(ProductAttribute::factory()->count(3)->make()->toArray());
        });
    }
}
