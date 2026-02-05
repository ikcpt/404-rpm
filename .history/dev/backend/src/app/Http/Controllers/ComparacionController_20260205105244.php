<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class ComparacionController extends Controller
{
    public function index()
    {
        // Traemos los coches de la BBDD
        $cars = Car::with('brand', 'extras')->get(); 

        // Pasamos la variable a la vista
        return view('comparacion', compact('cars'));
    }
}
