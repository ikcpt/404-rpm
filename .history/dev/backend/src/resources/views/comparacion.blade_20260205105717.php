@extends('layouts.layout')

@section('title', 'Comparación de Coches')

@section('content')
<div class="comparador-container">
    <h1>Comparación de Coches</h1>

    @if($coches->count() > 0)
    <table class="tabla-comparacion">
        <thead>
            <tr>
                <th>Especificación</th>
                @foreach($coches as $car)
                <th>{{ $car->model }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Marca</td>
                @foreach($coches as $car)
                <td>{{ $car->brand->name }}</td>
                @endforeach
            </tr>
            <tr>
                <td>Potencia (HP)</td>
                @foreach($coches as $car)
                <td>{{ $car->hp }}</td>
                @endforeach
            </tr>
            <tr>
                <td>Par (Nm)</td>
                @foreach($coches as $car)
                <td>{{ $car->torque }}</td>
                @endforeach
            </tr>
            <tr>
                <td>Año</td>
                @foreach($coches as $car)
                <td>{{ $car->year }}</td>
                @endforeach
            </tr>
            <tr>
                <td>Kilómetros</td>
                @foreach($coches as $car)
                <td>{{ $car->km }}</td>
                @endforeach
            </tr>
            <tr>
                <td>Motor</td>
                @foreach($coches as $car)
                <td>{{ $car->engine_size }}</td>
                @endforeach
            </tr>
            <tr>
                <td>Transmisión</td>
                @foreach($coches as $car)
                <td>{{ $car->transmission }}</td>
                @endforeach
            </tr>
            <tr>
                <td>Combustible</td>
                @foreach($coches as $car)
                <td>{{ $car->fuel }}</td>
                @endforeach
            </tr>
            <tr>
                <td>Extras</td>
                @foreach($coches as $car)
                <td>
                    @foreach($car->extras as $extra)
                        {{ $extra->name }}@if(!$loop->last), @endif
                    @endforeach
                </td>
                @endforeach
            </tr>
            <tr>
                <td>Precio (€)</td>
                @foreach($coches as $car)
                <td>{{ number_format($car->price, 0, ',', '.') }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>
    @else
        <p>No hay coches disponibles para comparar.</p>
    @endif
</div>
@endsection
