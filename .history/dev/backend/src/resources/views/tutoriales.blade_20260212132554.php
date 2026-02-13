@extends('layouts.layout')

@section('title', 'Tutoriales de Ayuda')

@section('content')

<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Videos tutoriales</h1>
        <h2>Aprende a sacar el máximo partido a nuestra plataforma</p>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center fw-bold">
                    <h3>1. Acceso y Registro</h2>
                </div><br>
                <div class="card-body p-0">
                    <video controls width="100%" poster="" style="display: block;">
                        <source src="{{ asset('assets/video/login.mp4') }}" type="video/mp4">
                        <track src="{{ asset('assets/video/login.vtt') }}" kind="subtitles" srclang="es" label="Español"
                            default>
                        Tu navegador no soporta videos HTML5.
                    </video>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <br>    
                <div class="card-header bg-success text-white text-center fw-bold">
                    <h3>2. El Concesionario</h2>
                </div>
                <div class="card-body p-0">
                    <video controls width="100%" style="display: block;">
                        <source src="{{ asset('assets/video/concesionario.mp4') }}" type="video/mp4">
                        <track src="{{ asset('assets/video/concesionario.vtt') }}" kind="subtitles" srclang="es"
                            label="Español" default>
                    </video>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <br>
                <div class="card-header bg-warning text-dark text-center fw-bold">
                    <h3>3. Comparador de Vehículos</h2>
                </div>
                <div class="card-body p-0">
                    <video controls width="100%" style="display: block;">
                        <source src="{{ asset('assets/video/comparador.mp4') }}" type="video/mp4">
                        <track src="{{ asset('assets/video/comparador.vtt') }}" kind="subtitles" srclang="es"
                            label="Español" default>
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection