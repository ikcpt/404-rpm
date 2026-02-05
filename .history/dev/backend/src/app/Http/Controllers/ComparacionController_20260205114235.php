<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class ComparacionController extends Controller
{
    public function index()
    {
        // Carga ligera para el menú de selección
        $coches = Car::with('brand')->select('id', 'brand_id', 'model', 'image')->limit(15)->get();
        return view('comparacion', compact('coches'));
    }

    public function show($id)
    {
        try {
            $coche = Car::with(['brand', 'extras'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'header' => [
                        'marca'  => $coche->brand->name ?? 'Marca',
                        'modelo' => $coche->model,
                        'imagen' => asset($coche->image), // Asegúrate de que la ruta sea accesible
                    ],
                    'precio' => [
                        'display' => number_format($coche->price, 0, ',', '.') . ' €',
                        'value'   => $coche->price 
                    ],
                    // Array de especificaciones para iterar fácil
                    'specs' => [
                        [
                            'id'    => 'hp', // ID para comparar valores luego
                            'label' => 'Potencia',
                            'val'   => $coche->hp, 
                            'unit'  => 'CV'
                        ],
                        [
                            'id'    => 'accel',
                            'label' => '0-100 km/h',
                            'val'   => $coche->acceleration, // Asume que es número (ej: 3.5)
                            'unit'  => 's'
                        ],
                        [
                            'id'    => 'cons',
                            'label' => 'Consumo',
                            'val'   => $coche->consumption, 
                            'unit'  => 'L/100'
                        ]
                    ],
                    'extras' => $coche->extras->pluck('name')->take(3) // Solo los 3 primeros extras
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false], 404);
        }
    }
}