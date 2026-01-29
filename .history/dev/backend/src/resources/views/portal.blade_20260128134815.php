<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 RPM | Acceso</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard-racing.css') }}">
    
    <style>
        /* Estilos específicos para esta página de portal */
        .portal-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            /* Degradado de fondo más dramático */
            background: radial-gradient(circle at center, #1b2838 0%, var(--color-terciario) 100%);
        }

        .portal-card {
            background: rgba(20, 25, 35, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 3rem;
            max-width: 800px;
            width: 100%;
            text-align: center;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
        }

        /* Línea decorativa superior */
        .portal-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--color-acento), var(--color-secundario));
        }

        .portal-logo svg {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
            filter: drop-shadow(0 0 10px rgba(255, 255, 255, 0.3));
        }

        .portal-title {
            font-size: 2rem;
            color: var(--color-blanco);
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 0.5rem;
            font-weight: 800;
        }

        .portal-subtitle {
            color: var(--color-contraste);
            opacity: 0.6;
            margin-bottom: 3rem;
            font-size: 1.1rem;
        }

        /* Grid de Opciones */
        .options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        /* Botones Grandes de Opción */
        .option-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2.5rem;
            border-radius: 15px;
            text-decoration: none;
            transition: all 0.4s ease;
            border: 1px solid transparent;
            position: relative;
        }

        /* OPCIÓN LOGIN (AZUL) */
        .option-login {
            background: rgba(30, 79, 163, 0.1); /* Fondo azul muy sutil */
            border: 1px solid rgba(30, 79, 163, 0.3);
        }
        
        .option-login:hover {
            background: rgba(30, 79, 163, 0.2);
            transform: translateY(-5px);
            border-color: var(--color-acento);
            box-shadow: 0 10px 30px rgba(46, 144, 255, 0.2);
        }

        .option-login h3 { color: var(--color-acento); }
        .option-login svg { stroke: var(--color-acento); }


        /* OPCIÓN REGISTRO (ROJO) */
        .option-register {
            background: rgba(140, 15, 20, 0.1); /* Fondo rojo muy sutil */
            border: 1px solid rgba(140, 15, 20, 0.3);
        }

        .option-register:hover {
            background: rgba(140, 15, 20, 0.2);
            transform: translateY(-5px);
            border-color: var(--color-secundario);
            box-shadow: 0 10px 30px rgba(225, 6, 0, 0.2);
        }

        .option-register h3 { color: var(--color-secundario); }
        .option-register svg { stroke: var(--color-secundario); }


        /* Textos dentro de los botones */
        .option-btn svg {
            width: 50px;
            height: 50px;
            margin-bottom: 15px;
            transition: 0.3s;
        }

        .option-btn h3 {
            font-size: 1.2rem;
            margin: 0 0 10px 0;
            text-transform: uppercase;
            font-weight: 700;
        }

        .option-btn p {
            color: #aaa;
            font-size: 0.9rem;
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .options-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body class="racing-body">

    <div class="portal-wrapper">
        <div class="portal-card">
            
            <div class="portal-logo">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" style="stroke: white;" />
                </svg>
            </div>

            <h1 class="portal-title">Zona de Acceso</h1>
            <p class="portal-subtitle">Identifícate para entrar al taller o únete a la escudería</p>

            <div class="options-grid">
                
                <a href="{{ route('login') }}" class="option-btn option-login">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <h3>Soy Piloto</h3>
                    <p>Iniciar Sesión con mi cuenta</p>
                </a>

                <a href="{{ route('register') }}" class="option-btn option-register">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <h3>Nuevo Registro</h3>
                    <p>Crear una cuenta nueva</p>
                </a>

            </div>

            <div style="margin-top: 2rem;">
                <a href="/" style="color: #666; text-decoration: none; font-size: 0.9rem; transition: 0.3s;">
                    ← Volver al Inicio
                </a>
            </div>

        </div>
    </div>

</body>
</html>