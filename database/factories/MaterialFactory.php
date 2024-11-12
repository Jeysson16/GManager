<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Material;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Material::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->word,  // Genera una palabra aleatoria como título
            'customer_id' => Customer::factory(),  // Genera un cliente relacionado (si tienes una relación con el modelo Customer)
            'description' => $this->faker->sentence,  // Genera una frase aleatoria como descripción
            'color' => $this->faker->colorName,  // Genera un color aleatorio
            'unit_of_measure' => $this->faker->randomElement(['metros', 'kilogramos', 'litros', 'unidades']),  // Genera una unidad de medida aleatoria
            'stock' => $this->faker->randomFloat(2, 0, 1000),  // Genera un valor decimal aleatorio para el stock
        ];
    }
}
