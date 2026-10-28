<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarreraFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->unique()->jobTitle(),
            'codigo' => 'CAR-' . $this->faker->unique()->numberBetween(100, 999),
            'facultad' => 'Facultad de ' . $this->faker->word(),
            'duracion_semestres' => $this->faker->numberBetween(6, 14),
        ];
    }
}