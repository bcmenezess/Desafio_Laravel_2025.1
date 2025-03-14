<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'teste_usuario',
            'email' => 'usuario@usuario',
            'password' => 'usuario',
            'address' => 'rua dos bobos, 10',
            'telephone' => '4002-8922',
            'date_birth' => fake()->date(),
            'cpf' => '00000000000',
            'balance' => 999999,
            'admin_id' => Admin::inRandomOrder()->value('id'),
            'photo' => 'profiles\avatar-default.png'
        ]);

        User::factory(17)->create();

    }
}
