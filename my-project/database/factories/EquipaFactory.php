<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipa>
 */
class EquipaFactory extends Factory
{
    protected $model = \App\Models\Equipa::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => fake()->colorName(),
            'simbolo' => fake()->image(),
            'local_pertencente' => fake()->streetName(),
        ];
    }
}
