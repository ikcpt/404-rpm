<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car; // Asegúrate de tener este modelo

class CitaController extends Controller
{
    // Muestra el formulario inteligente
    public function create()
    {
        $user = Auth::user();
        
        // Si el usuario está logueado, cogemos sus coches. Si no, una lista vacía.
        $misCoches = $user ? $user->cars : collect(); 

        return view('cita', compact('user', 'misCoches'));
    }

    // Aquí iría la función store() para guardar la cita...
}