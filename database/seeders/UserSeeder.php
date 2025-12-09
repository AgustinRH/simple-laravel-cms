<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;

/**
 * Seeder de Usuarios
 * Genera usuarios falsos para pruebas utilizando la librería Faker.
 */
class UserSeeder extends Seeder
{
    /**
     * Ejecuta el llenado de la tabla users.
     */
    public function run(): void
    {
        // Inicializa Faker configurado en Español
        $faker = Faker::create('es_ES'); // o 'en_US'

        // Crea 100 usuarios aleatorios
        for ($i = 0; $i < 100; $i++) {
            User::create([
                'name' => $faker->name,
                'address' => $faker->address,
                'email' => $faker->unique()->safeEmail,
                'birth_date' => $faker->date('Y-m-d', '2010-01-01'),
                'password' => bcrypt('123456'), // Contraseña encriptada
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
