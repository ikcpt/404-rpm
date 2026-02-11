@extends('layouts.layout')

@section('content')

<div class="comparador">

    <h1 class="titulo">Comparador de coches</h1>
    <div class="brand-filter-wrapper">
        <div class="brand-filter-container">
            <button class="brand-btn active" onclick="filterCars('all', this)">
                Todas
            </button>

            @foreach($brands as $brand)
            <button class="brand-btn" onclick="filterCars({{ $brand->id }}, this)">
                {{ $brand->name }}
            </button>
            @endforeach
        </div>
    </div>

    <!-- Sección de coches disponibles -->
    <section class="garage" id="garage-container">
        @foreach($coches as $coche)
            <div class="car-card" 
                data-id="{{ $coche->id }}"
                data-marca="{{ $coche->brand->name ?? '' }}"
                data-modelo="{{ $coche->model }}"
                data-cv="{{ $coche->hp }}"
                data-year="{{ $coche->year }}"
                data-precio="{{ $coche->price }}">
                
                <img src="{{ $coche->image }}" alt="{{ $coche->model }}">
                <div class="car-info">
                    <span class="car-brand">{{ $coche->brand->name ?? '' }}</span>
                    <span class="car-model">{{ $coche->model }}</span>
                </div>
            </div>
        @endforeach
    </section>
    
    <section class="zona-comparacion">
        <div class="drop-slot" id="slotA">
            <p>Arrastra coche A</p>
            <div class="specs" 
                @if($ultimaComparacion) 
                    data-car-id="{{ $ultimaComparacion->car_a_id }}" 
                @endif
            ></div>
        </div>

        <div class="drop-slot" id="slotB">
            <p>Arrastra coche B</p>
            <div class="specs" 
                @if($ultimaComparacion) 
                    data-car-id="{{ $ultimaComparacion->car_b_id }}" 
                @endif
            ></div>
        </div>
    </section>

    <div class="acciones-comparador">
        <button id="reiniciar-comparacion" class="reiniciar-btn">Reiniciar Comparación</button>
    </div>

</div>

<link rel="stylesheet" href="/css/comparacion.css">
<script src="/js/comparacion.js"></script>

@endsection