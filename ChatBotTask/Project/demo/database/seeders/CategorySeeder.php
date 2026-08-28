<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Gadgets, devices, smartphones, laptops and accessories.'],
            ['name' => 'Clothing', 'description' => 'Men, women, and kids fashion wear and apparel.'],
            ['name' => 'Books', 'description' => 'Fiction, non-fiction, educational, and comic books.'],
            ['name' => 'Home & Kitchen', 'description' => 'Furniture, kitchenware, appliances, and home decor.'],
            ['name' => 'Sports & Outdoors', 'description' => 'Fitness gear, outdoor equipment, and activewear.'],
            ['name' => 'Beauty & Personal Care', 'description' => 'Skincare, cosmetics, haircare, and grooming products.'],
            ['name' => 'Toys & Games', 'description' => 'Board games, puzzles, action figures, and toys for kids.'],
            ['name' => 'Automotive', 'description' => 'Car accessories, tools, maintenance, and auto parts.'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['name' => $cat['name']], $cat);
        }
    }
}
