<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha del coche</title>

    <link rel="stylesheet" href="{{ asset('css/ficha.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/nav.css') }}" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</head>

<body>

    <main class="ficha">

        <img id="img" alt="Cargando imagen..." style="min-height: 300px; background: #eee;" />

        <div id="marca"></div>
        <div id="tipo"></div>

        <div class="contenido-derecha">
            <h1 id="nombre">Cargando datos...</h1>
            <div id="precio"></div>
            <p id="descripcion"></p>

            <div id="ficha-container"></div>

            <h3>Extras incluidos</h3>
            <ul id="extras">
                <li>Cargando equipamiento...</li>
            </ul>
        </div>

        <div id="acciones-servidor">
            <a href="{{ route('coche.reservar.form', $car->id) }}" class="btn-reservar">RESERVAR</a>

            <form action="{{ route('coche.comprar', $car->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-comprar" onclick="return confirm('¿Confirmar compra inmediata?')">
                    COMPRAR
                </button>
            </form>

            <a href="{{ route('concesionario') }}" class="btn-volver">Volver</a>
        </div>

    </main>

    <script>
    window.carId = "{{ $car->id }}";
    window.assetUrl = "{{ asset('') }}";
    </script>

    <script src="{{ asset('js/ficha.js') }}"></script>
</body>

</html>