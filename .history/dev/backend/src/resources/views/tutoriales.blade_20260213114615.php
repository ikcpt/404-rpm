@extends('layouts.layout')

@section('title', 'Tutoriales de Ayuda')

@section('content')

<style>
    /* =========================
   VARIABLES
========================= */
:root {
    --color-primario: #1e4fa3;
    --color-secundario: #e10600;
    --color-terciario: #0b0e13;
    --color-contraste: #f2f2f2;
    --color-acento: #2e90ff;
    --color-gris-oscuro: #151a23;
}


/* =========================
   FONDO GENERAL
========================= */
body {
    background: linear-gradient(135deg, var(--color-terciario), #0f1624);
    color: var(--color-contraste);
}


/* =========================
   TITULOS
========================= */
h1 {
    font-size: 2.6rem;
    letter-spacing: 1px;
    color: var(--color-contraste);
}

h2 {
    color: var(--color-acento);
    font-weight: 400;
    opacity: 0.9;
}


/* =========================
   CARDS
========================= */
.card {
    background: var(--color-gris-oscuro);
    border-radius: 18px;
    overflow: hidden;
    transition: 0.3s ease;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
}

.card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 40px rgba(0, 0, 0, 0.7);
}


/* =========================
   HEADERS COLORES
========================= */
.card-header {
    padding: 14px;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
    border: none;
}

/* sustituimos colores bootstrap por los tuyos */
.bg-primary {
    background: linear-gradient(45deg, var(--color-primario), var(--color-acento)) !important;
}

.bg-success {
    background: linear-gradient(45deg, var(--color-acento), #1cb5e0) !important;
}

.bg-warning {
    background: linear-gradient(45deg, var(--color-secundario), #ff7b00) !important;
}

.text-white {
    color: var(--color-contraste) !important;
}


/* =========================
   VIDEO
========================= */
video {
    border-radius: 0 0 18px 18px;
    background: #000;
    transition: 0.3s ease;
}

video:hover {
    filter: brightness(1.05);
}


/* =========================
   CONTENEDOR
========================= */
.container {
    max-width: 1200px;
}


/* =========================
   RESPONSIVE
========================= */
@media (max-width: 768px) {
    h1 {
        font-size: 2rem;
    }

    .card {
        margin-bottom: 20px;
    }
}
</style>
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="-bold">Vfwideos tutoriales</h1>
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