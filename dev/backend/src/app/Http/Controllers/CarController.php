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

    // Función para filtrar los coches por cada marca y gama, y búsqueda manual del modelo del coche
    public function concesionario(Request $request) {
        // Se guarda en la variable $busqueda lo que ha escrito el usuario en el formulario
        $busqueda = $request->input('buscar');
        
        // Obtenemos todas las marcas de los coches
        $brands = Brand::with('cars')->get();

        // Se ejecuta la consulta en la BBDD dependiendo de lo que haya introducido el usuario, se mostrará el modelo concreto del coche, o todos los modelos de la marca
        $filtrar = function($query) use ($busqueda) {
            if ($busqueda) {
                // Se ejecuta la consulta en la BBDD
                $query->where(function($q) use ($busqueda) {
                    // Se busca que el nombre del modelo coincida con la búsqueda del usuario
                    $q->where('model', 'LIKE', "%$busqueda%")
                    // Se busca que el nombre de la marca coincida con la búsqueda del usuario
                    ->orWhereRelation('brand', 'name', 'LIKE', "%$busqueda%");
                });
            }
            return $query;
        };

        // Obtenemos los coches separándolos por su clase
        $gamaAlta  = $filtrar(Car::where('class', 'Gama Alta')->with('brand'))->get();
        $gamaMedia = $filtrar(Car::where('class', 'Gama Media')->with('brand'))->get();
        $ocasion   = $filtrar(Car::where('class', 'Ocasión')->with('brand'))->get();

        // A la vista se le pasan las marcas, y los coches de cada categoría, y el resultado de la búsqueda
        return view('concesionario', compact('brands', 'gamaAlta', 'gamaMedia', 'ocasion', 'busqueda'));
    }
}