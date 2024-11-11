<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'title' => 'Corte Laser',
                'slug' => 'corte-laser',
                'description' => '<p>En GM Estilos, la categoría de Corte Láser representa la culminación de nuestra búsqueda constante de la excelencia en la fabricación de calzado. Con un enfoque vanguardista, nuestro servicio de Corte Láser utiliza tecnología de última generación para ofrecer un nivel inigualable de precisión y eficiencia en la producción de calzado.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Flores Corte Laser',
                'slug' => 'flores-corte-laser',
                'description' => '<p>En GM Estilos, nos especializamos en crear diseños florales personalizados mediante el uso de corte láser, ofreciendo un toque distintivo y elegante a cada pieza de calzado. Cada diseño es único, brindando un estilo sofisticado y elegante que resalta la calidad del calzado.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Patronaje',
                'slug' => 'patronaje',
                'description' => '<p>El patronaje es el arte de crear moldes precisos que forman la base de cada calzado exclusivo. En GM Estilos, nuestro equipo de expertos trabaja con precisión para asegurarse de que cada patrón sea perfecto, lo que asegura una fabricación de calzado de la más alta calidad.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sereado y Piezado',
                'slug' => 'sereado-piezado',
                'description' => '<p>En GM Estilos, ofrecemos un servicio completo de sereado y piezado para una producción eficiente y de alta calidad. Este proceso es clave para garantizar que cada pieza de calzado tenga un acabado perfecto y se ajuste con precisión a los patrones predefinidos.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Troquelado',
                'slug' => 'troquelado',
                'description' => '<p>La técnica de troquelado es esencial para realizar cortes uniformes y eficientes, lo que asegura una producción fluida y precisa. Con este proceso, cada pieza de calzado es tratada con la más alta precisión para garantizar que se mantengan los estándares de calidad más altos.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cambrado',
                'slug' => 'cambrado',
                'description' => '<p>En GM Estilos, ofrecemos experiencia en cambrado para dar forma y estructura a tus diseños de calzado con destreza y maestría. Este proceso es fundamental para asegurar que cada par de calzado no solo sea funcional, sino que también tenga una estética impecable y duradera.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
