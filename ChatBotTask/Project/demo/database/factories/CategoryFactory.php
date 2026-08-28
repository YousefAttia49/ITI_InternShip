<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //name , description , created , updated at
            "name"=>fake()->company(),
            "description"=>fake()->sentence(),
             "created_at"=>now(),
             "updated_at"=>now()
        ];
    }
}
