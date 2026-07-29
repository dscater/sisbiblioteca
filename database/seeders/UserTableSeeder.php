<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'password' => 'admin',
            'tipo' => 'ADMINISTRADOR',
            'foto' => 'user_default.png',
            'estado' => 1
        ]);
    }
}
