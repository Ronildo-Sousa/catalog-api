<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
            'title' => fake()->sentence(3),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(1, 10000),
        ];
    }

    public static function createWithOwner(User $owner, int $count)
    {
        return Product::factory()
            ->count($count)
            ->for($owner, 'owner')
            ->for(Category::factory()->for($owner, 'owner'))
            ->create();
    }
}
