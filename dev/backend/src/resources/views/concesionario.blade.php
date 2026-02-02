@extends('layouts.layout')

@section('title', 'Concesionario | 404 RPM')

@section('content')
<div class="banner-busqueda" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.6)), url('{{ asset('assets/img/fondo.png') }}');">
    
    <h1 class="titulo-banner">Encuentra tu <span class="acento-banner">Máquina</span></h1>
    <p class="texto-banner">Busca entre nuestro stock exclusivo</p>

    <form action="{{ route('concesionario') }}" method="GET" class="form-buscador">
        <input type="text" name="search" class="input-buscador" placeholder="Escribe el modelo, marca o versión...">

        <button type="submit" class="btn-buscador">
            BUSCAR
        </button>
    </form>
</div>

<section class="seccion-gama gama-alta">
    <div class="contenedor-seccion">
        <h2 class="titulo-seccion">Alta Gama <span class="acento">Exclusiva</span></h2>

        <div class="grid-coches">
            @foreach($gamaAlta->take(3) as $car)
            <article class="card-coche oscuro">
                <img src="{{ asset($car->image) }}" alt="{{ $car->model }}" />
                <div class="info">
                    <h3>{{ $car->brand->name }} {{ $car->model }}</h3>
                    <span class="precio">{{ number_format($car->price, 0, ',', '.') }}€</span>
                    <a href="{{ route('ficha', $car->id) }}" class="btn-ver">Ver ficha →</a>
                </div>
            </article>
            @endforeach
        </div>

        @if($gamaAlta->count() > 3)
        <div id="extra-alta" style="display: none; margin-top: 20px;">
            <div class="grid-coches">
                @foreach($gamaAlta->skip(3) as $car)
                <article class="card-coche oscuro">
                    <img src="{{ asset($car->image) }}" alt="{{ $car->model }}" />
                    <div class="info">
                        <h3>{{ $car->brand->name }} {{ $car->model }}</h3>
                        <span class="precio">{{ number_format($car->price, 0, ',', '.') }}€</span>
                        <a href="{{ route('ficha', $car->id) }}" class="btn-ver">Ver ficha →</a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        <div style="text-align: center;">
            <button class="btn-desplegar" data-target="#extra-alta" style="color: #d4af37;">Ver colección completa ↓</button>
        </div>
        @endif
    </div>
</section>

<section class="seccion-gama gama-media">
    <div class="contenedor-seccion">
        <h2 class="titulo-seccion">Gama Media</h2>

        <div class="grid-coches">
            @foreach($gamaMedia->take(3) as $car)
            <article class="card-coche claro">
                <img src="{{ asset($car->image) }}" alt="{{ $car->model }}" />
                <div class="info">
                    <h3>{{ $car->brand->name }} {{ $car->model }}</h3>
                    <span class="precio">{{ number_format($car->price, 0, ',', '.') }}€</span>
                    <a href="{{ route('ficha', $car->id) }}" class="btn-ver">Ver ficha →</a>
                </div>
            </article>
            @endforeach
        </div>

        @if($gamaMedia->count() > 3)
        <div id="extra-media" style="display: none; margin-top: 20px;">
            <div class="grid-coches">
                @foreach($gamaMedia->skip(3) as $car)
                <article class="card-coche claro">
                    <img src="{{ asset($car->image) }}" alt="{{ $car->model }}" />
                    <div class="info">
                        <h3>{{ $car->brand->name }} {{ $car->model }}</h3>
                        <span class="precio">{{ number_format($car->price, 0, ',', '.') }}€</span>
                        <a href="{{ route('ficha', $car->id) }}" class="btn-ver">Ver ficha →</a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        <div style="text-align: center;">
            <button class="btn-desplegar" data-target="#extra-media" style="color: #333;">Ver más modelos ↓</button>
        </div>
        @endif
    </div>
</section>

<section class="seccion-gama gama-baja">
    <div class="contenedor-seccion">
        <h2 class="titulo-seccion">Ocasión</h2>

        <div class="grid-coches">
            @foreach($ocasion->take(3) as $car)
            <article class="card-coche blanco">
                <img src="{{ asset($car->image) }}" alt="{{ $car->model }}" />
                <div class="info">
                    <h3>{{ $car->brand->name }} {{ $car->model }}</h3>
                    <span class="precio">{{ number_format($car->price, 0, ',', '.') }}€</span>
                    <a href="{{ route('ficha', $car->id) }}" class="btn-ver">Ver ficha →</a>
                </div>
            </article>
            @endforeach
        </div>

        @if($ocasion->count() > 3)
        <div id="extra-ocasion" style="display: none; margin-top: 20px;">
            <div class="grid-coches">
                @foreach($ocasion->skip(3) as $car)
                <article class="card-coche blanco">
                    <img src="{{ asset($car->image) }}" alt="{{ $car->model }}" />
                    <div class="info">
                        <h3>{{ $car->brand->name }} {{ $car->model }}</h3>
                        <span class="precio">{{ number_format($car->price, 0, ',', '.') }}€</span>
                        <a href="{{ route('ficha', $car->id) }}" class="btn-ver">Ver ficha →</a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        <div style="text-align: center;">
            <button class="btn-desplegar" data-target="#extra-ocasion" style="color: var(--color-primario);">Ver stock completo ↓</button>
        </div>
        @endif
    </div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('js/concesionario.js') }}"></script>
@endsection