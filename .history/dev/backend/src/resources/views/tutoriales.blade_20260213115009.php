@extends('layouts.layout')

@section('title', 'Tutoriales de Ayuda')

@section('content')
<style>
    /* =========================================
   VARIABLES
========================================= */
:root {
    --color-primario: #1e4fa3;
    --color-secundario: #e10600;
    --color-terciario: #0b0e13;
    --color-contraste: #f2f2f2;
    --color-acento: #2e90ff;
    --color-gris-oscuro: #151a23;
}


/* =========================================
   BASE
========================================= */
body {
    background: var(--color-terciario);
    color: var(--color-contraste);
    font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
    margin: 0;
}


/* =========================================
   WRAPPER
========================================= */
.tutoriales-wrapper {
    max-width: 1300px;
    margin: 0 auto;
    padding: 60px 24px;
}


/* =========================================
   HEADER
========================================= */
.tutoriales-header {
    text-align: center;
    margin-bottom: 50px;
}

.tutoriales-header h1 {
    font-size: 2.4rem;
    font-weight: 700;
    margin-bottom: 10px;
}

.tutoriales-header p {
    color: var(--color-acento);
    font-size: 1.1rem;
    opacity: 0.9;
}


/* =========================================
   GRID PRINCIPAL
========================================= */
.tutoriales-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}


/* =========================================
   CARD
========================================= */
.tutorial-card {
    background: var(--color-gris-oscuro);
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.05);
}


/* =========================================
   HEADER CARD
========================================= */
.tutorial-card-header {
    background: var(--color-primario);
    padding: 14px;
    text-align: center;
    font-weight: 600;
    font-size: 1rem;
}


/* =========================================
   VIDEO
========================================= */
.tutorial-video {
    padding: 14px;
}

.tutorial-video video {
    width: 100%;
    aspect-ratio: 16 / 9;
    border-radius: 10px;
    background: #000;
}


/* =========================================
   RESPONSIVE
========================================= */
@media (max-width: 1024px) {
    .tutoriales-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 640px) {
    .tutoriales-grid {
        grid-template-columns: 1fr;
    }

    .tutoriales-wrapper {
        padding: 40px 18px;
    }

    .tutoriales-header h1 {
        font-size: 1.8rem;
    }
}
</style>

<div class="tutoriales-wrapper">

    <header class="tutoriales-header">
        <h1>Vídeos tutoriales</h1>
        <p>Aprende a sacar el máximo partido a nuestra plataforma</p>
    </header>

    <section class="tutoriales-grid">

        <article class="tutorial-card">
            <div class="tutorial-card-header">
                1. Acceso y Registro
            </div>

            <div class="tutorial-video">
                <video controls poster="">
                    <source src="{{ asset('assets/video/login.mp4') }}" type="video/mp4">
                    <track src="{{ asset('assets/video/login.vtt') }}" kind="subtitles" srclang="es" default>
                </video>
            </div>
        </article>


        <article class="tutorial-card">
            <div class="tutorial-card-header">
                2. El Concesionario
            </div>

            <div class="tutorial-video">
                <video controls>
                    <source src="{{ asset('assets/video/concesionario.mp4') }}" type="video/mp4">
                    <track src="{{ asset('assets/video/concesionario.vtt') }}" kind="subtitles" srclang="es" default>
                </video>
            </div>
        </article>


        <article class="tutorial-card">
            <div class="tutorial-card-header">
                3. Comparador de Vehículos
            </div>

            <div class="tutorial-video">
                <video controls>
                    <source src="{{ asset('assets/video/comparador.mp4') }}" type="video/mp4">
                    <track src="{{ asset('assets/video/comparador.vtt') }}" kind="subtitles" srclang="es" default>
                </video>
            </div>
        </article>

    </section>

</div>

@endsection