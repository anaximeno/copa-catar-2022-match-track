<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ConfrontoFactory extends Factory
{
    protected $model = \App\Models\Confronto::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'local' => fake()->streetName(),
            'dia' => fake()->date(),
            'inicio' => fake()->dateTime(),
            'fim' => fake()->dateTime(),
            'estadio' => fake()->safeColorName(),
            'terminou' => true
        ];
    }
}
