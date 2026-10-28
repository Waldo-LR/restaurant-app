<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';

    protected $fillable = [
        'carrera_id',
        'codigo',
        'nombres_apellidos',
        'email',
        'fecha_nacimiento',
    ];

    // Relación inversa: Un estudiante pertenece a una carrera
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }
}