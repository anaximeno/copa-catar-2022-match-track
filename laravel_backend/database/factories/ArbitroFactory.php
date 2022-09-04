<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Arbitro>
 */
class ArbitroFactory extends Factory
{
    protected $model = \App\Models\Arbitro::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => fake()->firstName(),
            'sobrenome' => fake()->lastName(),
            'idade' => fake()->numberBetween(25, 50)
        ];
    }
}
