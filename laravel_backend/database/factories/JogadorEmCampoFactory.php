<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JogadorEmCampo>
 */
class JogadorEmCampoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tempo_de_entrada' => fake()->dateTime(),
            'tempo_de_saida' => fake()->dateTime(),
        ];
    }
}
