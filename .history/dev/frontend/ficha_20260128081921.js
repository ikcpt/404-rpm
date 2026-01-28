const id = new URLSearchParams(window.location.search).get('id');

if (!id) {
    document.getElementById('nombre').textContent = "Coche no encontrado";
} else {
    fetch(`api/cars/${id}`)
        .then(r => r.json())
        .then(c => {

            document.getElementById('img').src = c.image;
            document.getElementById('nombre').textContent = c.model;
            document.getElementById('precio').textContent = `${Number(c.price).toLocaleString()} €`;
            document.getElementById('descripcion').textContent = c.description;

            document.getElementById('marca').textContent =
                `${c.brand.name} (${c.brand.country})`;

            document.getElementById('tipo').textContent = c.type;

            // Ficha técnica bonita
            const ficha = document.getElementById('ficha');
            ficha.innerHTML = `
                <div><strong>Marca:</strong> ${c.brand.name}</div>
                <div><strong>Origen:</strong> ${c.brand.country}</div>
                <div><strong>Combustible:</strong> ${c.type}</div>
                <div><strong>Precio:</strong> ${Number(c.price).toLocaleString()} €</div>
            `;

            // Extras
            const extras = document.getElementById('extras');
            extras.innerHTML = '';

            if (c.extras.length) {
                c.extras.forEach(e => {
                    const li = document.createElement('li');
                    li.textContent = `${e.name} – ${e.description}`;
                    extras.appendChild(li);
                });
            } else {
                extras.innerHTML = '<li>Sin extras</li>';
            }

        })
        .catch(() => {
            document.getElementById('nombre').textContent = "Coche no encontrado";
        });
}
