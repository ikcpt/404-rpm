<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="css/nav.css">
        <link rel="stylesheet" href="css/responsive.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
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
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <img src="{{ asset('img/logo.jpg') }}" alt="Logo" width="170px" height="170px">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
