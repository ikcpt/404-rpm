// Obtener el ID de la URL
const id = new URLSearchParams(window.location.search).get('id');

if (id) {
    fetch(`api/cars/${id}`)
        .then(response => {
            if (!response.ok) throw new Error("Coche no encontrado");
            return response.json();
        })
        .then(coche => {
            document.getElementById('img').src = coche.image || coche.img || '';
            document.getElementById('nombre').textContent = coche.name || coche.nombre || '';
            document.getElementById('precio').textContent = coche.price || coche.precio || '';
            document.getElementById('descripcion').textContent = coche.description || coche.descripcion || '';
        })
        .catch(error => {
            console.error(error);
            document.getElementById('nombre').textContent = "Coche no encontrado";
            document.getElementById('precio').textContent = "";
            document.getElementById('descripcion').textContent = "";
        });
} else {
    document.getElementById('nombre').textContent = "ID de coche no proporcionado";
}
