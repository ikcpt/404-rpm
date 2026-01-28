<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review; // <--- Importante: Cargamos el modelo Review

class HomeController extends Controller
{
    public function index()
    {
        // 1. Pedimos las 3 últimas reseñas a la base de datos.
        // 2. Usamos 'with('user')' para traer también el nombre del usuario (optimización).
        $reviews = Review::with('user')->latest()->take(3)->get();

        // 3. Enviamos la variable $reviews a la vista 'index'
        return view('index', compact('reviews'));
    }
}