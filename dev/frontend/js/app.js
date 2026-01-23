let widgetClima = document.getElementById("widget-clima");
let textoConsejo = document.getElementById("texto-consejo");

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

function clima() {
    fetch("/api/clima")
        .then(response => {
            if (!response.ok) {
                throw new Error("Error: Ha habido un error en la solicitud");
            }
            return response.json();
        })
        .then(data => {
            console.log(data);

            if(data.current_weather) {
                let temperatura = data.current_weather.temperature;
                let viento = data.current_weather.windspeed;
                let codigo = data.current_weather.weathercode;

                let cielo = climaCielo(codigo);

                widgetClima.innerHTML = `${cielo} - ${temperatura}ºC (Viento: ${viento} km/h)`
            }
        })
        .catch(error => {
            console.log(`Error al cargar el archivo: ${error}`);
        });
}
clima()


function recogerDatos(coche) {
    let datosBuscar = document.getElementById("");

}

