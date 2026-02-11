<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Comparation;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComparacionController extends Controller
{
   public function index()
    {
        $brands = Brand::orderBy('name', 'asc')->get();
        $coches = Car::with('brand')->get();
        $ultimaComparacion = Comparation::where('user_id', Auth::id())->first();

        return view('comparacion', compact('coches', 'brands', 'ultimaComparacion')); 
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

        $userId = Auth::id();

        $comparacion = Comparation::where('user_id', $userId)->first();

        if ($comparacion) {
            $comparacion->update([
                'car_a_id' => $request->car_a_id,
                'car_b_id' => $request->car_b_id,
            ]);
        }
        else {
            $comparacion = Comparation::create([
                'user_id' => $userId,
                'car_a_id' => $request->car_a_id,
                'car_b_id' => $request->car_b_id,
            ]);
        }
        
        return response()->json([
            'success' => true,
            'comparacion_id'=> $comparacion->id
        ]);
    }

    public function destroy() {
        $userId = Auth::id();
        Comparation::where('user_id', $userId)->delete();

        return response()->json([
            'success' => 'true'
        ]);
    }
}