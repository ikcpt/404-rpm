<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 RPM - Editar perfil</title>

    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Tarjetas.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/concesionario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/configuracion.css') }}">
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
                    <li><a href="/" class="enlace-nav activo">Inicio</a></li>
                    <li><a href="taller.html" class="enlace-nav">Taller</a></li>
                    <li><a href="concesionario.html" class="enlace-nav">Concesionario</a></li>

                    <li>
                        <a href="cita.html" class="enlace-nav boton-destacado">Pedir Cita</a>
                    </li>

                    <li id="menu-guest" style="display: flex; gap: 15px; align-items: center;">
                        <a href="/acceso" class="enlace-nav">Entrar</a>
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

                <nav class="menu-perfil">
                    {{-- Nota: He cambiado la clase 'activo' al enlace de Configuración --}}
                    <a href="{{ route('perfil') }}">🚗 Mi Garaje</a>
                    <a href="{{ route('perfil') }}#citas">📅 Mis Citas</a>
                    <a href="{{ route('perfil') }}#facturas">📄 Facturas</a>
                    <a href="{{ route('configuracion') }}" class="activo">⚙️ Configuración</a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" style="background:none; border:none; color: inherit; font: inherit; cursor: pointer; padding: 10px 0;">
                            🚪 Cerrar Sesión
                        </button>
                    </form>
                </nav>
            </div>
        </aside>
        <section class="contenido-dashboard">
            @if(session('status') === 'profile-updated')
                <div class="mensaje-exito">
                    El perfil se ha actualizado correctamente.
                </div>
            @endif

            <div class="contenedor-formulario">
                <div class="header-seccion">
                    <h2>Información Personal</h2>
                    <p>Actualiza la información de tu cuenta y dirección de correo electrónico.</p>
                </div>
                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')
                    <div class="grid-formulario">
                        <div class="grupo-input">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                            @error('name') <span class="error-texto">{{ $message }}</span> @enderror
                        </div>
                        <div class="grupo-input">
                            <label for="surname">Apellidos</label>
                            <input type="text" id="surname" name="surname" value="{{ old('surname', $user->profile?->surname) }}">
                            @error('surname') <span class="error-texto">{{ $message }}</span> @enderror
                        </div>
                        <div class="grupo-input campo-full">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email') <span class="error-texto">{{ $message }}</span> @enderror
                        </div>
                        <div class="grupo-input campo-full">
                            <label for="phone">Teléfono</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->profile?->phone) }}">
                            @error('phone') <span class="error-texto">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <button type="submit" class="boton-guardar">Guardar Cambios</button>
                </form>
            </div>
            <div class="contenedor-formulario">
                <div class="header-seccion">
                    <h2>Seguridad</h2>
                    <p>Asegúrate de usar una contraseña larga y aleatoria para mantener tu cuenta segura.</p>
                </div>
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')
                    <div class="grid-formulario">
                        <div class="grupo-input campo-full">
                            <label for="current_password">Contraseña Actual</label>
                            <input type="password" id="current_password" name="current_password" autocomplete="current-password">
                            @error('current_password') <span class="error-texto">{{ $message }}</span> @enderror
                        </div>
                        <div class="grupo-input">
                            <label for="password">Nueva Contraseña</label>
                            <input type="password" id="password" name="password" autocomplete="new-password">
                            @error('password') <span class="error-texto">{{ $message }}</span> @enderror
                        </div>
                        <div class="grupo-input">
                            <label for="password_confirmation">Confirmar Contraseña</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>
                    <button type="submit" class="boton-guardar">Actualizar Contraseña</button>
                </form>
            </div>
        </section>
    </main>
    <script src="js/app.js"></script>
</body>
</html>