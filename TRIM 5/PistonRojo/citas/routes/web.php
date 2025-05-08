<?php

use Illuminate\Support\Facades\Route;
use App\Models\Citas;

// Página principal del administrador
Route::get('/admin', function () {
    // Obtener todas las citas
    $citas = Citas::all();
    // Pasarlas a la vista
    return view('citas.indexAdm', compact('citas'));
});

// Página de inicio con un botón para crear cita
Route::get('/citas', function () {
    return view('citas.inicio');
});

// Mostrar el formulario para crear una cita
Route::get('/citas/create', function () {
    return view('citas.create');
});
// Mostrar el formulario para crear una cita
Route::get('/citas/createAdmin', function () {
    return view('citas.createAdmin');
});

// Crear la cita y redirigir a la página de edición
Route::post('/citas', function () {
    $cita = Citas::create(request()->all());
    return redirect()->route('citas.edit', ['id' => $cita->id]);
});

// Mostrar la página de edición de una cita
Route::get('/citas/{id}/edit', function ($id) {
    $cita = Citas::findOrFail($id);
    return view('citas.edit', compact('cita'));
})->name('citas.edit');

// Actualizar la cita
Route::put('/citas/{id}', function ($id) {
    $cita = Citas::findOrFail($id);
    $cita->update(request()->all());
    return redirect()->route('citas.edit', ['id' => $cita->id]);
});

// Eliminar una cita y devolver respuesta JSON
Route::delete('/admin/{id}', function ($id) {
    $cita = Citas::findOrFail($id);

    // Elimina la cita
    $cita->delete();

    // Devuelve una respuesta JSON
    return response()->json(['message' => 'Cita eliminada correctamente.']);
});
