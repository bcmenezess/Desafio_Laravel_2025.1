<?php

namespace Database\Factories;

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
            'name' => fake()->word(),
            'price' => fake()->randomNumber(4,false),
            'quantity' => fake()->randomNumber(2,false),
            'description' => fake()->text(),
            'category' => fake()->randomDigit(),
            'user_id' => User::inRandomOrder()->value('id')
        ];
    }
}
