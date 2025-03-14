<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory()->create([
            'name' => 'teste_admin',
            'email' => 'admin@admin',
            'password' => 'admin',
            'address' => 'rua dos bobos, 20',
            'telephone' => '190',
            'date_birth' => fake()->date(),
            'cpf' => '00000000001',
            'admin_id' => Admin::inRandomOrder()->value('id'),
            'photo' => 'profiles\avatar-default.png'
        ]);

        Admin::factory(5)->create();

    }
}
