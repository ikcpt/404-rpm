<?php

namespace App\Http\Controllers;

use App\Models\Car;

class ComparacionController extends Controller
{
    // Página del comparador
    public function index()
    {
        // Traemos los 9 primeros coches (puedes cambiar el número)
        $coches = Car::with(['brand', 'extras'])->take(9)->get();
        return view('comparacion', compact('coches'));
    }

    // Datos JSON de un coche
    public function show($id)
    {
        // Cargamos marca y extras
        return Car::with(['brand', 'extras'])->findOrFail($id);
    }
}
