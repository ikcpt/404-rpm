<?php

namespace App\Http\Controllers;

use App\Models\Car;

class ComparacionController extends Controller
{
    public function index()
    {
        $coches = Car::take(9)->get();
        return view('comparacion', compact('coches'));
    }

    public function show($id)
    {
        return Car::select(
            'modelo',
            'potencia',
            'motor',
            'cero_cien',
            'velocidad',
            'precio'
        )->findOrFail($id);
    }
}
