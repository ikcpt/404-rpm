<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 RPM - Concesionario y Taller</title>

    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Tarjetas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <header class="encabezado-principal">
        <div class="contenedor-header">
            <a href="/" class="logo">
                <img src="assets/img/logo.jpg" alt="404 RPM Inicio">
            </a>

            <button class="boton-menu" aria-label="Abrir menú">☰</button>

            <nav class="navegacion-principal">
                <ul class="lista-navegacion">
                    <li><a href="/" class="enlace-nav activo">Inicio</a></li>
                    <li><a href="taller.html" class="enlace-nav">Taller</a></li>
                    <li><a href="concesionario.html" class="enlace-nav">Concesionario</a></li>

                    <li>
                        <a href="cita.html" class="enlace-nav boton-destacado">Pedir Cita</a>
                    </li>

                    <li id="menu-guest" style="display: flex; gap: 15px; align-items: center;">
                        <a href="/login" class="enlace-nav">Iniciar Sesión</a>
                        <a href="/register" class="enlace-nav" style="font-weight: 600;">Registrarse</a>
                    </li>

                    <li id="menu-auth" class="item-con-desplegable" style="display: none;">
                        <a href="/perfil" class="enlace-nav enlace-perfil">
                            <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2"
                                fill="none">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span id="user-name">Perfil</span>
                            <svg class="flecha-baja" width="12" height="12" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="3" fill="none">
                                <path d="M6 9l6 6 6-6" />
                            </svg>
                        </a>

                        <ul class="submenu">
                            <li><a href="perfil.html#garaje">🚗 Mi Garaje</a></li>
                            <li><a href="perfil.html#citas">📅 Mis Citas</a></li>
                            <li><a href="perfil.html#facturas">📄 Facturas</a></li>
                            <li><a href="perfil.html#config">⚙️ Configuración</a></li>
                            <li class="separador-menu"></li>
                            <li><a href="#" id="btn-logout" class="cerrar-sesion">🚪 Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>


        <section class="hero-carrusel">

            <div class="slide activa">
                <div class="overlay-oscu"></div>
                <img src="assets/img/fondo.png" alt="Taller 404 RPM" class="bg-slide">

                <div class="contenido-slide">
                    <span class="tag">Expertos en Mecánica & Performance</span>
                    <h1>Siente la potencia <span class="acento">real</span></h1>
                    <p>En 404 RPM cuidamos tu motor con precisión quirúrgica y te ofrecemos los mejores vehículos del
                        mercado.</p>
                    <div class="actions">
                        <a href="cita.html" class="boton primario">Pedir Cita Taller</a>
                        <a href="concesionario.html" class="boton contorno">Ver Coches</a>
                    </div>
                </div>
            </div>

            <div class="slide">
                <div class="overlay-oscu"></div>
                <img src="assets/img/ferrari/sf90.png" alt="Nuevo Ferrari SF90 Stradale" class="bg-slide">

                <div class="contenido-slide">
                    <span class="tag">Novedad en Stock</span>
                    <h1>Ferrari SF90 <span class="acento">Stradale</span></h1>
                    <p>La bestia hibrida definitiva. V8 turbo, 1000CV y entrega inmediata. ¿Te atreves a domarlo?</p>
                    <div class="actions">
                        <a href="concesionario.html" class="boton primario">Ver Ficha Técnica</a>
                    </div>
                </div>
            </div>

            <div class="slide">
                <div class="overlay-oscu"></div>
                <img src="assets/img/porsche/GT3.png" alt="Porsche 911 GT3" class="bg-slide">

                <div class="contenido-slide">
                    <span class="tag">Exclusivo</span>
                    <h1>Porsche 911 <span class="acento">GT3</span></h1>
                    <p>Pura adrenalina de circuito legalizada para la calle. Unidad certificada y con garantía 404 RPM.
                    </p>
                    <div class="actions">
                        <a href="concesionario.html" class="boton primario">Contactar Vendedor</a>
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
                    <img id="icono-tiempo-img" src="https://cdn-icons-png.flaticon.com/512/1163/1163661.png"
                        alt="Clima">
                </div>

                <div class="clima-info-texto">
                    <h3 id="ubicacion-texto">Irun, ES</h3>
                    <p id="descripcion-clima" class="clima-desc">Cargando...</p>

                    <p id="consejo-clima" class="clima-consejo">
                        Esperando datos...
                    </p>
                </div>

                <div class="clima-temperatura">
                    <span id="temp-valor">--</span><span class="grado">°</span>
                </div>

            </div>

        </section>

        <section class="dashboard-accesos">

            <a href="taller.html" class="card-dashboard">
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

            <a href="concesionario.html" class="card-dashboard">
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
                <p>En nuestro concesionario, ofrecemos coches de calidad y de última generación para que pueda disfrutar
                    de un automóvil en perfectas condiciones.</p>
            </div>

            <div class="galeria-coches">
                <article class="tarjeta-coche">
                    <div class="imagen-coche">
                        <img src="assets/img/mercedes/mercedes-amg-A45.png" alt="Mercedes AMG A45">
                    </div>
                    <div class="contenido-tarjeta">
                        <h3>Mercedes AMG A45</h3>
                        <p class="detalles">421 CV • Automático • 2025</p>
                        <div class="precio">Desde 67.552€</div>
                        <a href="#" class="btn-tarjeta novedades-coches" id="Mercedes_AMG_A45"
                            onclick="recogerDatos()">Ver detalles</a>
                    </div>
                </article>
                <article class="tarjeta-coche">
                    <div class="imagen-coche">
                        <img src="assets/img/bmw/x5-xDrive.png" alt="BMW X5 xDrive">
                    </div>
                    <div class="contenido-tarjeta">
                        <h3>BMW X5 xDrive</h3>
                        <p class="detalles">381 CV • Automático • 2024</p>
                        <div class="precio">Desde 105.300€</div>
                        <a href="#" class="btn-tarjeta novedades-coches" id="BMW_X5_xDrive" onclick="recogerDatos()">Ver
                            detalles</a>
                    </div>
                </article>
                <article class="tarjeta-coche">
                    <div class="imagen-coche">
                        <img src="assets/img/ford/mustang-GT.png" alt="Ford Mustang GT">
                    </div>
                    <div class="contenido-tarjeta">
                        <h3>Ford Mustang GT</h3>
                        <p class="detalles">450 CV • Manual • 2025</p>
                        <div class="precio">Desde 61.828€</div>
                        <a href="#" class="btn-tarjeta novedades-coches" id="Ford_Mustang_GT"
                            onclick="recogerDatos()">Ver detalles</a>
                    </div>
                </article>
            </div>
        </section>

        <section class="seccion-resenas" style="max-width: 1200px; margin: 4rem auto; padding: 0 20px;">
            <h2 style="text-align: center; margin-bottom: 2rem; font-size: 2rem; color: #333;">Lo que dicen nuestros
                clientes</h2>

            <div class="grid-resenas"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">

                @foreach($reviews as $review)
                <article class="tarjeta-resena"
                    style="background: #fff; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-top: 4px solid #1e4fa3;">

                    <div class="header-resena"
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <div class="usuario" style="display: flex; align-items: center; gap: 10px;">
                            <div
                                style="width: 40px; height: 40px; background: #eee; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #666;">
                                {{ substr($review->user->name ?? 'A', 0, 1) }}
                            </div>
                            <h3 style="margin: 0; font-size: 1.1rem; color: #333;">
                                {{ $review->user->name ?? 'Cliente Anónimo' }}</h3>
                        </div>

                        <div class="estrellas" style="color: #f1c40f; letter-spacing: 2px;">
                            @for($i = 0; $i < $review->rating; $i++)★@endfor
                                @for($i = $review->rating; $i < 5; $i++)<span style="color: #ddd;">★</span>@endfor
                        </div>
                    </div>

                    <p style="color: #666; line-height: 1.6; font-style: italic; margin-bottom: 1rem;">
                        "{{ $review->content }}"
                    </p>

                    <small style="color: #999; display: block; text-align: right;">
                        {{ $review->created_at->format('d/m/Y') }}
                    </small>
                </article>
                @endforeach

            </div>

            @if($reviews->isEmpty())
            <p style="text-align: center; padding: 2rem; background: #f9f9f9; border-radius: 8px;">Aún no hay reseñas.
                ¡Sé el primero en opinar!</p>
            @endif
        </section>

        <footer class="pie-pagina">
            <div class="contenedor-footer">

                <div class="columna-footer">
                    <h3 class="footer-logo">404 RPM</h3>
                    <p class="footer-texto">
                        Expertos en mecánica y venta de vehículos de alta gama en Irun.
                        Tu coche, nuestra pasión.
                    </p>
                </div>

                <div class="columna-footer">
                    <h4>Navegación</h4>
                    <ul class="enlaces-footer">
                        <li><a href="index.html">Inicio</a></li>
                        <li><a href="taller.html">Taller Mecánico</a></li>
                        <li><a href="concesionario.html">Concesionario</a></li>
                        <li><a href="cita.html">Pedir Cita</a></li>
                    </ul>
                </div>

                <div class="columna-footer">
                    <h4>Contacto</h4>
                    <ul class="info-contacto">
                        <li>
                            <span>📍</span> Calle Motor 404, Irun, Gipuzkoa
                        </li>
                        <li>
                            <span>📞</span> +34 943 00 00 00
                        </li>
                        <li>
                            <span>✉️</span> info@404rpm.com
                        </li>
                    </ul>
                </div>

                <div class="columna-footer">
                    <h4>Síguenos</h4>
                    <div class="redes-sociales">
                        <a href="#" aria-label="Instagram" class="icono-social">
                            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" aria-label="Facebook" class="icono-social">
                            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#" aria-label="Twitter" class="icono-social">
                            <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="barra-copyright">
                <p>&copy; 2026 404 RPM. Todos los derechos reservados.</p>
                <div class="legales">
                    <a href="#">Aviso Legal</a>
                    <a href="#">Privacidad</a>
                </div>
            </div>
        </footer>
    </main>
    <script src="js/app.js"></script>
</body>

</html>