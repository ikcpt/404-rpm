document.addEventListener('DOMContentLoaded', () => {
    
    // 1. Usamos el ID que nos pasó el HTML
    const id = window.carId; 
    const rootUrl = window.assetUrl; // La ruta base de tu web
    
    // URL de tu API
    const apiUrl = `/api/cars/${id}`;

    const formatMoney = (amount) => {
        return Number(amount).toLocaleString('de-DE', { style: 'currency', currency: 'EUR' });
    };

    // 2. Llamada a la API
    fetch(apiUrl)
        .then(response => {
            if (!response.ok) throw new Error("Error en la red");
            return response.json();
        })
        .then(c => {
            // TÍTULO
            document.title = `${c.brand.name} ${c.model} | Ficha`;

            // DATOS BÁSICOS
            // Concatenamos la URL base con la ruta de la imagen
            const imagePath = c.image.startsWith('http') ? c.image : rootUrl + c.image;
            document.getElementById('img').src = imagePath;

            document.getElementById('nombre').textContent = `${c.brand.name} ${c.model}`;
            document.getElementById('precio').textContent = formatMoney(c.price);
            document.getElementById('descripcion').textContent = c.description;
            document.getElementById('marca').textContent = c.brand.name;
            document.getElementById('tipo').textContent = c.type;

            // TABS
            const tabsHTML = `
                <div id="tabs-wrapper">
                    <ul>
                        <li><a href="#tab-resumen">Resumen</a></li>
                        <li><a href="#tab-tecnico">Detalles</a></li>
                    </ul>
                    <div id="tab-resumen">
                        <div class="dato-fila"><strong>Marca</strong><span>${c.brand.name}</span></div>
                        <div class="dato-fila"><strong>Origen</strong><span>${c.brand.country}</span></div>
                        <div class="dato-fila"><strong>Gama</strong><span>${c.class || 'N/A'}</span></div>
                    </div>
                    <div id="tab-tecnico">
                        <div class="dato-fila"><strong>Combustible</strong><span>${c.type}</span></div>
                        <div class="dato-fila"><strong>Precio Base</strong><span>${formatMoney(c.price)}</span></div>
                    </div>
                </div>
            `;
            
            document.getElementById('ficha-container').innerHTML = tabsHTML;
            
            // INICIALIZAR JQUERY TABS
            $("#tabs-wrapper").tabs();

            // EXTRAS
            const extrasList = document.getElementById('extras');
            extrasList.innerHTML = ''; 

            if (c.extras && c.extras.length > 0) {
                c.extras.forEach(extra => {
                    const li = document.createElement('li');
                    const desc = extra.description ? extra.description : '';
                    li.innerHTML = `
                        <span class="extra-nombre" style="font-weight:bold;">${extra.name}</span>
                        <span class="extra-desc" style="display:block; font-size:0.9em; color:#666;">${desc}</span>
                    `;
                    extrasList.appendChild(li);
                });
            } else {
                extrasList.innerHTML = '<li>Sin extras especificados</li>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('nombre').textContent = "Error";
            document.getElementById('descripcion').textContent = "No se pudieron cargar los datos.";
        });
});