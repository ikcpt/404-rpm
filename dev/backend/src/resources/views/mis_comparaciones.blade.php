@extends('layouts.layout')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/mis_comparaciones.css') }}">
@endpush
@section('title', 'Mis Comparaciones | 404 RPM')

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
                style="display: block; padding: 12px; color: #555; text-decoration: none; border-radius: 8px; margin-bottom: 5px; transition: 0.2s;">
                📅 Mis Citas
            </a>
            <a href="{{ route('mis-facturas') }}"
                style="display: block; padding: 12px; color: #555; text-decoration: none; border-radius: 8px; margin-bottom: 5px; transition: 0.2s;">
                📄 Facturas
            </a>
            <a href="{{ route('mis-comparaciones') }}"
                style="display: block; padding: 12px; color: #1a4a9c; background: #eef4ff; font-weight: 600; border-radius: 8px; margin-bottom: 5px; transition: 0.2s;">
                ⚖️ Mis Comparaciones
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
            <h2>Mis Comparaciones</h2>
            <a href="{{ route('perfil') }}" style="font-size: 0.9rem; color: #777; text-decoration: none;">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>
        </div>

        <div class="tabla-container">
            @if($comparaciones->isEmpty())
            <div class="empty-state">
                <div style="font-size: 2.5rem; color: #eee; margin-bottom: 15px;">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
                <p>No has hecho ninguna comparación todavía.</p>
                <a href="{{ route('comparacion') }}" class="btn-primary">Empezar a comparar</a>
            </div>
            @else
            <table class="tabla-facturas">
                <thead>
                    <tr>
                        <th style="width: 40%;">Coche A</th>
                        <th style="width: 40%;">Coche B</th>
                        <th style="width: 20%;">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comparaciones as $c)
                    <tr>
                        <td style="font-weight: 600; color: #333;">
                            {{ $c->carA->brand->name }} {{ $c->carA->model }}
                        </td>
                        <td style="font-weight: 600; color: #333;">
                            {{ $c->carB->brand->name }} {{ $c->carB->model }}
                        </td>
                        <td style="color: #555;">
                            {{ $c->created_at->format('d/m/Y H:i') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </main>
</div>
@endsection