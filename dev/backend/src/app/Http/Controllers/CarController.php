<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Brand;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // API: Lista de todos los coches
    public function index()
    {
        $cars = Car::with(['brand', 'extras'])->get();
        return response()->json($cars);
    }

    // --- ESTA ES LA ÚNICA FUNCIÓN SHOW QUE DEBES TENER ---
    // WEB: Carga la página visual (el esqueleto)
    public function show($id)
    {
        $car = Car::findOrFail($id);
        return view('ficha', compact('car'));
    }
    // -----------------------------------------------------

    public function comprar(Car $car)
    {
        $nuevoCoche = $car->replicate();
        $nuevoCoche->user_id = auth()->id();
        $nuevoCoche->status = 'sold';
        $nuevoCoche->save();

        return redirect()->route('perfil')->with('success', '¡Compra realizada con éxito!');
    }

    public function mostrarFormularioReserva(Car $car)
    {
        return view('reservar', compact('car'));
    }

    public function procesarReserva(Request $request, Car $car)
    {
        $request->validate([
            'fecha_entrada' => 'required|date',
            'mensaje' => 'nullable|string'
        ]);

        $cocheReservado = $car->replicate();
        $cocheReservado->user_id = auth()->id();
        $cocheReservado->status = 'reserved';
        $cocheReservado->save();

        return redirect()->route('perfil')->with('success', 'Reserva confirmada.');
    }
    
    // Filtrado por marca
    public function carsByBrand($id) {
        $brand = Brand::find($id);
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

    public function finalizarReserva(Car $car)
    {
        // Seguridad: Verificar que el coche es del usuario y está reservado
        if ($car->user_id !== auth()->id() || $car->status !== 'reserved') {
            return back()->with('error', 'Acción no autorizada.');
        }

        // Simplemente cambiamos el estado
        $car->status = 'sold';
        $car->save();

        return redirect()->route('perfil')->with('success', '¡Compra completada! El coche es tuyo oficialmente.');
    }
}