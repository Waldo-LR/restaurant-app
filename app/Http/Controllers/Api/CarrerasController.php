<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Carreras;
use Illuminate\Http\Request;

class CarrerasController extends Controller
{
    // GET /api/carreras
    public function index()
    {
        $carreras = Carreras::all();
        return response()->json($carreras, 200);
    }

    // POST /api/carreras
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100',
            'codigo' => 'required|string|unique:carreras,codigo',
            'facultad' => 'required|string',
            'duracion_semestres' => 'required|integer|between:6,14',
        ]);

        $carrera = Carreras::create($validatedData);

        return response()->json($carrera, 201);
    }

    // GET /api/carreras/{id}
    public function show($id)
    {
        $carrera = Carreras::find($id);

        if (!$carrera) {
            return response()->json(['message' => 'Carrera no encontrada'], 404);
        }

        return response()->json($carrera, 200);
    }

    // PUT /api/carreras/{id}
    public function update(Request $request, $id)
    {
        $carrera = Carreras::find($id);

        if (!$carrera) {
            return response()->json(['message' => 'Carrera no encontrada'], 404);
        }

        $validatedData = $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'codigo' => 'sometimes|required|string|unique:carreras,codigo,' . $id,
            'facultad' => 'sometimes|required|string',
            'duracion_semestres' => 'sometimes|required|integer|between:6,14',
        ]);

        $carrera->update($validatedData);

        return response()->json($carrera, 200);
    }

    // DELETE /api/carreras/{id}
    public function destroy($id)
    {
        $carrera = Carreras::find($id);

        if (!$carrera) {
            return response()->json(['message' => 'Carrera no encontrada'], 404);
        }

        // Validación: No eliminar si tiene estudiantes asociados (Código HTTP 409 Conflict)
        if ($carrera->estudiantes()->count() > 0) {
            return response()->json([
                'message' => 'No se puede eliminar la carrera porque tiene estudiantes registrados'
            ], 409);
        }

        $carrera->delete();

        return response()->json(null, 204);
    }
}