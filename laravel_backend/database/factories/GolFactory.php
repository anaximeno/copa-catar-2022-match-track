<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gol>
 */
class GolFactory extends Factory
{
    protected $model = \App\Models\Gol::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tempo_do_jogo' => fake()->dateTime(),
            'detalhes' => fake()->text()
        ];
    }
}
