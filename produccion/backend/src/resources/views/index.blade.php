@extends('layouts.layout')

@section('title', 'Inicio | 404 RPM')

@section('content')

<section class="hero-carrusel">
    <div class="slide activa">
        <div class="overlay-oscu"></div>
        <img src="{{ asset('assets/img/fondo.png') }}" alt="Taller 404 RPM" class="bg-slide">
        <div class="contenido-slide">
            <span class="tag">Expertos en Mecánica & Performance</span>
            <h1>Siente la potencia <span class="acento">real</span></h1>
            <p>En 404 RPM cuidamos tu motor con precisión quirúrgica y te ofrecemos los mejores vehículos del mercado.
            </p>
            <div class="actions">
                <a href="{{ url('/cita') }}" class="boton primario">Pedir Cita Taller</a>
                <a href="{{ route('concesionario') }}" class="boton contorno">Ver Coches</a>
            </div>
        </div>
    </div>

    <div class="slide">
        <div class="overlay-oscu"></div>
        <img src="{{ asset('assets/img/ferrari/sf90.png') }}" alt="Ferrari SF90" class="bg-slide">
        <div class="contenido-slide">
            <span class="tag">Novedad en Stock</span>
            <h1>Ferrari SF90 <span class="acento">Stradale</span></h1>
            <p>La bestia hibrida definitiva. V8 turbo, 1000CV y entrega inmediata.</p>
            <div class="actions">
                <a href="{{ route('ficha', 6) }}" class="boton primario">Ver Ficha Técnica</a>
            </div>
        </div>
    </div>

    <div class="slide">
        <div class="overlay-oscu"></div>
        <img src="{{ asset('assets/img/porsche/GT3.png') }}" alt="Porsche 911 GT3" class="bg-slide">
        <div class="contenido-slide">
            <span class="tag">Exclusivo</span>
            <h1>Porsche 911 <span class="acento">GT3</span></h1>
            <p>Pura adrenalina de circuito legalizada para la calle. Unidad certificada.</p>
            <div class="actions">
                <a href="{{ route('concesionario') }}" class="boton primario">Ir al Concesionario</a>
            </div>
        </div>
    </div>

    <button class="flecha-carrusel prev" onclick="moverSlide(-1)">&#10094;</button>
    <button class="flecha-carrusel next" onclick="moverSlide(1)">&#10095;</button>

    <div class="puntos-carrusel">
        <span class="punto activo" onclick="irASlide(0)"></span>
        <span class="punto" onclick="irASlide(1)"></span>
        <span class="punto" onclick="irASlide(2)"></span>
    </div>
</section>

<section class="clima-container">
    <div class="widget-clima-moderno">
        <div class="clima-icono-box">
            <img id="icono-tiempo-img" src="https://cdn-icons-png.flaticon.com/512/1163/1163661.png" alt="Clima">
        </div>
        <div class="clima-info-texto">
            <h3 id="ubicacion-texto">Irun, ES</h3>
            <p id="descripcion-clima" class="clima-desc">Cargando...</p>
            <p id="consejo-clima" class="clima-consejo">Esperando datos...</p>
        </div>
        <div class="clima-temperatura">
            <span id="temp-valor">--</span><span class="grado">°</span>
        </div>
    </div>
</section>

<section class="dashboard-accesos">
    <a href="{{ url('/taller.html') }}" class="card-dashboard">
        <div class="icono-dash">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <path
                    d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z">
                </path>
            </svg>
        </div>
        <div class="texto-dash">
            <h3>Taller & Performance</h3>
            <p>Mantenimiento y potenciación</p>
        </div>
        <div class="flecha-dash">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </div>
    </a>

    <a href="{{ route('concesionario') }}" class="card-dashboard">
        <div class="icono-dash rojo">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <rect x="1" y="3" width="15" height="13"></rect>
                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                <circle cx="18.5" cy="18.5" r="2.5"></circle>
            </svg>
        </div>
        <div class="texto-dash">
            <h3>Stock Premium</h3>
            <p>Ver vehículos disponibles</p>
        </div>
        <div class="flecha-dash">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </div>
    </a>
</section>

<section class="tarjetas-Novedades">
    <div class="Novedades">
        <h2>Novedades en el concesionario</h2>
        <p>En nuestro concesionario, ofrecemos coches de calidad y de última generación.</p>
    </div>

    <div class="galeria-coches">
        <article class="card-coche blanco">
            <img src="{{ asset('assets/img/mercedes/mercedes-amg-A45.png') }}" alt="Mercedes AMG A45">
            <div class="info">
                <h3>Mercedes AMG A45</h3>
                <span class="precio">Desde 67.552€</span>
                <a href="{{ route('ficha', 15) }}" class="btn-ver">Ver ficha →</a>
            </div>
        </article>

        <article class="card-coche blanco">
            <img src="{{ asset('assets/img/bmw/x5-xDrive.png') }}" alt="BMW X5 xDrive">
            <div class="info">
                <h3>BMW X5 xDrive</h3>
                <span class="precio">Desde 105.300€</span>
                <a href="{{ route('ficha', 13) }}" class="btn-ver">Ver ficha →</a>
            </div>
        </article>

        <article class="card-coche blanco">
            <img src="{{ asset('assets/img/ford/mustang-GT.png') }}" alt="Ford Mustang GT">
            <div class="info">
                <h3>Ford Mustang GT</h3>
                <span class="precio">Desde 61.828€</span>
                <a href="{{ route('ficha', 10) }}" class="btn-ver">Ver ficha →</a>
            </div>
        </article>
    </div>
</section>

<section class="seccion-resenas" style="max-width: 1200px; margin: 4rem auto; padding: 0 20px;">
    <h2 style="text-align: center; margin-bottom: 2rem; font-size: 2rem; color: #333;">Lo que dicen nuestros clientes</h2>
    <div id="contenedor-resenas" class="grid-resenas" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
        <p style="text-align:center; width:100%;">Cargando reseñas...</p>
    </div>
</section>

@endsection

@section('scripts')
<script src="{{ asset('js/inicio.js') }}"></script>
@endsection