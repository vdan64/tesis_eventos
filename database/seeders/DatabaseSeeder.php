<?php

namespace Database\Seeders;

use App\Models\solicitud;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Factories\SolicitudFactory;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user = User::create([
            'name' => 'username',
            'email' => 'username@example.com',
            'password' => Hash::make('username'),
        ]);

        $user->perfil()->create([
            'nombre' => 'username',
            'cedula' => '23234234',
            'rif' => 'J23234234',
            'mail' => 'username@example.com',
            'telefono' => '02812342323',
            'direccion' => 'bna',
        ]);

//        $solicitudes = solicitud::factory()->count(3)->for($user->perfil)->create();

        $user = User::create([
            'name' => 'funcionario',
            'email' => 'funcionario@example.com',
            'password' => Hash::make('funcionario'),
        ]);

        $user->perfil()->create([
            'nombre' => 'funcionario',
            'cedula' => '9898989',
            'rif' => 'J9898989',
            'mail' => 'funcionario@example.com',
            'telefono' => '02812342323',
            'direccion' => 'bna',
            'tipo' => 'funcionario',
        ]);

        $user = User::create([
            'name' => 'Pedro Garcia',
            'email' => 'dat@example.com',
            'password' => Hash::make('dat'),
        ]);

        $user->perfil()->create([
            'nombre' => 'dat',
            'cedula' => '45454545',
            'rif' => 'J45454545',
            'mail' => 'dat@example.com',
            'telefono' => '02812342323',
            'direccion' => 'bna',
            'tipo' => 'dat',
        ]);

    }
}
