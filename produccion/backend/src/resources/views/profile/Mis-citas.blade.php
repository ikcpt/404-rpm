@extends('layouts.layout')

@section('title', 'Mis Citas - ' . Auth::user()->name)

@section('content')

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
            <a href="{{ route('mis-comparaciones') }}"
                style="display: block; padding: 12px; color: #555; text-decoration: none; border-radius: 8px; margin-bottom: 5px; transition: 0.2s;">
                ⚖️ Mis Comparaciones
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