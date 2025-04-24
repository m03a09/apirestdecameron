<?php

namespace App\Http\Controllers;

use App\Models\Acomodacion;
use App\Models\Habitacion;
use App\Models\Hotel;
use App\Models\TipoHabitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HabitacionController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required|exists:hoteles,id',
            'tipo_habitacion_id' => 'required|exists:tipos_habitacion,id',
            'acomodacion_id' => 'required|exists:acomodaciones,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $hotel = Hotel::findOrFail($request->hotel_id);
        $tipoHabitacion = TipoHabitacion::findOrFail($request->tipo_habitacion_id);
        $acomodacion = Acomodacion::findOrFail($request->acomodacion_id);

        // Validar acomodaciones según el tipo de habitación
        $allowedAcomodaciones = $this->getAllowedAcomodaciones($tipoHabitacion->nombre);
        if (!in_array($acomodacion->nombre, $allowedAcomodaciones)) {
            return response()->json(['error' => 'La acomodación no es válida para el tipo de habitación seleccionado.'], 400);
        }

        // Validar la cantidad de habitaciones
        $totalHabitacionesAsignadas = Habitacion::where('hotel_id', $hotel->id)->sum('cantidad');
        if (($totalHabitacionesAsignadas + $request->cantidad) > $hotel->numero_habitaciones) {
            return response()->json(['error' => 'La cantidad de habitaciones configuradas supera el máximo permitido para este hotel.'], 400);
        }

        // Validar que no existan combinaciones repetidas
        $existingHabitacion = Habitacion::where('hotel_id', $request->hotel_id)
            ->where('tipo_habitacion_id', $request->tipo_habitacion_id)
            ->where('acomodacion_id', $request->acomodacion_id)
            ->first();

        if ($existingHabitacion) {
            return response()->json(['error' => 'Ya existe una configuración de habitación con este tipo y acomodación para este hotel.'], 409); // Código 409 Conflict
        }

        try {
            $habitacion = new Habitacion();
            $habitacion->hotel_id = $request->hotel_id;
            $habitacion->tipo_habitacion_id = $request->tipo_habitacion_id;
            $habitacion->acomodacion_id = $request->acomodacion_id;
            $habitacion->cantidad = $request->cantidad;
            $habitacion->save();
            return response()->json($habitacion, 201);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error al guardar la configuración de la habitación.'], 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $habitacion = Habitacion::with(['hotel', 'tipoHabitacion', 'acomodacion'])->find($request->id);
        if ($habitacion) {
            return response()->json($habitacion);
        } else {
            return response('Habitación no encontrada', 404);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function showall()
    {
        $habitaciones = Habitacion::with(['hotel', 'tipoHabitacion', 'acomodacion'])->get();
        return response()->json($habitaciones);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'hotel_id' => 'required|exists:hoteles,id',
            'tipo_habitacion_id' => 'required|exists:tipos_habitacion,id',
            'acomodacion_id' => 'required|exists:acomodaciones,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $hotel = Hotel::findOrFail($request->hotel_id);
        $tipoHabitacion = TipoHabitacion::findOrFail($request->tipo_habitacion_id);
        $acomodacion = Acomodacion::findOrFail($request->acomodacion_id);

        // Validar acomodaciones según el tipo de habitación
        $allowedAcomodaciones = $this->getAllowedAcomodaciones($tipoHabitacion->nombre);
        if (!in_array($acomodacion->nombre, $allowedAcomodaciones)) {
            return response()->json(['error' => 'La acomodación no es válida para el tipo de habitación seleccionado.'], 400);
        }

        // Validar la cantidad de habitaciones (considerando las ya existentes)
        $totalHabitacionesAsignadas = Habitacion::where('hotel_id', $hotel->id)
            ->where('id', '!=', $id) // Excluir la habitación que se está actualizando
            ->sum('cantidad');
        $habitacionExistente = Habitacion::findOrFail($id);
        $nuevaCantidadTotal = ($totalHabitacionesAsignadas - $habitacionExistente->cantidad) + $request->cantidad;
        if ($nuevaCantidadTotal > $hotel->numero_habitaciones) {
            return response()->json(['error' => 'La cantidad de habitaciones configuradas supera el máximo permitido para este hotel.'], 400);
        }

        // Validar que no existan combinaciones repetidas (excluyendo la actual)
        $existingHabitacion = Habitacion::where('hotel_id', $request->hotel_id)
            ->where('tipo_habitacion_id', $request->tipo_habitacion_id)
            ->where('acomodacion_id', $request->acomodacion_id)
            ->where('id', '!=', $id)
            ->first();

        if ($existingHabitacion) {
            return response()->json(['error' => 'Ya existe una configuración de habitación con este tipo y acomodación para este hotel.'], 409); // Código 409 Conflict
        }

        try {
            $habitacion = Habitacion::findOrFail($id);
            $habitacion->hotel_id = $request->hotel_id;
            $habitacion->tipo_habitacion_id = $request->tipo_habitacion_id;
            $habitacion->acomodacion_id = $request->acomodacion_id;
            $habitacion->cantidad = $request->cantidad;
            $habitacion->save();
            return response()->json($habitacion, 200);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error al actualizar la configuración de la habitación.'], 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $habitacion = Habitacion::find($request->id);
        if ($habitacion) {
            $habitacion->delete();
            return response('Habitación eliminada correctamente', 200);
        } else {
            return response('Habitación no encontrada', 404);
        }
    }

    /**
     * @param $tipoHabitacionNombre
     * @return array|string[]
     */
    private function getAllowedAcomodaciones($tipoHabitacionNombre)
    {
        switch ($tipoHabitacionNombre) {
            case 'Estándar':
                return ['Sencilla', 'Doble'];
            case 'Junior':
                return ['Triple', 'Cuádruple'];
            case 'Suite':
                return ['Sencilla', 'Doble', 'Triple'];
            default:
                return [];
        }
    }
}
