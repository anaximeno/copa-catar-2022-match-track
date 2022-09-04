<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jogador>
 */
class JogadorFactory extends Factory
{
    protected $model = \App\Models\Jogador::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $posicoes = [
            'Goleiro',
            'Lateral-direito',
            'Lateral-esquerdo',
            'Alas',
            'Zagueiro',
            'Líbero',
            'Volante ou meio-campo defensivo',
            'Meia de contenção',
            'Meia de armação',
            'Meia pelos extremos',
            'Meia atacante',
            'Segundo atacante ou atacante recuado',
            'Pontas ou atacantes de beiradas',
            'Centroavante ou atacante de área'
        ];

        $pos = $posicoes[rand(0, count($posicoes)) % count($posicoes)];

        return [
            'nome' => fake()->firstName('male'),
            'sobrenome' => fake()->lastName(),
            'apelido' => fake()->userName(),
            'idade' => fake()->numberBetween(19, 45),
            'numero_camisa' => fake()->numberBetween(0, 26),
            'posicao' => $pos
        ];
    }
}
