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
        <div class="car-card" draggable="true" data-id="{{ $coche->id }}" data-brand-id="{{ $coche->brand_id }}"> <img
                src="{{ $coche->image }}" alt="{{ $coche->model }}">
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
            <div class="specs"></div>
        </div>

        <div class="vs">VS</div>

        <div class="drop-slot" id="slotB">
            <p>Arrastra coche B</p>
            <div class="specs"></div>
        </div>

  <!-- Botón para reiniciar -->
    <button id="reiniciar-comparacion" class="reiniciar-btn">Reiniciar Comparación</button>
    <button id="btnComparar" disabled>Comparar coches</button>

    </section>
    <div class="acciones-comparador">
        <button id="reiniciar-comparacion" class="reiniciar-btn">Reiniciar Comparación</button>
    </div>

</div>

<link rel="stylesheet" href="/css/comparacion.css">
<script src="/js/comparacion.js"></script>

@endsection