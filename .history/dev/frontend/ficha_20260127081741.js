const coches = {
    "ferrari-f8": {
        nombre: "Ferrari F8 Tributo",
        precio: "285.000€",
        imagen: "assets/img/ferrari/f8-tributo.png",
        descripcion: "Motor V8 biturbo de 720CV. Pura locura italiana."
    },
    "lamborghini-huracan": {
        nombre: "Lamborghini Huracán",
        precio: "240.000€",
        imagen: "assets/img/lanborguini/huracan.png",
        descripcion: "V10 atmosférico con tracción total. Brutal."
    },
    "audi-r8": {
        nombre: "Audi R8 V10",
        precio: "145.000€",
        imagen: "assets/img/audi/r8.png",
        descripcion: "Superdeportivo usable a diario. Ingeniería alemana."
    }
};

const params = new URLSearchParams(window.location.search);
const id = params.get('id');
const coche = coches[id];

if (coche) {
    document.getElementById('nombre').textContent = coche.nombre;
    document.getElementById('precio').textContent = coche.precio;
    document.getElementById('imagen').src = coche.imagen;
    document.getElementById('descripcion').textContent = coche.descripcion;
}
