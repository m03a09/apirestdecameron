<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function create(Request $request)
    {
        try {
            $ciudad = Ciudad::find($request->ciudad_id);
            if (!$ciudad) {
                return response('La ciudad especificada no existe.', 400);
            }
            $hotel = new Hotel();
            $hotel->nombre = $request->nombre;
            $hotel->direccion = $request->direccion;
            $hotel->nit = $request->nit;
            $hotel->ciudad_id = $ciudad->id;
            $hotel->numero_habitaciones = $request->numero_habitaciones;
            $hotel->save();
            return response('Hotel guardado exitosamente', 201);
        } catch (\Throwable $e) {
            return response('Error al guardar el hotel.', 500);
        }
    }


    public function show(Request $request)
    {
        $hotel = Hotel::with('ciudad')->find($request->id);
        if ($hotel) {
            return response()->json($hotel);
        } else {
            return response('Hotel no encontrado', 404);
        }
    }

    public function showall()
    {
        $hoteles = Hotel::with('ciudad')->get();
        return response()->json($hoteles);
    }

    public function update(Request $request)
    {
        try {
            $hotel = Hotel::find($request->id);
            if (!$hotel) {
                return response('Hotel no encontrado.', 404);
            }
            $ciudad = Ciudad::find($request->ciudad_id);
            if (!$ciudad) {
                return response('La ciudad especificada no existe.', 400);
            }
            $hotel->nombre = $request->nombre;
            $hotel->direccion = $request->direccion;
            $hotel->nit = $request->nit;
            $hotel->ciudad_id = $ciudad->id;
            $hotel->numero_habitaciones = $request->numero_habitaciones;
            $hotel->save();
            return response('Hotel actualizado exitosamente', 200);
        } catch (\Throwable $e) {
            return response('Error al actualizar el hotel.', 500);
        }
    }

    public function delete(Request $request)
    {
        $hotel = Hotel::find($request->id);
        if ($hotel) {
            $hotel->delete();
            return response('Hotel eliminado correctamente', 200);
        } else {
            return response('Hotel no encontrado', 404);
        }
    }
}
