<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // Devuelve una lista de todos los coches del concesionario, con los extras de cada uno.
    public function index()
    {
        $cars = Car::with(['brand', 'extras'])->get();
        return response()->json($cars);
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $car = Car::with(['brand', 'extras'])->find($id);
        
        // Si no se encuentra el ID del coche, el JSON devolverá un mensaje de error
        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }
        
        return response()->json($car);
    }

    // Función para filtrar coches por cada marca diferente, utilizando el ID de la marca
    public function carsByBrand($id) {
        $brand = Brand::find($id);

        // Si no se encuentra el ID se redigirá al usuario a la página del conesionario
        if (!$brand) {
            return redirect()->route('concesionario');
        }

        $cars = Car::where('brand_id', $id)->get();

        return view('marca', compact('brand', 'cars'));
    }
}