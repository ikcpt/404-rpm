@extends('layouts.layout')

@section('title', 'Mis Facturas | 404 RPM')

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
    border-left: 4px solid #1a4a9c;
    padding-left: 10px;
}

/* Estilos de tabla limpios */
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
    border-bottom: 2px solid #eee;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.tabla-facturas td {
    padding: 15px;
    border-bottom: 1px solid #f5f5f5;
    color: #444;
    vertical-align: middle;
    font-size: 0.95rem;
}

.tabla-facturas tr:hover {
    background-color: #fafafa;
}

/* Badges de estado */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.badge-pagado {
    background: #d1e7dd;
    color: #0f5132;
}

.badge-pendiente {
    background: #fff3cd;
    color: #856404;
}

.badge-anulado {
    background: #f8d7da;
    color: #842029;
}

/* Botón de descarga */
.btn-descarga {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #555;
    background: white;
    border: 1px solid #ddd;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-descarga:hover {
    color: #1a4a9c;
    border-color: #1a4a9c;
    background: #f0f4ff;
}

.btn-descarga svg {
    width: 16px;
    height: 16px;
}

@media (max-width: 768px) {
    .layout-perfil {
        grid-template-columns: 1fr;
    }

    .tabla-container {
        overflow-x: auto;
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
                style="display: block; padding: 12px; color: #555; text-decoration: none; border-radius: 8px; margin-bottom: 5px; transition: 0.2s;">
                📅 Mis Citas
            </a>
            <a href="{{ route('mis-facturas') }}"
                style="display: block; padding: 12px; color: #1a4a9c; background: #eef4ff; font-weight: 600; border-radius: 8px; margin-bottom: 5px;">
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
            <h2>Mis Facturas</h2>
            <a href="{{ route('perfil') }}" style="font-size: 0.9rem; color: #777; text-decoration: none;">
                <i class="fa-solid fa-arrow-left"></i> Volver
            </a>
        </div>

        <div class="tabla-container">
            @if($facturas->isEmpty())
            <div style="text-align: center; padding: 50px 20px;">
                <div style="font-size: 2.5rem; color: #eee; margin-bottom: 15px;">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
                <p style="font-size: 1.1rem; color: #666; margin-bottom: 10px;">No tienes facturas disponibles.</p>
            </div>
            @else
            <table class="tabla-facturas">
                <thead>
                    <tr>
                        <th style="width: 15%;">Fecha</th>
                        <th style="width: 40%;">Concepto / Referencia</th>
                        <th style="width: 15%;">Importe</th>
                        <th style="width: 15%;">Estado</th>
                        <th style="width: 15%; text-align: right;">Descargar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($facturas as $factura)
                    <tr>
                        <td style="color: #555;">
                            {{ $factura->created_at->format('d/m/Y') }}
                        </td>

                        <td>
                            <strong
                                style="color: #333; display: block; margin-bottom: 2px;">{{ $factura->concepto }}</strong>
                            <small style="color: #888; font-size: 0.8rem;">Ref:
                                {{ $factura->numero_referencia }}</small>
                        </td>

                        <td style="font-weight: bold; color: #333;">
                            {{ number_format($factura->importe, 2) }} €
                        </td>

                        <td>
                            <span class="badge {{ $factura->estado == 'Pagado' ? 'badge-pagado' : 'badge-pendiente' }}">
                                @if($factura->estado == 'Pagado')
                                <i class="fa-solid fa-check"></i>
                                @else
                                <i class="fa-regular fa-clock"></i>
                                @endif
                                {{ $factura->estado }}
                            </span>
                        </td>

                        <td style="text-align: right;">
                            <a href="#" class="btn-descarga">
                                <i class="fa-solid fa-file-pdf" style="color: #dc3545;"></i> PDF
                            </a>
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