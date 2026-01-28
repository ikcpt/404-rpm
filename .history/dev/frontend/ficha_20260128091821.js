const id = new URLSearchParams(window.location.search).get('id');

// Función auxiliar para formatear moneda
const formatMoney = (amount) => {
    return Number(amount).toLocaleString('de-DE', { style: 'currency', currency: 'EUR' });
};

if (!id) {
    document.getElementById('nombre').textContent = "Coche no encontrado";
    document.getElementById('img').style.display = 'none';
} else {
    // Simulamos la API (o usa tu fetch real)
    fetch(`api/cars/${id}`)
        .then(r => r.json())
        .then(c => {
            
            // 1. Rellenar datos básicos
            document.getElementById('img').src = c.image;
            document.getElementById('nombre').textContent = c.model;
            document.getElementById('precio').textContent = formatMoney(c.price);
            document.getElementById('descripcion').textContent = c.description;

            // Badges flotantes
            document.getElementById('marca').textContent = c.brand.name;
            document.getElementById('tipo').textContent = c.type;

            // 2. CONSTRUCCIÓN DE LOS TABS DE JQUERY
            // jQuery Tabs necesita una estructura específica: <ul> para nav y <div>s para paneles.
            
            const fichaContainer = document.getElementById('ficha');
            
            // Creamos el HTML interno dinámicamente
            // He dividido los datos que pediste en dos tabs para que tenga sentido usar tabs
            const tabsHTML = `
                <ul>
                    <li><a href="#tab-resumen">Resumen</a></li>
                    <li><a href="#tab-tecnico">Detalles</a></li>
                </ul>

                <div id="tab-resumen">
                    <div class="dato-fila">
                        <strong>Marca</strong>
                        <span>${c.brand.name}</span>
                    </div>
                    <div class="dato-fila">
                        <strong>Origen</strong>
                        <span>${c.brand.country}</span>
                    </div>
                </div>

                <div id="tab-tecnico">
                    <div class="dato-fila">
                        <strong>Combustible</strong>
                        <span>${c.type}</span>
                    </div>
                    <div class="dato-fila">
                        <strong>Precio Base</strong>
                        <span>${formatMoney(c.price)}</span>
                    </div>
                </div>
            `;

            // Inyectamos el HTML
            fichaContainer.innerHTML = tabsHTML;

            // INICIALIZAMOS JQUERY TABS
            // Es vital hacerlo después de inyectar el HTML
            $(function() {
                $("#ficha").tabs();
            });

            // 3. Extras
            const extras = document.getElementById('extras');
            extras.innerHTML = '';

            if (c.extras && c.extras.length) {
                c.extras.forEach(e => {
                    const li = document.createElement('li');
                    // Asumiendo que 'e' puede ser un string o un objeto según tu API anterior
                    const textoExtra = e.name ? `${e.name}` : e; 
                    li.textContent = textoExtra;
                    extras.appendChild(li);
                });
            } else {
                extras.innerHTML = '<li>Sin extras especificados</li>';
            }

        })
        .catch(error => {
            console.error(error);
            document.getElementById('nombre').textContent = "Error al cargar datos";
        });
}