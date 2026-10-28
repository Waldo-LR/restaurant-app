<?php

namespace Database\Seeders;

use App\Models\Carreras;
use App\Models\Estudiantes;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crea 5 carreras
        $carreras = Carreras::factory(5)->create();

        // Crea 15 estudiantes distribuidos entre las carreras creadas
        foreach (range(1, 15) as $index) {
            Estudiantes::factory()->create([
                'carrera_id' => $carreras->random()->id,
            ]);
        }
    }
}