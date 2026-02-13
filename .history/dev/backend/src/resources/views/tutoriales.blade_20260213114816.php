@extends('layouts.layout')

@section('title', 'Tutoriales de Ayuda')

@section('content')

<style>
/* =====================================
   VARIABLES
===================================== */
:root {
    --color-primario: #1e4fa3;
    --color-secundario: #e10600;
    --color-terciario: #0b0e13;
    --color-contraste: #f2f2f2;
    --color-acento: #2e90ff;
    --color-gris-oscuro: #151a23;
}


/* =====================================
   BASE GENERAL
===================================== */
body {
    background-color: var(--color-terciario);
    color: var(--color-contraste);
    font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
}


/* =====================================
   CONTENEDOR PRINCIPAL
===================================== */
.container {
    max-width: 1200px;
}


/* =====================================
   TITULOS
===================================== */
h1 {
    font-weight: 700;
    color: var(--color-contraste);
    margin-bottom: 10px;
}

h2 {
    font-size: 1.2rem;
    font-weight: 400;
    color: var(--color-acento);
    opacity: 0.9;
}


/* =====================================
   CARDS
===================================== */
.card {
    background-color: var(--color-gris-oscuro);
    border-radius: 14px;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.shadow-sm {
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35) !important;
}


/* =====================================
   CABECERAS (sobrescribimos bootstrap)
===================================== */
.card-header {
    border: none;
    padding: 14px;
    font-weight: 600;
    text-align: center;
}

/* Reemplazamos colores bootstrap por los tuyos */
.bg-primary {
    background-color: var(--color-primario) !important;
}

.bg-success {
    background-color: var(--color-acento) !important;
}

.bg-warning {
    background-color: var(--color-secundario) !important;
}

.text-white {
    color: var(--color-contraste) !important;
}

.text-dark {
    color: #111 !important;
}


/* =====================================
   VIDEO
===================================== */
.card-body {
    background-color: #000;
    padding: 0;
}

video {
    display: block;
    width: 100%;
    border-radius: 0 0 14px 14px;
}


/* =====================================
   ESPACIADO GRID
===================================== */
.row {
    row-gap: 20px;
}


/* =====================================
   RESPONSIVE
===================================== */
@media (max-width: 992px) {
    h1 {
        font-size: 1.8rem;
    }

    h2 {
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .container {
        padding-left: 18px;
        padding-right: 18px;
    }
}

/* =====================================
   VARIABLES
===================================== */
:root {
    --color-primario: #1e4fa3;
    --color-secundario: #e10600;
    --color-terciario: #0b0e13;
    --color-contraste: #f2f2f2;
    --color-acento: #2e90ff;
    --color-gris-oscuro: #151a23;
}


/* =====================================
   BASE GENERAL
===================================== */
body {
    background-color: var(--color-terciario);
    color: var(--color-contraste);
    font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
}


/* =====================================
   CONTENEDOR PRINCIPAL
===================================== */
.container {
    max-width: 1200px;
}


/* =====================================
   TITULOS
===================================== */
h1 {
    font-weight: 700;
    color: var(--color-contraste);
    margin-bottom: 10px;
}

h2 {
    font-size: 1.2rem;
    font-weight: 400;
    color: var(--color-acento);
    opacity: 0.9;
}


/* =====================================
   CARDS
===================================== */
.card {
    background-color: var(--color-gris-oscuro);
    border-radius: 14px;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.shadow-sm {
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.35) !important;
}


/* =====================================
   CABECERAS (sobrescribimos bootstrap)
===================================== */
.card-header {
    border: none;
    padding: 14px;
    font-weight: 600;
    text-align: center;
}

/* Reemplazamos colores bootstrap por los tuyos */
.bg-primary {
    background-color: var(--color-primario) !important;
}

.bg-success {
    background-color: var(--color-acento) !important;
}

.bg-warning {
    background-color: var(--color-secundario) !important;
}

.text-white {
    color: var(--color-contraste) !important;
}

.text-dark {
    color: #111 !important;
}


/* =====================================
   VIDEO
===================================== */
.card-body {
    background-color: #000;
    padding: 0;
}

video {
    display: block;
    width: 100%;
    border-radius: 0 0 14px 14px;
}


/* =====================================
   ESPACIADO GRID
===================================== */
.row {
    row-gap: 20px;
}


/* =====================================
   RESPONSIVE
===================================== */
@media (max-width: 992px) {
    h1 {
        font-size: 1.8rem;
    }

    h2 {
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .container {
        padding-left: 18px;
        padding-right: 18px;
    }
}
</style>
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