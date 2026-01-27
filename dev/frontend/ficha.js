const coches = {
    1: {
        nombre: "Ferrari F8 Tributo",
        precio: "285.000€",
        img: "assets/img/ferrari/f8-tributo.png",
        descripcion: "V8 biturbo de 720CV. Bestia absoluta."
    },
    2: {
        nombre: "Lamborghini Huracán",
        precio: "240.000€",
        img: "assets/img/lanborguini/huracan.png",
        descripcion: "V10 atmosférico. Sonido de otro planeta."
    },
    3: {
        nombre: "Audi R8 V10",
        precio: "145.000€",
        img: "assets/img/audi/r8.png",
        descripcion: "Superdeportivo usable cada día."
    }
};

const id = new URLSearchParams(window.location.search).get('id');
const coche = coches[id];

if (coche) {
    document.getElementById('img').src = coche.img;
    document.getElementById('nombre').textContent = coche.nombre;
    document.getElementById('precio').textContent = coche.precio;
    document.getElementById('descripcion').textContent = coche.descripcion;
}
