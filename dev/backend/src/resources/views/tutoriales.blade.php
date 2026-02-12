@extends('layouts.layout')

@section('title', 'Tutoriales de Ayuda')

@section('content')

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">🎓 Centro de Ayuda</h1>
        <p class="text-muted">Aprende a sacar el máximo partido a nuestra plataforma</p>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center fw-bold">
                    1. Acceso y Registro
                </div>
                <div class="card-body p-0">
                    <video controls width="100%" poster="" style="display: block;">
                        <source src="{{ asset('assets/video/login.mp4') }}" type="video/mp4">
                        <track src="{{ asset('assets/video/login.vtt') }}" kind="subtitles" srclang="es" label="Español"
                            default>
                        Tu navegador no soporta videos HTML5.
                    </video>
                </div>
                <div class="card-body">
                    <p class="card-text small text-muted">Descubre cómo crear tu cuenta de usuario, iniciar sesión y
                        recuperar tu contraseña si la has olvidado.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-success text-white text-center fw-bold">
                    2. El Concesionario
                </div>
                <div class="card-body p-0">
                    <video controls width="100%" style="display: block;">
                        <source src="{{ asset('assets/video/concesionario.mp4') }}" type="video/mp4">
                        <track src="{{ asset('assets/video/concesionario.vtt') }}" kind="subtitles" srclang="es"
                            label="Español" default>
                    </video>
                </div>
                <div class="card-body">
                    <p class="card-text small text-muted">Aprende a utilizar los filtros de búsqueda para encontrar el
                        coche de tus sueños entre nuestro stock.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-warning text-dark text-center fw-bold">
                    3. Comparador de Vehículos
                </div>
                <div class="card-body p-0">
                    <video controls width="100%" style="display: block;">
                        <source src="{{ asset('assets/video/comparador.mp4') }}" type="video/mp4">
                        <track src="{{ asset('assets/video/comparador.vtt') }}" kind="subtitles" srclang="es"
                            label="Español" default>
                    </video>
                </div>
                <div class="card-body">
                    <p class="card-text small text-muted">¿Dudas entre dos modelos? Mira cómo funciona nuestra
                        herramienta de comparación interactiva.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection