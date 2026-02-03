@extends('layouts.layout')

@section('title', 'Mis Facturas | 404 RPM')

@section('content')

<style>
.layout-perfil {
    display: grid;
    grid-template-columns: 300px 1fr;
    /* Sidebar fija | Contenido flexible */
    gap: 30px;
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 20px;
    align-items: start;
}

/* Tarjeta blanca del contenido (igual que la de "Mis Vehículos") */
.card-contenido {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    padding: 30px;
    min-height: 400px;
}

.encabezado-seccion {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f0f0f0;
}

.encabezado-seccion h2 {
    font-size: 1.5rem;
    color: #333;
    margin: 0;
}

/* Estilos de la tabla */
.tabla-facturas {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.tabla-facturas th {
    text-align: left;
    padding: 15px;
    background-color: #f8f9fa;
    color: #666;
    font-weight: 600;
    font-size: 0.9rem;
    border-radius: 8px 8px 0 0;
    /* Bordes redondeados solo arriba */
}

.tabla-facturas td {
    padding: 15px;
    border-bottom: 1px solid #eee;
    color: #444;
    vertical-align: middle;
}

.tabla-facturas tr:last-child td {
    border-bottom: none;
}

/* Estado de la factura (Badge) */
.badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.badge-pagado {
    background-color: #d1e7dd;
    color: #0f5132;
}

.badge-pendiente {
    background-color: #fff3cd;
    color: #856404;
}

/* Botón de descarga */
.btn-descarga {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    text-decoration: none;
    color: #007bff;
    font-weight: 500;
    padding: 6px 12px;
    border-radius: 6px;
    transition: background 0.2s;
}

.btn-descarga:hover {
    background-color: #e7f1ff;
}

/* Responsivo: Si la pantalla es pequeña, una sola columna */
@media (max-width: 768px) {
    .layout-perfil {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="layout-perfil">

    <aside class="sidebar-perfil"
        style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); text-align: center;">
        <div class="avatar-container" style="margin-bottom: 15px;">
            <div
                style="width: 80px; height: 80px; background: #1a4a9c; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto;">
                {{ substr($user->name, 0, 2) }}
            </div>
        </div>
        <h3 style="margin: 10px 0 5px;">{{ $user->name }}</h3>
        <p style="color: #777; font-size: 0.9rem; margin-bottom: 20px;">{{ $user->email }}</p>

        <nav class="menu-lateral" style="text-align: left; margin-top: 30px;">
            <a href="{{ route('perfil') }}#garaje"
                style="display: block; padding: 12px; color: #555; text-decoration: none; border-radius: 8px;">🚗 Mi
                Garaje</a>
            <a href="{{ route('perfil') }}#citas"
                style="display: block; padding: 12px; color: #555; text-decoration: none; border-radius: 8px;">📅 Mis
                Citas</a>

            <a href="{{ route('mis-facturas') }}"
                style="display: block; padding: 12px; color: #1a4a9c; background: #eef4ff; font-weight: 600; text-decoration: none; border-radius: 8px;">📄
                Facturas</a>

            <a href="{{ route('configuracion') }}"
                style="display: block; padding: 12px; color: #555; text-decoration: none; border-radius: 8px;">⚙️
                Configuración</a>

            <div style="margin-top: 20px; border-top: 1px solid #eee; padding-top: 10px;">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        style="background: none; border: none; color: #dc3545; padding: 12px; width: 100%; text-align: left; cursor: pointer;">🚪
                        Cerrar Sesión</button>
                </form>
            </div>
        </nav>
    </aside>

    <main class="card-contenido">
        <div class="encabezado-seccion">
            <h2>Historial de Facturas</h2>
            <a href="{{ route('perfil') }}" style="font-size: 0.9rem; color: #777; text-decoration: none;">← Volver al
                resumen</a>
        </div>

        @if($facturas->isEmpty())
        <div style="text-align: center; padding: 50px 0; color: #777;">
            <div style="font-size: 3rem; margin-bottom: 10px;">🧾</div>
            <p>No tienes facturas disponibles todavía.</p>
            <small>Las facturas de tus reparaciones aparecerán aquí automáticamente.</small>
        </div>
        @else
        <div style="overflow-x: auto;">
            <table class="tabla-facturas">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Concepto / Reparación</th>
                        <th>Importe</th>
                        <th>Estado</th>
                        <th style="text-align: right;">Descarga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($facturas as $factura)
                    <tr>
                        <td>{{ $factura->fecha_emision->format('d/m/Y') }}</td>
                        <td>
                            <strong>{{ $factura->concepto }}</strong><br>
                            <small style="color: #888;">Ref: {{ $factura->numero_referencia }}</small>
                        </td>
                        <td style="font-weight: bold;">{{ number_format($factura->importe, 2) }}€</td>
                        <td>
                            <span class="badge {{ $factura->estado == 'Pagado' ? 'badge-pagado' : 'badge-pendiente' }}">
                                {{ $factura->estado }}
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <a href="{{ route('invoice', $factura->id) }}" class="btn-descarga">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                PDF
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </main>

</div>
@endsection