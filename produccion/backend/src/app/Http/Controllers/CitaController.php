<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\Cita;

class CitaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Obtenemos historial
        $citas = Cita::where('user_id', $user->id)->orderBy('fecha', 'desc')->get();
        $misCoches = $user->cars; 

        // Retornamos la vista del perfil
        return view('profile.Mis-citas', compact('citas', 'misCoches'));
    }

    // Muestra el formulario para pedir cita
    public function create()
    {
        $user = Auth::user();
        
        // 1. Obtener coches del usuario (o colección vacía si no hay usuario)
        $misCoches = $user ? $user->cars : collect(); 

        // 2. Obtener historial de citas (para evitar errores si la vista lo intenta mostrar)
        $citas = $user ? Cita::where('user_id', $user->id)->get() : collect();

        // 3. Retornar vista con TODOS los datos
        return view('cita', compact('user', 'misCoches', 'citas'));
    }

    // Guarda la nueva cita en la base de datos
 public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'descripcion' => 'required|string|max:500', 
            'car_id' => 'required|exists:cars,id',
        ]);

        // 2. Crear la cita
        $cita = new Cita();
        $cita->user_id = Auth::id();
        $cita->car_id = $request->car_id;
        $cita->fecha = $request->fecha; 
        $cita->hora = $request->hora;   
        $cita->description = $request->descripcion; 
        $cita->tipo = $request->input('tipo', 'Mecánica General'); 
        $cita->estado = 'Pendiente';
        
        $cita->save();

        return redirect()->route('perfil')->with('success', '¡Cita solicitada con éxito!');
    }
}