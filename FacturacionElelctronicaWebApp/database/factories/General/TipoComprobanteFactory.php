<?php

namespace Database\Factories\General;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\General\TipoComprobante>
 */
class TipoComprobanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo_institucion' => $this->faker->unique()->text(2),
            'descripcion' => $this->faker->text()
        ];
    }
}
