@extends('layouts.layout')

@section('content')
<div class="comparador-wrapper">
    
    <div class="header-text">
        <h1>Garage VS</h1>
        <p>Arrastra dos vehículos para analizar sus prestaciones</p>
    </div>

    <div class="garage-container">
        <div class="garage-track">
            @foreach($coches as $coche)
                <div class="car-card" draggable="true" data-id="{{ $coche->id }}">
                    <div class="card-img-wrap">
                        <img src="{{ asset($coche->image) }}" alt="{{ $coche->model }}">
                    </div>
                    <div class="card-info">
                        <span class="brand">{{ $coche->brand->name ?? '' }}</span>
                        <span class="model">{{ $coche->model }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="arena">
        
        <div class="drop-zone" id="slotA">
            <div class="empty-state">
                <div class="plus-icon">+</div>
                <p>Arrastra coche 1</p>
            </div>
            <div class="car-content hidden"></div>
        </div>

        <div class="vs-badge">VS</div>

        <div class="drop-zone" id="slotB">
            <div class="empty-state">
                <div class="plus-icon">+</div>
                <p>Arrastra coche 2</p>
            </div>
            <div class="car-content hidden"></div>
        </div>

    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/comparador.css') }}">
<script src="{{ asset('js/comparador.js') }}"></script>
@endsection