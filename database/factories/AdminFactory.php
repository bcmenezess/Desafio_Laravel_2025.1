<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{

    protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'address' => fake()->address(),
            'telephone' => fake()->phoneNumber(),
            'date_birth' => fake()->date(),
            'cpf' => fake()->randomFloat(0,10000000000,99999999999),
            'photo' => 'profiles\avatar-default.png',
            'admin_id' => Admin::inRandomOrder()->value('id'),
            'remember_token' => Str::random(10),
        ];
    }
}
