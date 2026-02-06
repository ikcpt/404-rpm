@extends('layouts.layout')

@section('title', $brand->name . ' | Stock Disponible')

@section('content')

@if($brand->cars->count() > 0)
    <div class="grid-coches">
        @foreach($brand->cars as $car)
            <article class="card-coche oscuro">
                <img src="{{ asset($car->image) }}" alt="{{ $car->model }}">
                <div class="info">
                    <h3>{{ $brand->name }} {{ $car->model }}</h3>
                    <span class="precio">{{ number_format($car->price, 0, ',', '.') }}€</span>
                    
                    <a href="{{ route('ficha', $car->id) }}" class="btn-ver">Ver ficha →</a>
                </div>
            </article>
        @endforeach
    </div>
@else
    <div style="text-align: center; padding: 50px; background: #f9f9f9; border-radius: 10px;">
        <h3 style="color: #666;">Actualmente no hay stock disponible de {{ $brand->name }}</h3>
        <p>Vuelve pronto para ver las novedades.</p>
        <a href="{{ route('concesionario') }}" class="btn-ver" style="background: var(--color-primario); display: inline-block; width: auto; margin-top: 20px;">Ver otras marcas</a>
    </div>
@endif

</div>
@endsection