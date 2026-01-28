const id = new URLSearchParams(window.location.search).get('id');

// Función auxiliar para formatear moneda
const formatMoney = (amount) => {
    return Number(amount).toLocaleString('de-DE', { style: 'currency', currency: 'EUR' });
};

if (!id) {
    document.getElementById('nombre').textContent = "Coche no encontrado";
    document.getElementById('img').style.display = 'none';
} else {
    // Simulamos la API
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

            // 2. CONSTRUCCIÓN DE LOS TABS
            const fichaContainer = document.getElementById('ficha');
            
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

            fichaContainer.innerHTML = tabsHTML;

            // Inicializamos Tabs
            $(function() {
                $("#ficha").tabs();
            });

            // 3. EXTRAS (CORREGIDO PARA MOSTRAR DESCRIPCIÓN)
            const extras = document.getElementById('extras');
            extras.innerHTML = '';

            if (c.extras && c.extras.length) {
                c.extras.forEach(e => {
                    const li = document.createElement('li');
                    
                    // Aquí está el cambio: Usamos HTML para estructurar Nombre + Descripción
                    // Validamos que exista descripción, si no, ponemos string vacío
                    const desc = e.description ? e.description : ''; 
                    
                    li.innerHTML = `
                        <span class="extra-nombre">${e.name}</span>
                        <span class="extra-desc">${desc}</span>
                    `;
                    
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