<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::truncate();
        $products = [
            [
                'name' => 'Product 1',
                'slug' => str()->slug('Product 1'),
                'price' => 22.25,
                'product_type' => 'c2c',
                'image' => 'product1.jpeg'
            ],
            [
                'name' => 'Product 2',
                'slug' => str()->slug('Product 2'),
                'price' => 24.99,
                'product_type' => 'c2b',
                'image' => 'product2.jpg'
            ]
        ];

        foreach($products as $product) {
            Product::create($product);
        }
    }
}
