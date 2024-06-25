<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StereotypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('stereotypes')->insert([
            [
                'category_id' => 1,
                'title' => 'Patrón de Sandalia',
                'description' => 'Diseño y patronaje para sandalia',
                'price' => 40.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'title' => 'Seriado de Sandalia',
                'description' => 'Producción seriada de sandalia',
                'price' => 26.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'title' => 'Patrón y Seriado de Sandalia',
                'description' => 'Diseño y producción seriada de sandalia',
                'price' => 60.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'title' => 'Patrón de Botín',
                'description' => 'Diseño y patronaje para botín',
                'price' => 55.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'title' => 'Patrón de Bota Vaquera',
                'description' => 'Diseño y patronaje para bota vaquera',
                'price' => 80.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'title' => 'Patrón de Botín Stresh',
                'description' => 'Diseño y patronaje para botín stresh',
                'price' => 80.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'title' => 'Patrón Media Estación',
                'description' => 'Diseño y patronaje para media estación',
                'price' => 40.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'title' => 'Corte Laser Piezas Docena',
                'description' => 'Corte láser de piezas por docena',
                'price' => 31.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'title' => 'Flores Corte Laser Docena Sencillos Cuero',
                'description' => 'Flores cortadas con láser por docena en cuero',
                'price' => 15.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'title' => 'Flores Corte Laser Docena Sencillos Sintético',
                'description' => 'Flores cortadas con láser por docena en sintético',
                'price' => 13.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'title' => 'Flores Corte Laser Docena Armados Cuero',
                'description' => 'Flores cortadas y armadas con láser por docena en cuero',
                'price' => 18.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'title' => 'Flores Corte Laser Docena Armados Sintético',
                'description' => 'Flores cortadas y armadas con láser por docena en sintético',
                'price' => 15.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 5,
                'title' => 'Troquelado de Falsas 1 Metro',
                'description' => 'Troquelado de falsas por metro',
                'price' => 7.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 5,
                'title' => 'Troquelado de Docena de Falsas',
                'description' => 'Troquelado de docena de falsas',
                'price' => 2.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'title' => 'Corte Laser Metro de Plantilla',
                'description' => 'Corte láser de plantilla por metro',
                'price' => 20.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 6,
                'title' => 'Cambrado Docena de Capelladas',
                'description' => 'Cambrado de capelladas por docena',
                'price' => 9.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 6,
                'title' => 'Cambrado y Planchado Docena de Capelladas',
                'description' => 'Cambrado y planchado de capelladas por docena',
                'price' => 13.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'title' => 'Seriado de Botín',
                'description' => 'Producción seriada de botín',
                'price' => 46.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'title' => 'Seriado de Capellada',
                'description' => 'Producción seriada de capellada',
                'price' => 12.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ... (Continuar con los demás registros)
        ]);
    }
}