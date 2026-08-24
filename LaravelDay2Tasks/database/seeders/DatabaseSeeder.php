<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $user1 = User::create([
            'name' => 'Ahmed Mohamed',
            'email' => 'ahmed@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $user2 = User::create([
            'name' => 'Sara Hassan',
            'email' => 'sara@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 2. Seed Categories
        $electronics = Category::create([
            'name' => 'Electronics',
            'description' => 'Gadgets, smartphones, laptops and accessories',
        ]);

        $clothing = Category::create([
            'name' => 'Clothing',
            'description' => 'Men and women fashion, apparel and footwear',
        ]);

        $home = Category::create([
            'name' => 'Home & Kitchen',
            'description' => 'Appliances, furniture and decor',
        ]);

        // 3. Seed Products
        $p1 = Product::create([
            'name' => 'iPhone 15 Pro',
            'description' => 'Apple Smartphone 256GB Titanium',
            'price' => 999.99,
            'quantity' => 15,
            'category_id' => $electronics->id,
        ]);

        $p2 = Product::create([
            'name' => 'MacBook Air M3',
            'description' => 'Apple Laptop 16GB RAM 512GB SSD',
            'price' => 1299.50,
            'quantity' => 8,
            'category_id' => $electronics->id,
        ]);

        $p3 = Product::create([
            'name' => 'Denim Jacket',
            'description' => 'Classic blue denim jacket for unisex',
            'price' => 59.99,
            'quantity' => 25,
            'category_id' => $clothing->id,
        ]);

        $p4 = Product::create([
            'name' => 'Coffee Maker Express',
            'description' => 'Automatic espresso machine with milk frother',
            'price' => 149.00,
            'quantity' => 5,
            'category_id' => $home->id,
        ]);

        // 4. Seed Orders & OrderItems
        $order = Order::create([
            'user_id' => $user1->id,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $p1->id,
            'quantity' => 1,
            'price' => $p1->price,
        ]);
    }
}
