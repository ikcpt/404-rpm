@extends('layouts.layout')

@section('content')
<div class="comparador">
    <header class="titulo-container">
        <h1 class="titulo">Showroom Comparison</h1>
        <p style="color: var(--text-muted); text-align: center;">Selecciona y arrastra los vehículos para analizar sus prestaciones</p>
    </header>

    <section class="garage">
        @foreach($coches as $coche)
            <div class="car-card" draggable="true" data-id="{{ $coche->id }}">
                <img src="{{ $coche->image }}" alt="{{ $coche->model }}">
                <span>{{ $coche->model }}</span>
                <small style="color: var(--primary)">{{ $coche->brand->name ?? '' }}</small>
            </div>
        @endforeach
    </section>

    <section class="zona-comparacion">
        <div class="drop-slot" id="slotA">
            <div class="empty-state">
                <div class="icon-plus">+</div>
                <p>Arrastra el primer vehículo</p>
            </div>
            <div class="specs-container" style="display:none;"></div>
        </div>

        <div class="vs">VS</div>

        <div class="drop-slot" id="slotB">
            <div class="empty-state">
                <div class="icon-plus">+</div>
                <p>Arrastra el segundo vehículo</p>
            </div>
            <div class="specs-container" style="display:none;"></div>
        </div>
    </section>
</div>
@endsection