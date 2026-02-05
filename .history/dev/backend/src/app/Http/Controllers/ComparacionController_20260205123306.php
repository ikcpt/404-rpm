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

public function store(Request $request) {
    $request->validate([
        'cocheA' => 'required|exists:cars,id',
        'cocheB' => 'required|exists:cars,id',
    ]);

    $comparacion = auth()->user()->comparations()->create([
        'car_a_id' => $request->cocheA,
        'car_b_id' => $request->cocheB,
    ]);

    return response()->json(['success' => true, 'comparacion_id' => $comparacion->id]);
}


    public function showUserComparisons()
    {
        $comparaciones = Auth::user()->comparations()->with(['carA.brand', 'carB.brand'])->get();
        return view('mis_comparaciones', compact('comparaciones'));
    }
}
