const id = new URLSearchParams(window.location.search).get('id');

if (!id) {
    document.getElementById('nombre').textContent = "ID de coche no proporcionado";
} else {
    fetch(`api/cars/${id}`)
        .then(response => {
            if (!response.ok) throw new Error("Coche no encontrado");
            return response.json();
        })
        .then(coche => {

            // Datos principales
            document.getElementById('img').src = coche.image || '';
            document.getElementById('nombre').textContent = coche.model || '';
            document.getElementById('marca').textContent = `Marca: ${coche.brand?.name || ''}`;
            document.getElementById('tipo').textContent = `Tipo: ${coche.type || ''}`;
            document.getElementById('precio').textContent = `${coche.price || 0} €`;
            document.getElementById('descripcion').textContent = coche.description || '';

            // Extras
            const extrasUL = document.getElementById('extras');
            extrasUL.innerHTML = '';
            if (coche.extras && coche.extras.length > 0) {
                coche.extras.forEach(extra => {
                    const li = document.createElement('li');
                    li.textContent = `${extra.name} – ${extra.description}`;
                    extrasUL.appendChild(li);
                });
            } else {
                extrasUL.innerHTML = '<li>Sin extras</li>';
            }

            // Datos adicionales limpios (solo campos útiles, sin IDs ni timestamps)
            const datos = document.getElementById('datos-completos');
            datos.innerHTML = '';

            const utiles = ['type', 'brand', 'user', 'model', 'description', 'price'];
            utiles.forEach(key => {
                if (coche[key]) {
                    const div = document.createElement('div');

                    if (typeof coche[key] === 'object') {
                        let texto = '';
                        for (const subKey in coche[key]) {
                            if (!['id','created_at','updated_at'].includes(subKey)) {
                                texto += `${subKey.replace(/_/g,' ')}: ${coche[key][subKey]} | `;
                            }
                        }
                        div.textContent = `${key}: ${texto.slice(0,-3)}`;
                    } else {
                        div.textContent = `${key}: ${coche[key]}`;
                    }

                    datos.appendChild(div);
                }
            });

        })
        .catch(error => {
            console.error(error);
            document.getElementById('nombre').textContent = "Coche no encontrado";
        });
}
