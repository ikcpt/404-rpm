<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Comparation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComparacionController extends Controller
{
    // Solo usuarios logueados pueden acceder al comparador
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Página del comparador
    public function index()
    {
        // Traemos los 14 primeros coches con marca y extras
        $coches = Car::with(['brand', 'extras'])->take(14)->get();
        return view('comparacion', compact('coches'));
    }

    // Datos JSON de un coche
    public function show($id)
    {
        return Car::with(['brand', 'extras'])->findOrFail($id);
    }

    // Guardar comparación en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'car_a_id' => 'required|exists:cars,id',
            'car_b_id' => 'required|exists:cars,id',
        ]);

        $comparacion = Comparation::create([
            'user_id'   => Auth::id(),
            'car_a_id'  => $request->car_a_id,
            'car_b_id'  => $request->car_b_id,
        ]);

        return response()->json([
            'success'       => true,
            'message'       => 'Comparación guardada correctamente',
            'comparacion_id'=> $comparacion->id
        ]);
    }

    // Mostrar todas las comparaciones del usuario
    public function showUserComparisons()
    {
        $comparaciones = Auth::user()->comparations()->with(['carA.brand', 'carB.brand'])->get();
        return view('mis_comparaciones', compact('comparaciones'));
    }
}
