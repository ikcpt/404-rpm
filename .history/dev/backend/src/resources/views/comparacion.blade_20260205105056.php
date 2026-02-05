@extends('layouts.layout')

@section('title', 'Comparación de Coches')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/comparacion.css') }}">
@endpush

@section('content')
<div class="comparador">
    <h1 class="titulo">Comparador de Coches</h1>

    <div class="garage">
        @foreach($cars as $car)
        <div class="car-card" draggable="true" data-car-id="{{ $car->id }}">
            <img src="{{ asset($car->image) }}" alt="{{ $car->model }}">
            <span>{{ $car->brand->name }} {{ $car->model }}</span>
        </div>
        @endforeach
    </div>

    <div class="zona-comparacion">
        <table class="tabla-comparativa">
            <thead>
                <tr>
                    <th>Atributo</th>
                    <th class="coche1-slot">Coche 1</th>
                    <th class="coche2-slot">Coche 2</th>
                </tr>
            </thead>
            <tbody>
                <tr data-attr="brand">
                    <td>Marca</td>
                    <td class="coche1"></td>
                    <td class="coche2"></td>
                </tr>
                <tr data-attr="model">
                    <td>Modelo</td>
                    <td class="coche1"></td>
                    <td class="coche2"></td>
                </tr>
                <tr data-attr="hp">
                    <td>Potencia (CV)</td>
                    <td class="coche1"></td>
                    <td class="coche2"></td>
                </tr>
                <tr data-attr="torque">
                    <td>Par (Nm)</td>
                    <td class="coche1"></td>
                    <td class="coche2"></td>
                </tr>
                <tr data-attr="engine_size">
                    <td>Motor</td>
                    <td class="coche1"></td>
                    <td class="coche2"></td>
                </tr>
                <tr data-attr="fuel">
                    <td>Combustible</td>
                    <td class="coche1"></td>
                    <td class="coche2"></td>
                </tr>
                <tr data-attr="transmission">
                    <td>Transmisión</td>
                    <td class="coche1"></td>
                    <td class="coche2"></td>
                </tr>
                <tr data-attr="year">
                    <td>Año</td>
                    <td class="coche1"></td>
                    <td class="coche2"></td>
                </tr>
                <tr data-attr="km">
                    <td>Kilometraje</td>
                    <td class="coche1"></td>
                    <td class="coche2"></td>
                </tr>
                <tr data-attr="weight">
                    <td>Peso (kg)</td>
                    <td class="coche1"></td>
                    <td class="coche2"></td>
                </tr>
                <tr data-attr="price">
                    <td>Precio (€)</td>
                    <td class="coche1"></td>
                    <td class="coche2"></td>
                </tr>
                <tr data-attr="extras">
                    <td>Extras</td>
                    <td class="coche1"></td>
                    <td class="coche2"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/comparacion.js') }}"></script>
@endpush
