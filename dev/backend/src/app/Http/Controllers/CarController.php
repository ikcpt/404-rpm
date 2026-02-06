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
}