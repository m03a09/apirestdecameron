<?php

namespace App\Http\Controllers;

use App\Models\TipoHabitacion;
use Illuminate\Http\Request;

class TipoHabitacionController extends Controller
{
    public function create(Request $request)
    {
        try {
            $tipoHabitacion = new TipoHabitacion();
            $tipoHabitacion->nombre = $request->nombre;
            $tipoHabitacion->save();
            return response('Tipo de habitación guardado exitosamente', 201);
        } catch (\Throwable $e) {
            return response('Error al guardar el tipo de habitación.', 500);
        }
    }

    public function show(Request $request)
    {
        $tipoHabitacion = TipoHabitacion::find($request->id);
        if ($tipoHabitacion) {
            return response()->json($tipoHabitacion);
        } else {
            return response('Tipo de habitación no encontrado', 404);
        }
    }

    public function showall()
    {
        $tiposHabitacion = TipoHabitacion::all();
        return response()->json($tiposHabitacion);
    }

    public function update(Request $request)
    {
        try {
            $tipoHabitacion = TipoHabitacion::find($request->id);
            if ($tipoHabitacion) {
                $tipoHabitacion->nombre = $request->nombre;
                $tipoHabitacion->save();
                return response('Tipo de habitación actualizado exitosamente', 200);
            } else {
                return response('Tipo de habitación no encontrado', 404);
            }
        } catch (\Throwable $e) {
            return response('Error al actualizar el tipo de habitación.', 500);
        }
    }

    public function delete(Request $request)
    {
        $tipoHabitacion = TipoHabitacion::find($request->id);
        if ($tipoHabitacion) {
            $tipoHabitacion->delete();
            return response('Tipo de habitación eliminado correctamente', 200);
        } else {
            return response('Tipo de habitación no encontrado', 404);
        }
    }
}
