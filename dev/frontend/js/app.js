document.addEventListener("DOMContentLoaded", () => {
    // Petición a la API del tiempo una vez cargada la página
    clima();

    // Comprobar si el usuario está logueado en la página
    comprobarSesion();
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
function climaCielo(codigo) {
    if (codigo == 0) {
        return `<img src="assets/img/clima/despejado.png" alt="clima-despejado">`;
    }
    if (codigo >= 1 && codigo <= 3) {
        return `<img src="assets/img/clima/nublado.png" alt="clima-nublado">`;
    }
    if (codigo >= 45 && codigo <= 48) {
        return `<img src="assets/img/clima/niebla.png" alt="clima-niebla">`;
    }
    if (codigo >= 51 && codigo <= 55) {
        return `<img src="assets/img/clima/lluvia_suave.png" alt="clima-lluvia-suave">`;
    }
    if (codigo >= 61 && codigo <= 67) {
        return `<img src="assets/img/clima/lluvia.png" alt="clima-lluvia">`;
    }
    if (codigo >= 71 && codigo <= 77) {
        return `<img src="assets/img/clima/nieve.png" alt="clima-nieve">`;
    }
    if (codigo >= 80 && codigo >= 82) {
        return `<img src="assets/img/clima/lluvia_fuerte.png" alt="clima-lluvia-fuerte">`;
    }
    if (codigo >= 95 && codigo <= 99) {
        return `<img src="assets/img/clima/tormenta.png" alt="clima-tormenta">`;
    }

    return "Desconocido";
}

// Función para llamar a la API Open Meteo
function clima() {
    // Petición al archivo api.php en Laravel
    fetch("/api/clima")
        .then(response => {
            if (!response.ok) {
                throw new Error("Error: Ha habido un error en la solicitud");
            }
            return response.json();
        })
        .then(data => {
            // Si devuelve el JSON con el tiempo actual se guardará la temperatura, la velocidad del viento y el código (soleado, nublado, lluvia...) en Irún
            if(data.current_weather) {
                let temperatura = data.current_weather.temperature;
                let viento = data.current_weather.windspeed;
                let codigo = data.current_weather.weathercode;

                // Llamada a la funcion climaCielo() donde dependiendo del código del tiempo del JSON de la API se guardará una imágen en la variable
                let cielo = climaCielo(codigo);

                // Se actualiza el texto de la página principal con el icono y tiempo actual
                widgetClima.innerHTML = `${cielo} ${temperatura}ºC (Viento: ${viento} km/h)`;
            }
            else {
                widgetClima.innerHTML = `No ha sido posible cargar el clima actual.`;
            }
        })
        .catch(error => {
            console.log(`Error al cargar el archivo: ${error}`);
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
        document.getElementByName("menu-auth").style.display = "none";
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

