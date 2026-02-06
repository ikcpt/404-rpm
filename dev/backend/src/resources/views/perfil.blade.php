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
                style="display: block; padding: 12px; color: #1a4a9c; background: #eef4ff; font-weight: 600; border-radius: 8px; margin-bottom: 5px;">
                🚗 Mi Garaje
            </a>
            <a href="{{ route('mis-citas') }}"
                style="display: block; padding: 12px; color: #555; text-decoration: none; border-radius: 8px; margin-bottom: 5px; transition: 0.2s;">
                📅 Mis Citas
            </a>
            <a href="{{ route('mis-facturas') }}"
                style="display: block; padding: 12px; color: #555; text-decoration: none; border-radius: 8px; margin-bottom: 5px; transition: 0.2s;">
                📄 Facturas
            </a>
            <a href="{{ route('configuracion') }}"
                style="display: block; padding: 12px; color: #555; text-decoration: none; border-radius: 8px; transition: 0.2s;">
                ⚙️ Configuración
            </a>

            <div style="margin-top: 20px; border-top: 1px solid #eee; padding-top: 10px;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        style="background: none; border: none; color: #dc3545; padding: 12px; width: 100%; text-align: left; cursor: pointer; font-weight: 500; font-size: 1rem;">
                        🚪 Cerrar Sesión
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <main>

        @if(isset($citaActiva) && $citaActiva && $citaActiva->car)

        @php
        $paso = 1;
        if($citaActiva->estado == 'Confirmada') $paso = 3;
        @endphp

        <div class="tracker-widget">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <h3 style="font-size: 1.1rem; color: #333; margin: 0;">
                    🛠️ Estado del Taller: <strong>{{ $citaActiva->car->brand->name }}
                        {{ $citaActiva->car->model }}</strong>
                </h3>
                <span
                    style="background: #fff3cd; color: #856404; padding: 4px 10px; border-radius: 10px; font-size: 0.8rem; font-weight: bold;">
                    {{ $citaActiva->estado }}
                </span>
            </div>

            <div class="progress-steps">
                <div class="step {{ $paso >= 1 ? 'completed' : '' }}">
                    <div class="step-circle"><i class="fa-solid fa-check"></i></div>
                    <div class="step-label">Recepción</div>
                </div>
                <div class="step {{ $paso >= 2 ? 'completed' : '' }}">
                    <div class="step-circle"><i class="fa-solid fa-check"></i></div>
                    <div class="step-label">Diagnóstico</div>
                </div>
                <div class="step {{ $paso == 3 ? 'active' : '' }}">
                    <div class="step-circle"><i class="fa-solid fa-wrench"></i></div>
                    <div class="step-label">Reparación</div>
                </div>
                <div class="step">
                    <div class="step-circle">4</div>
                    <div class="step-label">Calidad</div>
                </div>
                <div class="step">
                    <div class="step-circle">5</div>
                    <div class="step-label">Listo</div>
                </div>
            </div>

            <p
                style="text-align: center; margin-top: 20px; font-size: 0.9rem; color: #666; background: #fafafa; padding: 10px; border-radius: 8px;">
                Cita programada para el: <strong>{{ $citaActiva->fecha->format('d/m/Y') }}</strong> a las
                <strong>{{ \Carbon\Carbon::parse($citaActiva->hora)->format('H:i') }}h</strong>
            </p>
        </div>

        @endif

        <h2
            style="font-size: 1.5rem; color: #333; margin-bottom: 20px; padding-left: 5px; border-left: 4px solid #1a4a9c;">
            Mi Garaje
        </h2>

        @if($user->cars->isEmpty())

        <div class="empty-state-card">
            <div class="empty-state-icon">
                <i class="fa-solid fa-car-side"></i>
            </div>
            <p class="empty-state-text">
                Aún no tienes ningún vehículo en tu garaje personal.
            </p>
            <a href="{{ route('concesionario') }}" class="btn-explorar">
                <i class="fa-solid fa-plus"></i> Ver Coches Disponibles
            </a>
        </div>

        @else
        @foreach($user->cars as $car)
        <div class="coche-card" style="{{ $car->status == 'reserved' ? 'border: 2px solid #ffc107;' : '' }}">

            <div class="coche-body">
                <div style="display: flex; justify-content: space-between;">
                    <h3>{{ $car->brand->name }} {{ $car->model }}</h3>

                    @if($car->status == 'reserved')
                    <span
                        style="background: #ffc107; color: #333; padding: 2px 8px; border-radius: 4px; font-weight:bold;">
                        RESERVADO
                    </span>
                    @else
                    <span
                        style="background: #28a745; color: white; padding: 2px 8px; border-radius: 4px; font-weight:bold;">
                        EN PROPIEDAD
                    </span>
                    @endif
                </div>

                <div class="coche-actions">
                    @if($car->status == 'reserved')
                    <form action="{{ route('coche.comprar', $car->id) }}" method="POST" style="flex:1;">
                        @csrf
                        <button type="submit" class="btn-reservar" style="width:100%; background:#28a745;">
                            <i class="fa-solid fa-check"></i> Completar Compra
                        </button>
                    </form>
                    @else
                    <a href="{{ route('ficha', $car->id) }}" class="btn-timeline">
                        <i class="fa-solid fa-clock-rotate-left"></i> Historial
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <p style="color: #777; margin-bottom: 10px; font-size: 0.95rem;">
            {{ Str::limit($car->description, 90) }}
        </p>

        <div class="specs-row">
            <div class="spec-item" title="Potencia">
                <i class="fa-solid fa-gauge-high"></i>
                <strong>{{ $car->hp }} CV</strong>
            </div>
            <div class="spec-item" title="Combustible">
                <i class="fa-solid fa-gas-pump"></i>
                <span>{{ $car->fuel }}</span>
            </div>
            <div class="spec-item" title="Transmisión">
                <i class="fa-solid fa-gears"></i>
                <span>{{ substr($car->transmission, 0, 4) }}.</span>
            </div>
            <div class="spec-item" title="Kilometraje">
                <i class="fa-solid fa-road"></i>
                <span>{{ number_format($car->km, 0, ',', '.') }} km</span>
            </div>
        </div>

        <div class="coche-actions">
            <a href="{{ route('ficha', $car->id) }}" class="btn-timeline">
                <i class="fa-solid fa-clock-rotate-left"></i> Historial / Timeline
            </a>

            <a href="{{ route('pedir-cita', $car->id) }}" class="btn-reservar">
                <i class="fa-solid fa-calendar-check"></i> Pedir Cita
            </a>
        </div>
</div>
</div>
@endforeach
@endif

</main>
</div>
@endsection