<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 RPM | Acceso</title>
    
    <style>
        /* 1. DEFINIMOS TU PALETA AQUÍ PARA ASEGURAR QUE SE VEA */
        :root {
            --color-primario: #1e4fa3;
            --color-secundario: #e10600;
            --color-terciario: #0b0e13;
            --color-contraste: #f2f2f2;
            --color-acento: #2e90ff;
            --color-acento-secundario: #8c0f14;
            --color-blanco: #ffffff;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', system-ui, sans-serif;
            background-color: var(--color-terciario);
            color: var(--color-terciario);
        }

        /* 2. FONDO CON DEGRADADO AZUL MUY SUTIL */
        .portal-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            background: radial-gradient(circle at center, #1b2838 0%, var(--color-terciario) 80%);
        }

        /* 3. TARJETA BLANCA PARA MÁXIMA VISIBILIDAD */
        .portal-card {
            background-color: var(--color-blanco);
            border-radius: 15px;
            padding: 3rem;
            max-width: 850px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5); /* Sombra fuerte */
            border-top: 5px solid var(--color-primario); /* Detalle azul arriba */
        }

        .portal-logo svg {
            width: 70px;
            height: 70px;
            margin-bottom: 1rem;
            color: var(--color-primario);
        }

        .portal-title {
            font-size: 2.5rem;
            color: var(--color-terciario);
            margin: 0;
            font-weight: 800;
            text-transform: uppercase;
        }

        .portal-subtitle {
            color: #666;
            margin-top: 10px;
            margin-bottom: 3rem;
            font-size: 1.1rem;
        }

        /* 4. GRID DE OPCIONES */
        .options-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        /* ESTILOS COMUNES BOTONES */
        .option-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2.5rem;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            background-color: var(--color-contraste); /* Fondo gris claro */
        }

        .option-btn svg {
            width: 60px;
            height: 60px;
            margin-bottom: 15px;
            transition: 0.3s;
        }

        .option-btn h3 {
            font-size: 1.4rem;
            margin: 0 0 5px 0;
            font-weight: 800;
            text-transform: uppercase;
        }

        .option-btn p {
            font-size: 0.9rem;
            margin: 0;
            color: #555;
        }

        /* --- OPCIÓN LOGIN (AZUL / PILOTO) --- */
        .option-login {
            border-color: rgba(30, 79, 163, 0.2);
        }
        
        .option-login svg { color: var(--color-primario); }
        .option-login h3 { color: var(--color-primario); }

        .option-login:hover {
            background-color: var(--color-primario);
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(30, 79, 163, 0.3);
        }

        /* Al hacer hover, el texto se vuelve blanco */
        .option-login:hover h3, 
        .option-login:hover p, 
        .option-login:hover svg {
            color: var(--color-blanco);
        }


        /* --- OPCIÓN REGISTRO (ROJO / NUEVO) --- */
        .option-register {
            border-color: rgba(225, 6, 0, 0.2);
        }

        .option-register svg { color: var(--color-secundario); }
        .option-register h3 { color: var(--color-secundario); }

        .option-register:hover {
            background-color: var(--color-secundario);
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(225, 6, 0, 0.3);
        }

        /* Al hacer hover, el texto se vuelve blanco */
        .option-register:hover h3, 
        .option-register:hover p, 
        .option-register:hover svg {
            color: var(--color-blanco);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .options-grid { grid-template-columns: 1fr; }
            .portal-card { padding: 1.5rem; }
        }
    </style>
</head>
<body>

    <div class="portal-wrapper">
        <div class="portal-card">
            
            <div class="portal-logo">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.2-2.858.578-4.18M7 9a3 3 0 106 0 3 3 0 00-6 0z" />
                </svg>
            </div>

            <h1 class="portal-title">Punto de Control</h1>
            <p class="portal-subtitle">Selecciona tu carril para continuar</p>

            <div class="options-grid">
                
                <a href="{{ route('login') }}" class="option-btn option-login">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    <h3>Ya soy Piloto</h3>
                    <p>Ingresar al Taller</p>
                </a>

                <a href="{{ route('register') }}" class="option-btn option-register">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <h3>Nuevo Ingreso</h3>
                    <p>Crear Cuenta</p>
                </a>

            </div>

            <div style="margin-top: 2rem;">
                <a href="/" style="color: #999; text-decoration: none; font-size: 0.9rem; transition: 0.3s; font-weight: 600;">
                    ← Volver a la página principal
                </a>
            </div>

        </div>
    </div>

</body>
</html>