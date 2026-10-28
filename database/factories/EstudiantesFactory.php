<?php

namespace Database\Factories;

use App\Models\Carreras;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstudiantesFactory extends Factory
{
    public function definition(): array
    {
        return [
            'carrera_id' => Carreras::inRandomOrder()->first()?->id ?? Carreras::factory(),
            'codigo' => 'EST-' . $this->faker->unique()->numberBetween(10000, 99999),
            'nombres_apellidos' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '2005-01-01'),
        ];
    }
}