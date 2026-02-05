@extends('layouts.layout')

@section('title', 'Mis Citas - ' . Auth::user()->name)

@section('content')

<style>
/* --- 1. LAYOUT GENERAL --- */
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

/* --- 3. CONTENIDO Y TABLA --- */
.card-contenido {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    padding: 30px;
    min-height: 400px;
}

/* CABECERA CON BOTÓN DE ACCIÓN */
.encabezado-seccion {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f0f0;
}

.titulo-wrapper {
    display: flex;
    align-items: center;
    gap: 15px;
}

.encabezado-seccion h2 {
    font-size: 1.5rem;
    color: #333;
    margin: 0;
    border-left: 4px solid #1a4a9c;
    padding-left: 10px;
}

/* NUEVO BOTÓN: PEDIR CITA */
.btn-nueva-cita {
    background: #1a4a9c;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.95rem;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s, transform 0.2s;
    box-shadow: 0 2px 5px rgba(26, 74, 156, 0.2);
}

.btn-nueva-cita:hover {
    background: #133a7a;
    transform: translateY(-2px);
}

.btn-volver-movil {
    display: none;
    /* Oculto en PC */
    font-size: 1.2rem;
    color: #777;
}

/* Estilos de Tabla */
.tabla-citas {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.tabla-citas th {
    text-align: left;
    padding: 15px;
    background-color: #f8f9fa;
    color: #666;
    font-weight: 600;
    font-size: 0.9rem;
    border-bottom: 2px solid #eee;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.tabla-citas td {
    padding: 15px;
    border-bottom: 1px solid #f5f5f5;
    color: #444;
    vertical-align: middle;
    font-size: 0.95rem;
}

.tabla-citas tr:hover {
    background-color: #fafafa;
}

/* Badges */
.estado-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.estado-confirmada {
    background: #d1e7dd;
    color: #0f5132;
}

.estado-pendiente {
    background: #fff3cd;
    color: #856404;
}

.estado-finalizada {
    background: #e2e3e5;
    color: #41464b;
}

.estado-cancelada {
    background: #f8d7da;
    color: #842029;
}

.link-coche {
    color: #1a4a9c;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.2s;
}

.link-coche:hover {
    color: #dc3545;
    text-decoration: underline;
}

.btn-cancelar {
    border: 1px solid #dc3545;
    background: white;
    color: #dc3545;
    padding: 6px 12px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.2s;
}

.btn-cancelar:hover {
    background: #dc3545;
    color: white;
}

@media (max-width: 768px) {
    .layout-perfil {
        grid-template-columns: 1fr;
    }

    .tabla-container {
        overflow-x: auto;
    }

    .encabezado-seccion h2 {
        font-size: 1.2rem;
    }

    .btn-volver-movil {
        display: block;
        margin-right: 10px;
    }

    .btn-nueva-cita span {
        display: none;
    }

    /* En móvil solo icono + */
    .btn-nueva-cita {
        padding: 10px;
    }
}
</style>

<div class="layout-perfil">

    <aside class="sidebar-perfil">
        <div class="nivel-badge">🏆 Nivel: Piloto Experto</div>

        <div class="avatar-container" style="margin-bottom: 15px;">
            <div
                style="width: 90px; height: 90px; background: #1a4a9c; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2.2rem; margin: 0 auto; border: 4px solid #f0f4ff;">
                {{ substr(Auth::user()->name, 0, 2) }}
            </div>
        </div>

        <h3 style="margin: 10px 0 5px; font-weight: 700; color: #333;">{{ Auth::user()->name }}</h3>
        <p style="color: #777; font-size: 0.9rem;">{{ Auth::user()->email }}</p>

        <div class="puntos-rpm">
            Tienes <strong>1,250 RPM</strong> puntos<br>
            <small style="color: #888;">Canjeables por descuentos</small>
        </div>

        <nav class="menu-lateral" style="text-align: left; margin-top: 30px;">
            <a href="{{ route('perfil') }}"
                style="display: block; padding: 12px; color: #555; text-decoration: none; border-radius: 8px; margin-bottom: 5px; transition: 0.2s;">
                🚗 Mi Garaje
            </a>
            <a href="{{ route('mis-citas') }}"
                style="display: block; padding: 12px; color: #1a4a9c; background: #eef4ff; font-weight: 600; border-radius: 8px; margin-bottom: 5px;">
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

    <main class="card-contenido">

        <div class="encabezado-seccion">
            <div class="titulo-wrapper">
                <a href="{{ route('perfil') }}" class="btn-volver-movil"><i class="fa-solid fa-arrow-left"></i></a>
                <h2>Mis Citas y Reservas</h2>
            </div>

            <a href="{{ url('/cita') }}" class="btn-nueva-cita">
                <i class="fa-solid fa-plus"></i> <span>Pedir Nueva Cita</span>
            </a>
        </div>

        <div class="tabla-container">
            <table class="tabla-citas">
                <thead>
                    <tr>
                        <th style="width: 20%;">Fecha / Hora</th>
                        <th style="width: 15%;">Tipo</th>
                        <th style="width: 30%;">Vehículo</th>
                        <th style="width: 20%;">Estado</th>
                        <th style="width: 15%; text-align: right;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($citas as $cita)
                    <tr>
                        <td>
                            <div style="font-weight: bold; color: #333;">{{ $cita->fecha->format('d/m/Y') }}</div>
                            <div style="font-size: 0.85rem; color: #888;">
                                <i class="fa-regular fa-clock"></i>
                                {{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }}h
                            </div>
                        </td>
                        <td>
                            <span
                                style="background: #e7f1ff; color: #0d6efd; padding: 4px 10px; border-radius: 6px; font-size: 0.85rem; font-weight: 500;">
                                {{ $cita->tipo }}
                            </span>
                        </td>
                        <td>
                            @if($cita->car)
                            <a href="{{ route('ficha', $cita->car->id) }}" class="link-coche">
                                {{ $cita->car->brand->name }} {{ $cita->car->model }}
                            </a>
                            @else
                            <span style="color: #aaa; font-style: italic;">No especificado</span>
                            @endif
                        </td>
                        <td>
                            @if($cita->estado === 'Confirmada')
                            <span class="estado-badge estado-confirmada">🟢 Confirmada</span>
                            @elseif($cita->estado === 'Pendiente')
                            <span class="estado-badge estado-pendiente">🟡 Pendiente</span>
                            @elseif($cita->estado === 'Finalizada')
                            <span class="estado-badge estado-finalizada">🏁 Finalizada</span>
                            @else
                            <span class="estado-badge estado-cancelada">🔴 Cancelada</span>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            @if($cita->estado !== 'Finalizada' && $cita->estado !== 'Cancelada')
                            <button class="btn-cancelar">Cancelar</button>
                            @else
                            <span style="color: #ccc; font-size: 1.2rem;">&times;</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 50px 20px;">
                            <div style="font-size: 2rem; color: #eee; margin-bottom: 15px;">
                                <i class="fa-regular fa-calendar-plus"></i>
                            </div>
                            <p style="font-size: 1.1rem; color: #666; margin-bottom: 10px;">No tienes citas programadas.
                            </p>
                            <a href="{{ url('/cita') }}"
                                style="color: #1a4a9c; text-decoration: underline; font-weight: 600;">
                                ¡Pide tu primera cita ahora!
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection