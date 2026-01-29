document.addEventListener("DOMContentLoaded", () => {
    // Petición a la API del tiempo una vez cargada la página
    clima();

    // Comprobar si el usuario está logueado y quién es, para mostrar el nombre del usuario, o los botones de inicio de sesión y registro
    comprobarSesion();

    // Iniciar movimiento del carrusel de fotos de la página principal
    iniciarCarrusel();
});

// API CLIMA EN IRÚN
// Elementos del HTML guardados en diferentes variables
let widgetClima = document.getElementById("widget-clima");
let textoConsejo = document.getElementById("texto-consejo");

// Llamada a la API cada 60 segundos
setInterval(() => {
    clima();
}, 60000);

// Dependiendo del código que devuelva el JSON de la API Open Meteo, se mostrará un icono del tiempo diferente en la página
function obtenerRutaIcono(codigo) {
    if (codigo == 0) return "assets/img/clima/despejado.png";
    if (codigo >= 1 && codigo <= 3) return "assets/img/clima/nublado.png";
    if (codigo >= 45 && codigo <= 48) return "assets/img/clima/niebla.png";
    if (codigo >= 51 && codigo <= 55) return "assets/img/clima/lluvia_suave.png";
    if (codigo >= 61 && codigo <= 67) return "assets/img/clima/lluvia.png";
    if (codigo >= 71 && codigo <= 77) return "assets/img/clima/nieve.png";
    if (codigo >= 80 && codigo <= 82) return "assets/img/clima/lluvia_fuerte.png";
    if (codigo >= 95 && codigo <= 99) return "assets/img/clima/tormenta.png";

    return "Desconocido"; 
}

// Función para llamar a la API Open Meteo
function clima() {
    fetch("/api/clima")
        .then(response => {
            if (!response.ok) throw new Error("Error en la solicitud");
            return response.json();
        })
        .then(data => {
            // Verificamos que existen los datos del clima actual
            if (data.current_weather) {
                let temperatura = Math.round(data.current_weather.temperature);
                let codigo = data.current_weather.weathercode;
                let viento = data.current_weather.windspeed; // Por si lo quieres usar

                // 1. TRADUCIMOS EL CÓDIGO A TEXTO (La clave para arreglarlo)
                let descripcionTexto = obtenerDescripcion(codigo);

                // 2. ACTUALIZAMOS EL HTML
                
                // Temperatura
                let tempElement = document.getElementById('temp-valor');
                if (tempElement) tempElement.textContent = temperatura;

                // Descripción (Ahora sí mostrará "Lluvia", "Nublado", etc.)
                let descElement = document.getElementById('descripcion-clima');
                if (descElement) descElement.textContent = descripcionTexto;

                // Consejo (Usamos el texto traducido para elegir el consejo)
                let consejoElement = document.getElementById('consejo-clima');
                if (consejoElement) consejoElement.textContent = obtenerConsejoConduccion(descripcionTexto);

                // Icono
                let imgElement = document.getElementById('icono-tiempo-img');
                if (imgElement) {
                    imgElement.src = obtenerRutaIcono(codigo);
                }
            } 
        })
        .catch(error => {
            console.error("Error cargando el clima:", error);
            document.getElementById('descripcion-clima').textContent = "Error al cargar";
        });
}
function comprobarSesion() {
    fetch("/api/user", {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        credentials: 'include'
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Error: Ha habido un error en la solicitud");
        }
        return response.json();
    })
    .then(data => {
        console.log(data.name);
        document.getElementById("menu-guest").style.display = "none";
        document.getElementById("menu-auth").style.display = "block";
        document.getElementById("user-name").textContent = data.name;
    })
    .catch(error => {
        console.log("Invitado");
        document.getElementById("menu-guest").style.display = "flex";
        document.getElementById("menu-auth").style.display = "none";
    })

    let btnLogout = document.getElementById("btn-logout");
    btnLogout.addEventListener("click", function(e) {
        e.preventDefault();

        let xsrfToken = getCookie('XSRF-TOKEN'); 
        fetch("/logout", {
            method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-XSRF-TOKEN': decodeURIComponent(xsrfToken)
                },
                credentials: 'include'
        })
        .then(() => {
            window.location.reload();
        })
        .catch(err => console.log("Error al cerrar sesión", err));
    });
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
    return '';
}

function recogerDatos(coche) {
    let datosBuscar = document.getElementById("");

}

  let indiceSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const puntos = document.querySelectorAll('.punto');
    const intervaloTiempo = 5000; // Cambia cada 5 segundos
    let intervalo;

    // Función para mostrar el slide específico
    function mostrarSlide(n) {
        // Reiniciar contador si llegamos al final o principio
        if (n >= slides.length) indiceSlide = 0;
        else if (n < 0) indiceSlide = slides.length - 1;
        else indiceSlide = n;

        // Quitar clase activa a todos
        slides.forEach(slide => slide.classList.remove('activa'));
        puntos.forEach(punto => punto.classList.remove('activo'));

        // Poner clase activa al actual
        slides[indiceSlide].classList.add('activa');
        puntos[indiceSlide].classList.add('activo');
    }

    // Función para siguiente/anterior
    function moverSlide(n) {
        mostrarSlide(indiceSlide + n);
        reiniciarReloj(); // Reinicia el contador para que no salte de golpe
    }

    // Función para ir a un punto concreto
    function irASlide(n) {
        mostrarSlide(n);
        reiniciarReloj();
    }

    // Auto-play
    function iniciarCarrusel() {
        intervalo = setInterval(() => {
            moverSlide(1);
        }, intervaloTiempo);
    }

    function reiniciarReloj() {
        clearInterval(intervalo);
        iniciarCarrusel();
    }

    function obtenerConsejoConduccion(clima) {
    // Convertimos a minúsculas para facilitar la búsqueda
    const condicion = clima.toLowerCase();

        // 1. LLUVIA O LLOVIZNA
        if (condicion.includes('lluvia') || condicion.includes('llovizna') || condicion.includes('rain')) {
            return "⚠️ Calzada mojada. Aumenta la distancia de seguridad.";
        }
        
        // 2. NIEVE O HIELO
        if (condicion.includes('nieve') || condicion.includes('nevada') || condicion.includes('snow')) {
            return "❄️ ¡Cuidado! Posible hielo. Usa marchas largas.";
        }
        
        // 3. TORMENTA
        if (condicion.includes('tormenta') || condicion.includes('truenos') || condicion.includes('storm')) {
            return "⛈️ Evita desplazamientos innecesarios.";
        }
        
        // 4. NIEBLA
        if (condicion.includes('niebla') || condicion.includes('neblina') || condicion.includes('mist')) {
            return "🌫️ Poca visibilidad. Enciende las antiniebla.";
        }
        
        // 5. SOL / DESPEJADO
        if (condicion.includes('sol') || condicion.includes('despejado') || condicion.includes('clear')) {
            return "☀️ Condiciones perfectas. ¡Disfruta de la carretera!";
        }
        
        // 6. NUBLADO
        if (condicion.includes('nubes') || condicion.includes('nuboso') || condicion.includes('clouds')) {
            return "☁️ Buen tiempo para conducir, pero revisa tus luces.";
        }

        // POR DEFECTO (Si no reconoce nada)
        return "🚗 Conduce siempre con precaución.";
    }
    function obtenerDescripcion(codigo) {
    if (codigo == 0) return "Cielo despejado";
    if (codigo >= 1 && codigo <= 3) return "Nublado";
    if (codigo >= 45 && codigo <= 48) return "Niebla";
    if (codigo >= 51 && codigo <= 55) return "Llovizna";
    if (codigo >= 61 && codigo <= 67) return "Lluvia";
    if (codigo >= 71 && codigo <= 77) return "Nieve";
    if (codigo >= 80 && codigo <= 82) return "Lluvia fuerte";
    if (codigo >= 95 && codigo <= 99) return "Tormenta";
    return "Clima variable";
}