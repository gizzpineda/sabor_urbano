<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Ejecuta los seeds de usuarios de prueba (admin y cliente).
     */
    public function run(): void
    {
        // Usuario administrador
        User::create([
            'name' => 'Administrador Sabor Urbano',
            'email' => 'admin@saborurbano.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Usuario cliente
        User::create([
            'name' => 'Cliente Sabor Urbano',
            'email' => 'cliente@saborurbano.com',
            'password' => Hash::make('password'),
            'role' => 'cliente',
        ]);
    }
}
