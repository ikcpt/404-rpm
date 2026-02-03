@extends('layouts.layout')

@section('title', 'Mi Garaje | 404 RPM')

@section('content')

<style>
/* --- 1. LAYOUT GENERAL (Igual que Citas y Facturas) --- */
.layout-perfil {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 30px;
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
    align-items: start;
}

/* --- 2. SIDEBAR GAMIFICADA --- */
.sidebar-perfil {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    text-align: center;
    /* Hacemos que la sidebar se quede fija al hacer scroll */
    position: sticky;
    top: 20px;
}

.nivel-badge {
    background: linear-gradient(135deg, #1a4a9c, #0d2e6b);
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: bold;
    display: inline-block;
    margin-bottom: 15px;
    box-shadow: 0 4px 10px rgba(26, 74, 156, 0.3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.puntos-rpm {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    padding: 12px;
    border-radius: 10px;
    margin-top: 20px;
    font-size: 0.9rem;
    color: #555;
}

.puntos-rpm strong {
    color: #dc3545;
    font-size: 1.2rem;
}

/* --- 3. WIDGET: TRACKER DE TALLER --- */
.tracker-widget {
    background: white;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
    border-left: 5px solid #ffc107;
    /* Borde amarillo = En proceso */
    position: relative;
    overflow: hidden;
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
    position: relative;
}

/* Línea gris de fondo que conecta los pasos */
.progress-steps::before {
    content: '';
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
    height: 3px;
    background: #e9ecef;
    z-index: 1;
}

.step {
    position: relative;
    z-index: 2;
    text-align: center;
    width: 20%;
}

.step-circle {
    width: 32px;
    height: 32px;
    background: #e9ecef;
    border-radius: 50%;
    margin: 0 auto 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    color: white;
    font-weight: bold;
    transition: all 0.3s ease;
    border: 2px solid white;
    /* Borde blanco para separar de la línea */
}

/* Colores según estado */
.step.completed .step-circle {
    background: #28a745;
    box-shadow: 0 0 0 2px #d4edda;
}

.step.active .step-circle {
    background: #ffc107;
    transform: scale(1.2);
    box-shadow: 0 0 15px rgba(255, 193, 7, 0.5);
}

.step-label {
    font-size: 0.75rem;
    color: #999;
    font-weight: 600;
    text-transform: uppercase;
    transition: color 0.3s;
}

.step.active .step-label {
    color: #333;
}

.step.completed .step-label {
    color: #28a745;
}

/* --- 4. GRID DE AVISOS (PREDICTIVO) --- */
.avisos-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 30px;
}

.aviso-card {
    background: #fff3cd;
    border: 1px solid #ffeeba;
    color: #856404;
    padding: 15px 20px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: transform 0.2s;
}

.aviso-card:hover {
    transform: translateY(-2px);
}

.aviso-icono {
    width: 45px;
    height: 45px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

/* --- 5. TARJETAS DE COCHES (GARAJE) --- */
.coche-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    margin-bottom: 30px;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
}

.coche-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.coche-header {
    height: 220px;
    background-color: #eee;
    background-size: cover;
    background-position: center;
    position: relative;
}

/* Etiqueta del año flotante */
.year-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    backdrop-filter: blur(5px);
}

.coche-body {
    padding: 25px;
}

.coche-titulo {
    font-size: 1.5rem;
    font-weight: 800;
    color: #222;
    margin-bottom: 5px;
}

/* Iconos de especificaciones */
.specs-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    margin: 20px 0;
    padding: 15px 0;
    border-top: 1px solid #f0f0f0;
    border-bottom: 1px solid #f0f0f0;
}

.spec-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
    font-size: 0.85rem;
    color: #555;
    text-align: center;
}

.spec-item i {
    color: #dc3545;
    font-size: 1.1rem;
    margin-bottom: 3px;
}

.coche-actions {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.btn-timeline {
    flex: 1;
    background: #f8f9fa;
    color: #333;
    border: 1px solid #ddd;
    padding: 12px;
    border-radius: 8px;
    text-align: center;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-timeline:hover {
    background: #e2e6ea;
    border-color: #ccc;
}

.btn-reservar {
    flex: 1;
    background: #1a4a9c;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 8px;
    text-align: center;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-reservar:hover {
    background: #133a7a;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .layout-perfil {
        grid-template-columns: 1fr;
    }

    .avisos-grid {
        grid-template-columns: 1fr;
    }

    .specs-row {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .sidebar-perfil {
        position: static;
    }
}
</style>

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

        <div class="tracker-widget">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <h3 style="font-size: 1.1rem; color: #333; margin: 0;">
                    🛠️ Estado del Taller: <strong>Audi R8 V10</strong>
                </h3>
                <span
                    style="background: #fff3cd; color: #856404; padding: 4px 10px; border-radius: 10px; font-size: 0.8rem; font-weight: bold;">
                    En Proceso
                </span>
            </div>

            <div class="progress-steps">
                <div class="step completed">
                    <div class="step-circle"><i class="fa-solid fa-check"></i></div>
                    <div class="step-label">Recepción</div>
                </div>
                <div class="step completed">
                    <div class="step-circle"><i class="fa-solid fa-check"></i></div>
                    <div class="step-label">Diagnóstico</div>
                </div>
                <div class="step active">
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
                Técnico asignado: <strong>Carlos M.</strong> | Entrega estimada: <strong>Mañana, 18:00h</strong>
            </p>
        </div>

        <div class="avisos-grid">
            <div class="aviso-card">
                <div class="aviso-icono" style="color: #856404; background: rgba(133, 100, 4, 0.1);">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <strong style="display:block; margin-bottom:2px;">Seguro Ford Puma</strong>
                    <small>Caduca en 15 días. ¿Renovamos?</small>
                </div>
            </div>
            <div class="aviso-card" style="background: #d1e7dd; border-color: #badbcc; color: #0f5132;">
                <div class="aviso-icono" style="color: #0f5132; background: rgba(15, 81, 50, 0.1);">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div>
                    <strong style="display:block; margin-bottom:2px;">ITV Porsche 911</strong>
                    <small>Válida hasta Marzo 2027.</small>
                </div>
            </div>
        </div>

        <h2
            style="font-size: 1.5rem; color: #333; margin-bottom: 20px; padding-left: 5px; border-left: 4px solid #1a4a9c;">
            Mi Garaje
        </h2>

        @if($user->cars->isEmpty())
        <div class="bg-white p-8 rounded-lg shadow text-center" style="border: 2px dashed #ddd;">
            <div style="font-size: 3rem; color: #ddd; margin-bottom: 10px;"><i class="fa-solid fa-car-side"></i></div>
            <p class="text-gray-500 mb-4">No tienes vehículos registrados en tu garaje.</p>
            <a href="{{ route('concesionario') }}" class="text-red-600 font-bold hover:underline">Ver Coches
                Disponibles</a>
        </div>
        @else
        @foreach($user->cars as $car)
        <div class="coche-card" id="coche-{{ $car->id }}">
            <div class="coche-header"
                style="background-image: url('{{ asset($car->image ?? 'assets/img/placeholder.jpg') }}');">
                <div class="year-badge">{{ $car->year }}</div>
            </div>

            <div class="coche-body">
                <div style="display: flex; justify-content: space-between; align-items: start;">
                    <h3 class="coche-titulo">{{ $car->brand->name }} {{ $car->model }}</h3>
                    <span
                        style="background: #eee; padding: 2px 8px; border-radius: 4px; font-size: 0.8rem; color: #666;">
                        {{ $car->type }}
                    </span>
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

                    <a href="{{ route('mis-citas') }}" class="btn-reservar">
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