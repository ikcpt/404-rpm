@extends('layouts.layout')

@section('title', 'Perfil - ' . Auth::user()->name)

@section('content')
<main class="contenedor-perfil">

    <aside class="sidebar-perfil">
        <div class="tarjeta-usuario">
            <div class="avatar">
                <span>
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->profile?->surname ?? '', 0, 1)) }}
                </span>
            </div>
            <h2>{{ Auth::user()->name }} {{ Auth::user()->profile?->surname ?? '' }}</h2>
            <p class="email-usuario">{{ Auth::user()->email }}</p>

            @if(Auth::user()->profile)
            <p class="telefono-usuario">Teléfono: {{ Auth::user()->profile->phone }}</p>
            @endif

            <p class="miembro-desde">Miembro desde: {{ Auth::user()->created_at->format('Y') }}</p>

            <nav class="menu-perfil">
                <a href="#" class="activo">🚗 Mi Garaje</a>
                <a href="{{ route('mis-facturas') }}">📄 Mis Facturas</a>
                <a href="{{ route('configuracion') }}">⚙️ Configuración</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        style="background:none; border:none; color: inherit; font: inherit; cursor: pointer; padding: 10px 0;">🚪
                        Cerrar Sesión</button>
                </form>
            </nav>
        </div>
    </aside>

    <section class="contenido-dashboard">

        <div class="widget-alerta">
            <div class="icono-alerta">🔧</div>
            <div class="texto-alerta">
                <h3>Estado del Taller</h3>
                <p>No tienes reparaciones activas en este momento.</p>
            </div>
            <button class="boton contorno">Ver historial</button>
        </div>

        <h2 class="titulo-seccion-perfil" id="garaje">Mis Vehículos</h2>
        <div class="grid-garaje">
            @forelse(Auth::user()->cars as $car)
            <article class="tarjeta-garaje">
                <div class="foto-garaje">
                    @if($car->image)
                    <img src="{{ asset($car->image) }}" alt="{{ $car->brand->name }} {{ $car->model }}"
                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                    @else
                    <div
                        style="width:100%; height:100%; background:#eee; display:flex; align-items:center; justify-content:center; color:#999;">
                        <span style="font-size: 3rem;">🚗</span>
                    </div>
                    @endif
                </div>
                <div class="info-garaje">
                    <h3>{{ $car->brand->name }} {{ $car->model }}</h3>
                    <p class="tipo-motor">{{ $car->type }}</p>

                    @if($car->extras->count() > 0)
                    <p style="font-size: 0.8rem; color: #666; margin-top:5px;">
                        + {{ $car->extras->first()->name }}
                        @if($car->extras->count() > 1) y más... @endif
                    </p>
                    @endif

                    <div class="acciones-garaje">
                        <a href="{{ url('/cita') }}" class="boton-pequeno">Pedir Cita</a>
                        <a href="#" class="enlace-historial">Ver ficha</a>
                    </div>
                </div>
            </article>
            @empty
            <div class="sin-coches">
                <p>No tienes vehículos registrados en tu garaje.</p>
                <a href="{{ route('concesionario') }}" class="boton-destacado"
                    style="margin-top:10px; display:inline-block;">Ir al Concesionario</a>
            </div>
            @endforelse
        </div>

    </section>
</main>
@endsection

@section('scripts')
<script src="{{ asset('js/app.js') }}"></script>
@endsection