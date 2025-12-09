<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Faker\Factory as Faker;

/**
 * Seeder de Artículos
 * Genera artículos falsos y los asigna aleatoriamente a usuarios existentes.
 */
class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('es_ES');

        // Crea 50 artículos de prueba
        for ($i = 0; $i < 50; $i++) {
            Article::create([
                'title' => $faker->sentence(),
                'description' => $faker->paragraph(),
                'user_id' => rand(1, 100), // Asigna un user_id al azar entre 1 y 100 (asumiendo que existen por UserSeeder)
            ]);
        }
    }
}
