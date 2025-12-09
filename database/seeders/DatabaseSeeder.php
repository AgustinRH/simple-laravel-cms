<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * Seeder Principal (DatabaseSeeder)
 * Este es el punto de entrada para poblar la base de datos.
 * Se ejecuta con el comando: php artisan db:seed
 */
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Ejecuta los seeders de la base de datos.
     */
    public function run(): void
    {
        // Ejemplo de factory por defecto (comentado)
        // User::factory(10)->create();

        // Crea un usuario de prueba específico
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Llama a otros seeders específicos para poblar tablas adicionales
        $this->call([
            UserSeeder::class,    // Crea 100 usuarios falsos
            ArticleSeeder::class, // Crea 50 artículos falsos
        ]);

    }
}
