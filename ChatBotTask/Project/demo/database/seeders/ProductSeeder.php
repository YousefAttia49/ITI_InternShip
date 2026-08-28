<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        $sampleProducts = [
            ['name' => 'Wireless Bluetooth Headphones', 'description' => 'High quality noise-canceling headphones with long battery life.', 'price' => 99.99, 'quantity' => 25],
            ['name' => 'Smart Fitness Watch', 'description' => 'Water-resistant fitness tracker with heart rate monitor.', 'price' => 149.50, 'quantity' => 40],
            ['name' => 'Mechanical Gaming Keyboard', 'description' => 'RGB backlit mechanical keyboard with tactile switches.', 'price' => 79.99, 'quantity' => 15],
            ['name' => 'Cotton Crewneck T-Shirt', 'description' => '100% organic soft cotton breathable t-shirt.', 'price' => 19.99, 'quantity' => 100],
            ['name' => 'Slim Fit Denim Jeans', 'description' => 'Classic blue stretchable denim jeans for daily wear.', 'price' => 49.99, 'quantity' => 60],
            ['name' => 'Stainless Steel Water Bottle', 'description' => 'Insulated double-wall 1L reusable water flask.', 'price' => 24.99, 'quantity' => 80],
            ['name' => 'Ergonomic Office Chair', 'description' => 'Adjustable lumbar support breathable mesh chair.', 'price' => 199.99, 'quantity' => 10],
            ['name' => 'Non-Stick Cooking Pan', 'description' => 'Durable aluminum fry pan with heat-resistant handle.', 'price' => 34.99, 'quantity' => 35],
        ];

        foreach ($sampleProducts as $product) {
            $category = $categories->random();
            Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'quantity' => $product['quantity'],
                'category_id' => $category->id,
            ]);
        }
    }
}
