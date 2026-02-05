<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Comparation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComparacionController extends Controller
{
    public function index()
    {
        $coches = Car::with(['brand', 'extras'])->take(14)->get();
        return view('comparacion', compact('coches'));
    }

    public function show($id)
    {
        return Car::with(['brand', 'extras'])->findOrFail($id);
    }

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

    public function showUserComparisons()
    {
        $comparaciones = Auth::user()->comparations()->with(['carA.brand', 'carB.brand'])->get();
        return view('mis_comparaciones', compact('comparaciones'));
    }
}
