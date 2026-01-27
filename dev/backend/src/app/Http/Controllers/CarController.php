<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        
        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }
        
        return response()->json($car);
    }
}