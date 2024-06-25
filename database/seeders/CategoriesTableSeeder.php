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
                'description' => '<h2><strong>Corte Láser: Transformación Precisa con Tecnología Avanzada</strong></h2><p>En GM Estilos, la categoría de Corte Láser representa la culminación de nuestra búsqueda constante de la excelencia en la fabricación de calzado. Con un enfoque vanguardista, nuestro servicio de Corte Láser utiliza tecnología de última generación para ofrecer un nivel inigualable de precisión y eficiencia en la producción de calzado.</p><h3><strong>Características Destacadas:</strong></h3><ol><li><em>Precisión Milimétrica:</em> Nuestro sistema de corte láser emplea tecnología de vanguardia para lograr cortes precisos con una tolerancia milimétrica. Esto asegura la consistencia y la calidad en cada pieza de calzado fabricada.</li><li><em>Personalización Avanzada:</em> Permitimos la personalización detallada de diseños, patrones y detalles en el calzado mediante el corte láser, brindando a nuestros clientes la posibilidad de crear productos únicos y distintivos.</li><li><em>Eficiencia Operativa:</em> La rapidez y eficiencia del corte láser optimiza nuestros procesos de producción, permitiéndonos cumplir con plazos ajustados sin comprometer la calidad del producto final.</li><li><em>Minimización de Desperdicios:</em> La tecnología de corte láser reduce significativamente el desperdicio de material, contribuyendo a prácticas de fabricación sostenibles y respetuosas con el medio ambiente.</li><li><em>Versatilidad en Materiales:</em> Desde cuero hasta materiales sintéticos, nuestro sistema de corte láser se adapta a una amplia gama de materiales, garantizando una versatilidad excepcional en la producción de calzado.</li></ol><p>En GM Estilos, el Corte Láser no es simplemente una técnica, es un compromiso con la innovación y la calidad. Confía en nosotros para llevar tus diseños de calzado al siguiente nivel, donde la precisión y la perfección se encuentran.</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Flores Corte Laser',
                'slug' => 'flores-corte-laser',
                'description' => 'Diseños florales personalizados mediante corte láser para un calzado distintivo y elegante.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Patronaje',
                'slug' => 'patronaje',
                'description' => 'El arte del patronaje para crear moldes precisos que formarán la base de tu calzado exclusivo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sereado y Piezado',
                'slug' => 'sereado-piezado',
                'description' => 'Servicio completo de sereado y piezado para una producción eficiente y de alta calidad.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Troquelado',
                'slug' => 'troquelado',
                'description' => 'Técnica de troquelado para cortes uniformes y eficientes, asegurando una producción fluida y precisa.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cambrado',
                'slug' => 'cambrado',
                'description' => 'Experiencia en cambrado para dar forma y estructura a tus diseños de calzado con destreza y maestría.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
