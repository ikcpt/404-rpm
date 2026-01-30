<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - {{ Auth::user()->name }}</title>
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
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('assets/img/logo.jpg') }}" alt="404 RPM Inicio">
            </a>

            <button class="boton-menu" aria-label="Abrir menú">☰</button>

            <nav class="navegacion-principal">
                <ul class="lista-navegacion">
                    <li><a href="/" class="enlace-nav">Inicio</a></li>
                    <li><a href="taller.html" class="enlace-nav">Taller</a></li>
                    <li><a href="concesionario.html" class="enlace-nav">Concesionario</a></li>

                    <li>
                        <a href="cita.html" class="enlace-nav boton-destacado">Pedir Cita</a>
                    </li>

                    @guest
                    <li>
                        <a href="{{ route('login') }}" class="enlace-nav">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="enlace-nav" style="font-weight: 600;">Registrarse</a>
                    </li>
                    @endguest

                    @auth
                    <li class="item-con-desplegable">
                        <a href="{{ route('perfil') }}" class="enlace-nav enlace-perfil">
                            <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2"
                                fill="none">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span id="user-name">{{ Auth::user()->name }}</span>
                            <svg class="flecha-baja" width="12" height="12" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="3" fill="none">
                                <path d="M6 9l6 6 6-6" />
                            </svg>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{ route('perfil') }}#garaje">🚗 Mi Garaje</a></li>
                            <li><a href="{{ route('perfil') }}#citas">📅 Mis Citas</a></li>
                            <li><a href="{{ route('perfil') }}#facturas">📄 Facturas</a></li>
                            <li><a href="{{ route('configuracion') }}">⚙️ Configuración</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="cerrar-sesion">🚪 Cerrar Sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth

                </ul>
            </nav>
        </div>
    </header>

    <main class="contenedor-perfil">

        <aside class="sidebar-perfil">
            <div class="tarjeta-usuario">
                <div class="avatar">
                    <span>
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(Auth::user()->profile?->surname ?? '', 0, 1)) }}
                    </span>
                </div>
                <h2>{{ Auth::user()->name }} {{ Auth::user()->profile?->surname ?? '' }}</h2>
                <p class="email-usuario">{{ Auth::user()->email }}</p>

                @if(Auth::user()->profile)
                <p class="telefono-usuario">Teléfono: {{ Auth::user()->profile->phone }}</p>
                @endif

                <p class="miembro-desde">Miembro desde: {{ Auth::user()->created_at->format('Y') }}</p>

                <nav class="menu-perfil">
                    <a href="#" class="activo">🚗 Mi Garaje</a>
                    <a href="#">📅 Mis Citas</a>
                    <a href="#">📄 Facturas</a>
                    <a href="{{ route('configuracion') }}">⚙️ Configuración</a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            style="background:none; border:none; color: inherit; font: inherit; cursor: pointer; padding: 10px 0;">🚪
                            Cerrar Sesión</button>
                    </form>
                </nav>
            </div>
        </aside>

        <section class="contenido-dashboard">

            <div class="widget-alerta">
                <div class="icono-alerta">🔧</div>
                <div class="texto-alerta">
                    <h3>Estado del Taller</h3>
                    <p>No tienes reparaciones activas en este momento.</p>
                </div>
                <button class="boton contorno">Ver historial</button>
            </div>

            <h2 class="titulo-seccion-perfil" id="garaje">Mis Vehículos</h2>
            <div class="grid-garaje">
                {{-- Se cargan todos los coches que tiene el, usuario logeado, registrados en la base de datos --}}
                @forelse(Auth::user()->cars as $car)
                <article class="tarjeta-garaje">
                    <div class="foto-garaje">
                        {{-- Comprobamos si hay imagen. Si la hay, la mostramos --}}
                        @if($car->image)
                        <img src="{{ asset($car->image) }}" alt="{{ $car->brand->name }} {{ $car->model }}"
                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                        @else
                        {{-- Si NO hay imagen, mostramos la caja gris de respaldo --}}
                        <div
                            style="width:100%; height:100%; background:#eee; display:flex; align-items:center; justify-content:center; color:#999;">
                            <span style="font-size: 3rem;">🚗</span>
                        </div>
                        @endif
                    </div>
                    <div class="info-garaje">
                        <h3>{{ $car->brand->name }} {{ $car->model }}</h3>
                        <p class="tipo-motor">{{ $car->type }}</p>

                        @if($car->extras->count() > 0)
                        <p style="font-size: 0.8rem; color: #666; margin-top:5px;">
                            + {{ $car->extras->first()->name }}
                            @if($car->extras->count() > 1) y más... @endif
                        </p>
                        @endif

                        <div class="acciones-garaje">
                            <a href="{{ url('/cita') }}" class="boton-pequeno">Pedir Cita</a>
                            <a href="#" class="enlace-historial">Ver ficha</a>
                        </div>
                    </div>
                </article>
                {{-- Si el usuario no tiene ningún coche,  --}}
                @empty
                {{-- Esto se muestra si el usuario NO tiene coches --}}
                <div class="sin-coches">
                    <p>No tienes vehículos registrados en tu garaje.</p>
                    <a href="concesionario.html" class="boton-destacado"
                        style="margin-top:10px; display:inline-block;">Ir al Concesionario</a>
                </div>
                @endforelse

            </div>

        </section>
    </main>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>