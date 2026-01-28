const id = new URLSearchParams(window.location.search).get('id');

function imprimirObjeto(obj, contenedor, nivel = 0) {
    for (const key in obj) {
        const div = document.createElement('div');
        div.classList.add('fila-dato');

        if (typeof obj[key] === 'object' && obj[key] !== null) {
            const h = document.createElement('h3');
            h.textContent = key.replace(/_/g, ' ');
            div.appendChild(h);

            imprimirObjeto(obj[key], div, nivel + 1);
        } else {
            div.textContent = `${key.replace(/_/g, ' ')}: ${obj[key]}`;
        }

        contenedor.appendChild(div);
    }
}

if (id) {
    fetch(`api/cars/${id}`)
        .then(response => {
            if (!response.ok) throw new Error("Coche no encontrado");
            return response.json();
        })
        .then(coche => {

            document.getElementById('img').src = coche.image || '';
            document.getElementById('nombre').textContent = coche.model || '';
            document.getElementById('precio').textContent = `${coche.price} €`;
            document.getElementById('descripcion').textContent = coche.description || '';
            document.getElementById('tipo').textContent = `Tipo: ${coche.type || ''}`;

            if (coche.brand) {
                document.getElementById('marca').textContent = `Marca: ${coche.brand.name}`;
            }

            const datos = document.getElementById('datos-completos');
            datos.innerHTML = '';

            imprimirObjeto(coche, datos);

            const extrasUL = document.getElementById('extras');
            extrasUL.innerHTML = '';

            if (coche.extras && coche.extras.length > 0) {
                coche.extras.forEach(extra => {
                    const li = document.createElement('li');
                    li.textContent = `${extra.name} – ${extra.description}`;
                    extrasUL.appendChild(li);
                });
            } else {
                const li = document.createElement('li');
                li.textContent = 'Sin extras';
                extrasUL.appendChild(li);
            }

        })
        .catch(error => {
            console.error(error);
            document.getElementById('nombre').textContent = "Coche no encontrado";
        });
} else {
    document.getElementById('nombre').textContent = "ID de coche no proporcionado";
}
