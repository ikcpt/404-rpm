const id = new URLSearchParams(window.location.search).get('id');

function crearBloqueFicha(data, contenedor) {
    for (const categoria in data) {
        const section = document.createElement('section');
        section.classList.add('ficha-bloque');

        const h3 = document.createElement('h3');
        h3.textContent = categoria.replace(/_/g, ' ').toUpperCase();
        section.appendChild(h3);

        const ul = document.createElement('ul');

        for (const clave in data[categoria]) {
            const li = document.createElement('li');

            if (typeof data[categoria][clave] === 'object' && data[categoria][clave] !== null) {
                li.textContent = `${clave.replace(/_/g, ' ')}:`;
                const subUl = document.createElement('ul');

                for (const sub in data[categoria][clave]) {
                    const subLi = document.createElement('li');
                    subLi.textContent = `${sub.replace(/_/g, ' ')}: ${data[categoria][clave][sub]}`;
                    subUl.appendChild(subLi);
                }

                li.appendChild(subUl);
            } else {
                li.textContent = `${clave.replace(/_/g, ' ')}: ${data[categoria][clave]}`;
            }

            ul.appendChild(li);
        }

        section.appendChild(ul);
        contenedor.appendChild(section);
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
            document.getElementById('tipo').textContent = coche.type || '';

            if (coche.brand) {
                document.getElementById('marca').textContent = coche.brand.name;
            }

            const fichaContainer = document.getElementById('ficha-tecnica');
            fichaContainer.innerHTML = '';

            if (coche.technical_sheet) {
                crearBloqueFicha(coche.technical_sheet, fichaContainer);
            } else {
                fichaContainer.textContent = 'No hay ficha técnica disponible';
            }
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
