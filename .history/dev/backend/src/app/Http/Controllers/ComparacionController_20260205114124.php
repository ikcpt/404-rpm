<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class ComparacionController extends Controller
{
    public function index()
    {
        // Solo cargo lo básico que SÉ que tienes (model, image, class)
        $coches = Car::with('brand')->limit(15)->get();
        return view('comparacion', compact('coches'));
    }

    public function show($id)
    {
        try {
            // Buscamos el coche
            $coche = Car::with(['brand', 'extras'])->findOrFail($id);

            // --- AQUÍ ESTÁ LA CLAVE ---
            // Si tu columna no se llama 'price', cambia $coche->price por el nombre real.
            // Si tu columna no se llama 'hp', cámbialo abajo.
            
            return response()->json([
                'success' => true,
                'data' => [
                    'header' => [
                        'marca'  => $coche->brand->name ?? 'Marca',
                        'modelo' => $coche->model, // Asumo que tienes 'model'
                        'imagen' => asset($coche->image), // Asumo que tienes 'image'
                    ],
                    'precio' => [
                        // Intento leer 'price', si no existe, busco 'precio', si no, pongo 0
                        'display' => number_format($coche->price ?? $coche->precio ?? 0, 0, ',', '.') . ' €',
                    ],
                    'specs' => [
                        // 1. CLASE (Este sé que lo tienes porque lo vi en tu web.php)
                        [
                            'label' => 'Categoría', 
                            'val'   => $coche->class ?? 'General' 
                        ],
                        
                        // 2. AÑO / MATRICULACIÓN (Edita 'year' si se llama 'anio' o 'fecha')
                        [
                            'label' => 'Año', 
                            'val'   => $coche->year ?? $coche->anio ?? 'N/A' 
                        ],

                        // 3. MOTOR / CABALLOS (Edita 'hp' si se llama 'cv', 'power', etc)
                        [
                            'label' => 'Potencia', 
                            'val'   => ($coche->hp ?? $coche->cv ?? $coche->potencia ?? 'N/A') 
                        ],

                        // 4. COMBUSTIBLE (Edita 'fuel' si se llama 'combustible' o 'gasolina')
                        [
                            'label' => 'Combustible', 
                            'val'   => $coche->fuel ?? $coche->fuel_type ?? $coche->combustible ?? 'N/A' 
                        ],
                        
                        // 5. CAMBIO (Manual/Auto)
                        [
                            'label' => 'Cambio', 
                            'val'   => $coche->transmission ?? $coche->cambio ?? 'N/A' 
                        ]
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            // Si falla, te dirá EXACTAMENTE qué pasó en la consola del navegador
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}