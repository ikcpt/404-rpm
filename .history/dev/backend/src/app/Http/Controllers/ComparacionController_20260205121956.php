<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Comparison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComparacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Solo usuarios logueados
    }

    public function index()
    {
        $coches = Car::with(['brand', 'extras'])->take(9)->get();
        return view('comparacion', compact('coches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_a_id' => 'required|exists:cars,id',
            'car_b_id' => 'required|exists:cars,id',
        ]);

        $comparison = Comparison::create([
            'user_id' => Auth::id(),
            'car_a_id' => $request->car_a_id,
            'car_b_id' => $request->car_b_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Comparación guardada correctamente',
            'comparison_id' => $comparison->id
        ]);
    }

    public function showUserComparisons()
    {
        $comparisons = Auth::user()->comparisons()->with(['carA.brand', 'carB.brand'])->get();
        return view('mis_comparaciones', compact('comparisons'));
    }
}
