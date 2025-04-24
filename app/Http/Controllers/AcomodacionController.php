<?php

namespace App\Http\Controllers;

use App\Models\Acomodacion;
use Illuminate\Http\Request;

class AcomodacionController extends Controller
{
    public function create(Request $request)
    {
        try {
            $acomodacion = new Acomodacion();
            $acomodacion->nombre = $request->nombre;
            $acomodacion->save();
            return response('Acomodación guardada exitosamente', 201);
        } catch (\Throwable $e) {
            return response('Error al guardar la acomodación.', 500);
        }
    }

    public function show(Request $request)
    {
        $acomodacion = Acomodacion::find($request->id);
        if ($acomodacion) {
            return response()->json($acomodacion);
        } else {
            return response('Acomodación no encontrada', 404);
        }
    }

    public function showall()
    {
        $acomodaciones = Acomodacion::all();
        return response()->json($acomodaciones);
    }

    public function update(Request $request)
    {
        try {
            $acomodacion = Acomodacion::find($request->id);
            if ($acomodacion) {
                $acomodacion->nombre = $request->nombre;
                $acomodacion->save();
                return response('Acomodación actualizada exitosamente', 200);
            } else {
                return response('Acomodación no encontrada', 404);
            }
        } catch (\Throwable $e) {
            return response('Error al actualizar la acomodación.', 500);
        }
    }

    public function delete(Request $request)
    {
        $acomodacion = Acomodacion::find($request->id);
        if ($acomodacion) {
            $acomodacion->delete();
            return response('Acomodación eliminada correctamente', 200);
        } else {
            return response('Acomodación no encontrada', 404);
        }
    }
}
