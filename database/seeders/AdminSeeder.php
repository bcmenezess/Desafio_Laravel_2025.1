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
            'date_birth' => now(),
            'cpf' => '000.000.000-01',
            'admin_id' => Admin::inRandomOrder()->value('id'),
            'photo' => null
        ]);

        Admin::factory(5)->create();

    }
}
