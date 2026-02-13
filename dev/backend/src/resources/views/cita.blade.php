@extends('layouts.layout')

@section('title', 'Pedir Cita')

@section('content')

<div class="container" style="max-width: 800px; margin: 50px auto; padding: 20px;">

    <div class="encabezado" style="text-align: center; margin-bottom: 40px;">
        <h2 style="font-weight: 700; color: #333;">🔧 Taller Oficial</h2>
        <p style="color: #666;">Gestiona el mantenimiento de tus vehículos</p>
    </div>

    {{-- LÓGICA: ¿Tiene coches el usuario? --}}
    @if($misCoches->isEmpty())

    {{-- CASO 1: NO TIENE COCHES (Mensaje del usuario) --}}
    <div
        style="background-color: #fff3cd; color: #856404; padding: 30px; border-radius: 10px; border: 1px solid #ffeeba; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <div style="font-size: 3rem; margin-bottom: 15px;">🚶‍♂️💨</div>
        <h3 style="margin-bottom: 15px; font-weight: bold;">¡No tienes vehículo!</h3>

        <p style="font-size: 1.1rem; line-height: 1.6;">
            Usted no tiene ningún coche en su garaje, por lo que necesita comprar uno para poder ir al taller.
        </p>

        <a href="{{ route('concesionario') }}"
            style="display: inline-block; margin-top: 20px; background: #1a4a9c; color: white; padding: 12px 25px; border-radius: 5px; text-decoration: none; font-weight: bold; transition: 0.3s;">
            🛒 Ir al Concesionario a comprar uno
        </a>
    </div>

    @else

    {{-- CASO 2: SÍ TIENE COCHES (Mostrar formulario) --}}
    <div class="card"
        style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">

        {{-- Mensajes de error de validación --}}
        @if ($errors->any())
        <div
            style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #f5c6cb;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('citas.store') }}" method="POST">
            @csrf

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="car_id"
                    style="display: block; font-weight: 600; margin-bottom: 8px; color: #444;">Selecciona tu
                    vehículo:</label>
                <select name="car_id" id="car_id" class="form-control"
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;"
                    required>
                    <option value="" disabled selected>-- Elige uno de tus coches --</option>
                    @foreach($misCoches as $coche)
                    <option value="{{ $coche->id }}">
                        {{ $coche->brand->name ?? 'Marca' }} {{ $coche->model }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                <div style="flex: 1;">
                    <label for="fecha"
                        style="display: block; font-weight: 600; margin-bottom: 8px; color: #444;">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" class="form-control"
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;" required
                        min="{{ date('Y-m-d') }}">
                </div>
                <div style="flex: 1;">
                    <label for="hora"
                        style="display: block; font-weight: 600; margin-bottom: 8px; color: #444;">Hora:</label>
                    <input type="time" name="hora" id="hora" class="form-control"
                        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;" required>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label for="descripcion" style="display: block; font-weight: 600; margin-bottom: 8px; color: #444;">¿Qué
                    le pasa al coche?</label>
                <textarea name="descripcion" id="descripcion" rows="4" class="form-control"
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; resize: none;"
                    placeholder="Ej: Hace un ruido raro al frenar..." required></textarea>
            </div>

            <button type="submit"
                style="width: 100%; background: #1a4a9c; color: white; border: none; padding: 15px; font-size: 1.1rem; font-weight: bold; border-radius: 8px; cursor: pointer; transition: background 0.3s;">
                📅 Confirmar Cita
            </button>

        </form>
    </div>
    @endif

</div>

@endsection