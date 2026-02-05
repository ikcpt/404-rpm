<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class ComparacionController extends Controller
{
    /**
     * Muestra la vista principal (el Garage).
     * Carga solo lo necesario para las tarjetas visuales.
     */
    public function index()
    {
        // Optimizamos la consulta: Solo traemos datos para la tarjeta (ID, Modelo, Imagen, Marca)
        // Esto hace que la carga sea rápida aunque tengas 50 coches.
        $coches = Car::with('brand')
            ->select('id', 'brand_id', 'model', 'image') // Asumiendo que estos campos existen
            ->limit(12) // Limitamos a 12 para el scroll horizontal
            ->get();

        return view('comparacion', compact('coches'));
    }

    /**
     * Devuelve los datos DETALLADOS de un coche vía JSON.
     * Esta función es la que llama el JavaScript cuando sueltas la tarjeta.
     */
    public function show($id)
    {
        try {
            $coche = Car::with(['brand', 'extras'])->findOrFail($id);

            // AQUÍ ESTÁ LA COHERENCIA:
            // Transformamos los datos para que el JS los pinte directo.
            // Separamos 'display' (texto bonito) de 'value' (número para lógica/barras).

            return response()->json([
                'success' => true,
                'data' => [
                    // Cabecera de la tarjeta
                    'header' => [
                        'id'     => $coche->id,
                        'marca'  => $coche->brand->name ?? 'Marca',
                        'modelo' => $coche->model,
                        'imagen' => asset($coche->image), // Asegura la ruta completa de la imagen
                    ],
                    
                    // Precio (Formateado y crudo)
                    'precio' => [
                        'display' => number_format($coche->price, 0, ',', '.') . ' €',
                        'value'   => $coche->price 
                    ],

                    // Especificaciones técnicas (Lista para iterar en el HTML)
                    'specs' => [
                        [
                            'label' => 'Potencia',
                            'text'  => $coche->hp . ' CV',
                            'icon'  => '🚀' // Opcional: puedes pasar iconos aquí
                        ],
                        [
                            'label' => '0-100 km/h',
                            'text'  => $coche->acceleration . ' s',
                            'icon'  => '⏱️'
                        ],
                        [
                            'label' => 'Consumo',
                            'text'  => $coche->consumption . ' L/100',
                            'icon'  => '⛽'
                        ],
                        [
                            'label' => 'Motor',
                            'text'  => $coche->engine_type, // Ej: "V8 Biturbo"
                            'icon'  => '⚙️'
                        ]
                    ],

                    // Extras (Array simple de strings)
                    'extras' => $coche->extras->pluck('name')
                ]
            ]);

        } catch (\Exception $e) {
            // Si algo falla, devolvemos un error controlado
            return response()->json([
                'success' => false,
                'message' => 'No se pudo cargar la información del vehículo.'
            ], 404);
        }
    }
}