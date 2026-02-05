<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ComparacionController extends Controller
{
    /**
     * Muestra la vista principal del comparador con el listado de coches.
     */
    public function index()
    {
        // Traemos los coches con sus relaciones para evitar el problema de consultas N+1
        // He aumentado el límite a 12 para que el "scroll" horizontal luzca mejor
        $coches = Car::with(['brand'])
            ->where('active', true) // Opcional: solo coches activos
            ->latest()
            ->take(12)
            ->get();

        return view('comparacion', compact('coches'));
    }

    /**
     * Devuelve los detalles técnicos de un coche específico para la comparación.
     * Se usa mediante una llamada AJAX/Fetch desde el JS.
     */
    public function show($id): JsonResponse
    {
        try {
            // Cargamos el coche con su marca y todos los extras
            $coche = Car::with(['brand', 'extras'])->findOrFail($id);

            // Retornamos una respuesta JSON limpia
            return response()->json([
                'status' => 'success',
                'data'   => [
                    'id'            => $coche->id,
                    'modelo'        => $coche->model,
                    'marca'         => $coche->brand->name ?? 'Genérica',
                    'imagen'        => $coche->image,
                    'precio'        => number_format($coche->price, 0, ',', '.'),
                    'precio_raw'    => $coche->price,
                    // Atributos técnicos para las barras de comparación
                    'specs' => [
                        'potencia'    => $coche->hp . ' CV',
                        'potencia_val'=> $coche->hp,
                        'consumo'     => $coche->consumption . ' L/100km',
                        'transmision' => $coche->transmission,
                        'combustible' => $coche->fuel_type,
                        'aceleracion' => $coche->acceleration_0_100 . 's',
                    ],
                    'extras' => $coche->extras->pluck('name'),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Vehículo no encontrado'
            ], 404);
        }
    }
}