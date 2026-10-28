<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estudiantes;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    // GET /api/estudiantes
    public function index()
    {
        // Incluye el nombre de su carrera relacionandola
        $estudiantes = Estudiantes::with('carrera:id,nombre')->get();
        return response()->json($estudiantes, 200);
    }

    // POST /api/estudiantes
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'carrera_id' => 'required|exists:carreras,id',
            'codigo' => 'required|string|unique:estudiantes,codigo',
            'nombres_apellidos' => 'required|string',
            'email' => 'required|email|unique:estudiantes,email',
            'fecha_nacimiento' => 'required|date',
        ]);

        $estudiante = Estudiantes::create($validatedData);

        return response()->json($estudiante, 201);
    }

    // GET /api/estudiantes/{id}
    public function show($id)
    {
        $estudiante = Estudiantes::with('carrera:id,nombre')->find($id);

        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        return response()->json($estudiante, 200);
    }

    // PUT /api/estudiantes/{id}
    public function update(Request $request, $id)
    {
        $estudiante = Estudiantes::find($id);

        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'carrera_id' => 'sometimes|required|exists:carreras,id',
            'codigo' => 'sometimes|required|string|unique:estudiantes,codigo,' . $id,
            'nombres_apellidos' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:estudiantes,email,' . $id,
            'fecha_nacimiento' => 'sometimes|required|date',
        ]);

        $estudiante->update($validatedData);

        return response()->json($estudiante, 200);
    }

    // DELETE /api/estudiantes/{id}
    public function destroy($id)
    {
        $estudiante = Estudiantes::find($id);

        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }

        $estudiante->delete();

        return response()->json(null, 204);
    }
}