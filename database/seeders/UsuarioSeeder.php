<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@tienda.com'],
            [
                'name'     => 'Administrador Principal',
                'password' => Hash::make('admin123'),
                'rol'      => 'administrador',
            ]
        );

        User::updateOrCreate(
            ['email' => 'empleado@tienda.com'],
            [
                'name'     => 'Empleado Mostrador',
                'password' => Hash::make('empleado123'),
                'rol'      => 'empleado',
            ]
        );
    }
}