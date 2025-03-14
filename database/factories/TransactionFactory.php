<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->randomDigitNotZero();
        $product = Product::inRandomOrder()->first();

        return [
            'date' => fake()->date(),
            'quantity' => $quantity,
            'total_price' => $quantity * $product->price,
            'buyer_id' => User::inRandomOrder()->value('id'),
            'product_id' => $product->id
        ];
    }
}
