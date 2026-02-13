@extends('layouts.layout')

@section('title', 'Tutoriales de Ayuda')

@section('content')
<link rel="stylesheet" href="{{ asset('css/videos.css') }}">

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