@extends('layouts.layout')

@section('title', 'Mi Garaje | 404 RPM')

@section('content')

<div class="layout-perfil">

    <aside class="sidebar-perfil">
        <div class="nivel-badge">🏆 Nivel: Piloto Experto</div>

        <div class="avatar-container" style="margin-bottom: 15px;">
            <div
                style="width: 90px; height: 90px; background: #1a4a9c; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.2rem; margin: 0 auto; border: 4px solid #f0f4ff;">
                {{ substr($user->name, 0, 2) }}
            </div>
        </div>

        <h3 style="margin: 10px 0 5px; font-weight: 700; color: #333;">{{ $user->name }}</h3>
        <p style="color: #777; font-size: 0.9rem;">{{ $user->email }}</p>

        <div class="puntos-rpm">
            Tienes <strong>1,250 RPM</strong> puntos<br>
            <small style="color: #888;">Canjeables por descuentos</small>
        </div>

        <nav class="menu-lateral" style="text-align: left; margin-top: 30px;">
            <a href="{{ route('perfil') }}"
                style="display: block; padding: 12px; color: #1a4a9c; font-weight: bold; background: #f0f4ff; border-radius: 8px; margin-bottom: 5px;">
                <i class="fa-solid fa-car"></i> Mi Garaje
            </a>
            <a href="{{ route('mis-citas') }}"
                style="display: block; padding: 12px; color: #555; text-decoration: none; transition: 0.3s;">
                <i class="fa-solid fa-calendar"></i> Mis Citas
            </a>
            <a href="{{ route('mis-comparaciones') }}"
                style="display: block; padding: 12px; color: #555; text-decoration: none; transition: 0.3s;">
                <i class="fa-solid fa-code-compare"></i> Comparador
            </a>
            <a href="#" style="display: block; padding: 12px; color: #555; text-decoration: none; transition: 0.3s;">
                <i class="fa-solid fa-gear"></i> Ajustes
            </a>

            <form method="POST" action="{{ route('logout') }}"
                style="margin-top: 20px; border-top: 1px solid #eee; padding-top: 10px;">
                @csrf
                <button type="submit"
                    style="background:none; border:none; color:#d60000; cursor:pointer; padding: 12px; width: 100%; text-align: left;">
                    <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
                </button>
            </form>
        </nav>
    </aside>

    <section class="contenido-perfil">

        @if(session('success'))
        <div
            style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div
            style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
            {{ session('error') }}
        </div>
        @endif

        <h2 style="margin-bottom: 25px; font-size: 1.8rem; color: #333;">Mi Colección</h2>

        @if($user->cars->count() > 0)
        <div class="garage-grid">

            @foreach($user->cars as $car)
            <div class="coche-card" style="{{ $car->status == 'reserved' ? 'border: 2px solid #ffc107;' : '' }}">

                <div class="coche-img-container"
                    style="width: 100%; height: 180px; overflow: hidden; border-radius: 10px 10px 0 0;">
                    <img src="{{ asset($car->image) }}" alt="{{ $car->model }}"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>

                <div class="coche-body" style="padding: 15px;">
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <h3 style="margin:0; font-size: 1.1rem;">{{ $car->brand->name }} {{ $car->model }}</h3>

                        @if($car->status == 'reserved')
                        <span
                            style="background: #ffc107; color: #333; padding: 4px 10px; border-radius: 4px; font-weight:bold; font-size: 0.8rem;">
                            RESERVADO
                        </span>
                        @else
                        <span
                            style="background: #28a745; color: white; padding: 4px 10px; border-radius: 4px; font-weight:bold; font-size: 0.8rem;">
                            EN PROPIEDAD
                        </span>
                        @endif
                    </div>

                    <p style="color: #777; margin-bottom: 15px; font-size: 0.9rem; min-height: 40px;">
                        {{ Str::limit($car->description, 80) }}
                    </p>

                    <div class="specs-row"
                        style="display: flex; gap: 10px; margin-bottom: 15px; font-size: 0.85rem; color: #555;">
                        <span><i class="fa-solid fa-gauge-high"></i> {{ $car->hp }} CV</span>
                        <span><i class="fa-solid fa-gas-pump"></i> {{ $car->fuel }}</span>
                        <span><i class="fa-solid fa-road"></i> {{ number_format($car->km, 0, ',', '.') }} km</span>
                    </div>

                    <div class="coche-actions" style="display: flex; gap: 10px;">
                        @if($car->status == 'reserved')
                        <form action="{{ route('coche.finalizar', $car->id) }}" method="POST" style="flex:1;">
                            @csrf
                            <button type="submit" class="btn-reservar"
                                style="width:100%; background:#28a745; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                                <i class="fa-solid fa-check"></i> Completar Compra
                            </button>
                        </form>
                        @else
                        <a href="{{ route('ficha', $car->id) }}" class="btn-timeline"
                            style="flex: 1; text-align: center; background: #1a4a9c; color: white; padding: 10px; border-radius: 5px; text-decoration: none;">
                            <i class="fa-solid fa-clock-rotate-left"></i> Historial
                        </a>
                        <a href="{{ route('pedir-cita', ['car_id' => $car->id]) }}" class="btn-reservar"
                            style="flex: 1; text-align: center; background: #eee; color: #333; padding: 10px; border-radius: 5px; text-decoration: none;">
                            <i class="fa-solid fa-calendar-check"></i> Taller
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        @else
        <div
            style="text-align: center; padding: 50px; background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            <i class="fa-solid fa-car-side" style="font-size: 4rem; color: #ddd; margin-bottom: 20px;"></i>
            <h3 style="color: #666;">Aún no tienes coches en tu garaje</h3>
            <p style="color: #999; margin-bottom: 25px;">Explora nuestro concesionario y encuentra tu máquina ideal.</p>
            <a href="{{ url('/concesionario') }}" class="btn-primary"
                style="background: #1a4a9c; color: white; padding: 12px 30px; border-radius: 50px; text-decoration: none; font-weight: bold;">Ir
                al Concesionario</a>
        </div>
        @endif

    </section>
</div>

@endsection