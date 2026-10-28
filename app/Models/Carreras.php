<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carreras extends Model
{
    use HasFactory;

    protected $table = 'carreras';

    protected $fillable = [
        'nombre',
        'codigo',
        'facultad',
        'duracion_semestres',
    ];

    // Relación uno a muchos: Una carrera tiene muchos estudiantes
    public function estudiantes()
    {
        return $this->hasMany(Estudiantes::class, 'carrera_id');
    }
}