<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use Illuminate\Http\Request;

class CiudadController extends Controller
{
    public function create(Request $request)
    {
        try {
            $ciudad = new Ciudad();
            $ciudad->nombre = $request->nombre;
            $ciudad->save();
            return response('Ciudad guardada exitosamente', 201);
        } catch (\Throwable $e) {
            return response('Error al guardar la ciudad.', 500);
        }
    }

    public function show(Request $request)
    {
        $ciudad = Ciudad::find($request->id);
        if ($ciudad) {
            return response()->json($ciudad);
        } else {
            return response('Ciudad no encontrada', 404);
        }
    }

    public function showall()
    {
        $ciudades = Ciudad::all();
        return response()->json($ciudades);
    }

    public function update(Request $request)
    {
        try {
            $ciudad = Ciudad::find($request->id);
            if ($ciudad) {
                $ciudad->nombre = $request->nombre;
                $ciudad->save();
                return response('Ciudad actualizada exitosamente', 200);
            } else {
                return response('Ciudad no encontrada', 404);
            }
        } catch (\Throwable $e) {
            return response('Error al actualizar la ciudad.', 500);
        }
    }

    public function delete(Request $request)
    {
        $ciudad = Ciudad::find($request->id);
        if ($ciudad) {
            $ciudad->delete();
            return response('Ciudad eliminada correctamente', 200);
        } else {
            return response('Ciudad no encontrada', 404);
        }
    }
}
