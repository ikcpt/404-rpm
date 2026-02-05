<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class ComparacionController extends Controller
{
    public function index()
    {
        // Traemos todos los coches con sus marcas y extras
        $cars = Car::with('brand', 'extras')->get();

        return view('comparacion', [
            'cars' => $cars
        ]);
    }
}
