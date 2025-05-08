<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class citasController extends Controller
{
    /**
     * Mostrar todas las citas.
     */
    public function index()
    {
        $citas = Citas::all();

        return response()->json([
            'message' => 'Citas obtenidas exitosamente',
            'citas' => $citas,
        ], 200);
    }

    /**
     * Crear una nueva cita.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'apellido' => 'required|string|max:50',
            'tipo_documento' => 'required|string|in:cc,ti,cxe,pasaporte',
            'numero_documento' => 'required|string|max:20|unique:citas,numero_documento',
            'tipo_servicio' => 'required|string|in:cambio de aceite,revision general,mantenimiento general',
            'dia' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i|after_or_equal:08:00|before_or_equal:18:00',
        ]);

        $existingCita = Citas::where('dia', $validatedData['dia'])
                            ->where('hora', $validatedData['hora'])
                            ->first();

        if ($existingCita) {
            return response()->json([
                'message' => 'Ya existe una cita programada para este día y hora.',
            ], 409);
        }

        $cita = Citas::create($validatedData);

        return response()->json([
            'message' => 'Cita creada exitosamente',
            'cita' => $cita,
        ], 201);
    }

    /**
     * Mostrar los detalles de una cita específica.
     */
    public function show($id)
    {
        $cita = Citas::find($id);

        if (!$cita) {
            return response()->json([
                'message' => 'Cita no encontrada',
            ], 404);
        }

        return response()->json([
            'message' => 'Cita obtenida exitosamente',
            'cita' => $cita,
        ], 200);
    }

    /**
     * Actualizar una cita existente.
     */
    public function update(Request $request, $id)
    {
        $cita = Citas::find($id);

        if (!$cita) {
            return response()->json([
                'message' => 'Cita no encontrada',
            ], 404);
        }

        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:50',
            'apellido' => 'sometimes|string|max:50',
            'tipo_documento' => 'sometimes|string|in:cc,ti,cxe,pasaporte',
            'numero_documento' => 'sometimes|string|max:20|unique:citas,numero_documento,' . $id,
            'tipo_servicio' => 'sometimes|string|in:cambio de aceite,revision general,mantenimiento general',
            'dia' => 'sometimes|date|after_or_equal:today',
            'hora' => 'sometimes|date_format:H:i|after_or_equal:08:00|before_or_equal:18:00',
        ]);

        $existingCita = Citas::where('dia', $validatedData['dia'] ?? $cita->dia)
                            ->where('hora', $validatedData['hora'] ?? $cita->hora)
                            ->where('id', '!=', $id)
                            ->first();

        if ($existingCita) {
            return response()->json([
                'message' => 'Ya existe una cita programada para este día y hora.',
            ], 409);
        }

        $cita->update($validatedData);

        return response()->json([
            'message' => 'Cita actualizada exitosamente',
            'cita' => $cita,
        ], 200);
    }

    /**
     * Eliminar una cita.
     */
    public function destroy($id)
    {
        $cita = Citas::find($id);

        if (!$cita) {
            return response()->json([
                'message' => 'Cita no encontrada',
            ], 404);
        }

        $cita->delete();

        return response()->json([
            'message' => 'Cita eliminada exitosamente',
        ], 200);
    }
}
