<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 RPM | Acceso</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/acceso.css') }}">
</head>
<body>

    <div class="contenedor-portal">
        
        <div class="header-portal">
            <h1>404 <span>RPM</span></h1>
            <p>Selecciona tu carril de acceso</p>
        </div>

        <div class="grid-acceso">
            
            <a href="{{ route('login') }}" class="card-acceso login-side">
                <div class="icono-gigante">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
                <h2>Piloto</h2>
                <p>Iniciar Sesión</p>
            </a>

            <a href="{{ route('register') }}" class="card-acceso register-side">
                <div class="icono-gigante">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h2>Nuevo</h2>
                <p>Crear Cuenta</p>
            </a>

        </div>

        <a href="/" class="volver-link">
            ← Volver al Concesionario
        </a>

    </div>

</body>
</html>