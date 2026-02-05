@extends('layouts.layout')

@section('content')

<div class="comparador">

    <h1 class="titulo">Comparador de coches</h1>

    <!-- Sección de coches disponibles -->
    <section class="garage">
        @foreach($coches as $coche)
            <div 
                class="car-card"
                draggable="true"
                data-id="{{ $coche->id }}"
            >
                <img src="{{ $coche->image }}">
                <span>{{ $coche->model }}</span>
            </div>
        @endforeach
    </section>

    <!-- Zona de comparación -->
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
    </section>

</div>

<link rel="stylesheet" href="/css/comparacion.css">
<script src="/js/comparacion.js"></script>

@endsection
