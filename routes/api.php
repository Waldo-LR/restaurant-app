<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarrerasController;
use App\Http\Controllers\Api\EstudiantesController;

// Rutas CRUD para Carreras
Route::apiResource('carreras', CarrerasController::class);

// Rutas CRUD para Estudiantes
Route::apiResource('estudiantes', EstudiantesController::class);

// Endpoint específico de relación
Route::get('carreras/{id}/estudiantes', [CarrerasController::class, 'estudiantesByCarrera']);