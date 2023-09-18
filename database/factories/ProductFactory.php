<?php

namespace Database\Factories;

use App\Enums\Product\Type;
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
        $name = fake()->name;
        $productTypes = array_column(Type::cases(), 'value');

        return [
            'name' => $name,
            'slug' => str()->slug($name),
            'price' => fake()->randomElement([22.25, 20.05,15.25,12.00,25.99,49.99]),
            'product_type' => fake()->randomElement($productTypes),
            'image' => fake()->randomElement(['product1.jpeg', 'product2.jpg', 'product3.jpeg', 'product4.jpeg', 'product7.jpeg', 'product8.jpeg'])
        ];
    }
}
