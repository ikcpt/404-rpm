@extends('layouts.layout')

@section('content')
<div
    style="max-width: 600px; margin: 50px auto; padding: 30px; background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); font-family: sans-serif;">

    <h2 style="color: #1a4a9c; margin-bottom: 20px; text-align: center;">
        Reservar {{ $car->brand->name }} {{ $car->model }}
    </h2>

    <p style="text-align: center; color: #666; margin-bottom: 30px;">
        Vas a reservar este vehículo. Por favor, indícanos cuándo quieres pasarte.
    </p>

    <form action="{{ route('coche.reservar.proceso', $car->id) }}" method="POST">
        @csrf

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #333;">Fecha de visita /
                recogida:</label>
            <input type="date" name="fecha_entrada" required min="{{ date('Y-m-d') }}"
                style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px; font-size: 1rem;">
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #333;">Notas adicionales
                (Opcional):</label>
            <textarea name="mensaje" rows="4" placeholder="Ej: Me gustaría probarlo antes..."
                style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px; font-size: 1rem; resize: vertical;"></textarea>
        </div>

        <div style="display: flex; gap: 10px;">
            <a href="{{ url()->previous() }}"
                style="flex: 1; text-align: center; padding: 12px; background: #eee; color: #333; text-decoration: none; border-radius: 8px; font-weight: bold;">
                Cancelar
            </a>
            <button type="submit"
                style="flex: 2; background: #1a4a9c; color: white; padding: 12px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; font-size: 1rem;">
                CONFIRMAR RESERVA
            </button>
        </div>
    </form>
</div>
@endsection