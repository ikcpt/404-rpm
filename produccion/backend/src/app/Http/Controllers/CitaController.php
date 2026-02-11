<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Car;
use App\Models\Cita; 

class CitaController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        
        $misCoches = $user ? $user->cars : collect(); 

        $citas = $user ? Cita::where('user_id', $user->id)->get() : collect();

        return view('cita', compact('user', 'misCoches', 'citas'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'descripcion' => 'required|string|max:500',
            'car_id' => 'required|exists:cars,id', 
        ]);

        $cita = new Cita();
        $cita->user_id = Auth::id();
        $cita->car_id = $request->car_id;
        
        $cita->fecha = $request->fecha . ' ' . $request->hora; 
        
        $cita->descripcion = $request->descripcion;
        $cita->estado = 'Pendiente'; 
        
        $cita->save();

        return redirect()->route('perfil')->with('success', '¡Cita solicitada con éxito!');
    }
}