document.addEventListener('DOMContentLoaded', () => {
    
    const id = window.carId; 
    const rootUrl = window.assetUrl; // http://localhost/ o tu dominio
    
    // --- CORRECCIÓN IMPORTANTE ---
    // Usamos rootUrl para asegurarnos de que la ruta es correcta incluso en subcarpetas
    const apiUrl = `${rootUrl}api/cars/${id}`; 
    console.log("Consultando API:", apiUrl); // Esto te ayudará a ver errores en la consola (F12)

    const formatMoney = (amount) => {
        return Number(amount).toLocaleString('de-DE', { style: 'currency', currency: 'EUR' });
    };

    fetch(apiUrl)
        .then(response => {
            if (!response.ok) throw new Error("Error de red o coche no encontrado");
            return response.json();
        })
        .then(c => {
            // TÍTULO
            document.title = `${c.brand.name} ${c.model} | Ficha`;

            // IMAGEN
            // Si la imagen ya tiene http, la usamos tal cual. Si no, le pegamos la ruta base.
            const imagePath = c.image.startsWith('http') ? c.image : rootUrl + c.image;
            document.getElementById('img').src = imagePath;

            // TEXTOS
            document.getElementById('nombre').textContent = `${c.brand.name} ${c.model}`;
            document.getElementById('precio').textContent = formatMoney(c.price);
            document.getElementById('descripcion').textContent = c.description;
            document.getElementById('marca').textContent = c.brand.name;
            document.getElementById('tipo').textContent = c.type; // Asegúrate que en BBDD es 'type' o 'class'

            // TABS (Construcción del HTML)
            const tabsHTML = `
                <div id="tabs-wrapper">
                    <ul>
                        <li><a href="#tab-general">General</a></li>
                        <li><a href="#tab-motor">Motor</a></li>
                    </ul>
                    <div id="tab-general">
                        <div class="dato-fila"><strong>Año</strong><span>${c.year}</span></div>
                        <div class="dato-fila"><strong>Kilómetros</strong><span>${c.km} km</span></div>
                        <div class="dato-fila"><strong>Color</strong><span>${c.color}</span></div>
                        <div class="dato-fila"><strong>Peso</strong><span>${c.weight ? c.weight + ' kg' : '-'}</span></div>
                        <div class="dato-fila"><strong>Precio Base</strong><span>${formatMoney(c.price)}</span></div>
                    </div>
                    <div id="tab-motor">
                        <div class="dato-fila"><strong>Combustible</strong><span>${c.fuel}</span></div>
                        <div class="dato-fila"><strong>Transmisión</strong><span>${c.transmission}</span></div>
                        <div class="dato-fila"><strong>Motor</strong><span>${c.engine_size || 'Consultar'}</span></div>
                        <div class="dato-fila"><strong>Potencia</strong><span>${c.hp ? c.hp + ' CV' : '-'}</span></div>
                        <div class="dato-fila"><strong>Par motor</strong><span>${c.torque ? c.torque + ' Nm' : '-'}</span></div>
                    </div>
                </div>
            `;
            
            const container = document.getElementById('ficha-container');
            container.innerHTML = tabsHTML;
            
            // Inicializar Tabs de jQuery UI
            $("#tabs-wrapper").tabs();

            // EXTRAS
            const extrasList = document.getElementById('extras');
            extrasList.innerHTML = ''; 

            if (c.extras && c.extras.length > 0) {
                c.extras.forEach(extra => {
                    const li = document.createElement('li');
                    li.innerHTML = `<span style="font-weight:bold;">${extra.name}</span>`;
                    extrasList.appendChild(li);
                });
            } else {
                extrasList.innerHTML = '<li>Sin extras especificados</li>';
            }
        })
        .catch(error => {
            console.error('Error detectado:', error);
            document.getElementById('nombre').textContent = "Error de carga";
            document.getElementById('descripcion').textContent = "Verifica la consola (F12) para más detalles.";
        });
});