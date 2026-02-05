document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.car-card');
    const dropZones = document.querySelectorAll('.drop-zone');

    // 1. Configuración de Arrastre (Drag)
    cards.forEach(card => {
        card.addEventListener('dragstart', (e) => {
            e.dataTransfer.setData('carId', card.dataset.id);
            e.dataTransfer.effectAllowed = 'copy';
        });
    });

    // 2. Configuración de Soltar (Drop)
    dropZones.forEach(zone => {
        zone.addEventListener('dragover', (e) => {
            e.preventDefault(); // Necesario para permitir el drop
            zone.classList.add('hover');
        });

        zone.addEventListener('dragleave', () => {
            zone.classList.remove('hover');
        });

        zone.addEventListener('drop', (e) => {
            e.preventDefault();
            zone.classList.remove('hover');
            
            const carId = e.dataTransfer.getData('carId');
            if(carId) loadCarData(carId, zone);
        });
    });

    // 3. Función AJAX para cargar datos
    async function loadCarData(id, zoneElement) {
        // Mostrar estado de carga (opcional)
        zoneElement.style.opacity = '0.5';

        try {
            const response = await fetch(`/comparador/api/coche/${id}`);
            const json = await response.json();

            if(json.success) {
                renderCar(json.data, zoneElement);
            }
        } catch (error) {
            console.error('Error cargando coche:', error);
            alert('Error al cargar datos del vehículo');
        } finally {
            zoneElement.style.opacity = '1';
        }
    }

    // 4. Renderizado del HTML dentro de la tarjeta
    function renderCar(data, zone) {
        const emptyState = zone.querySelector('.empty-state');
        const contentDiv = zone.querySelector('.car-content');

        // Ocultamos el mensaje de "Arrastra aquí"
        emptyState.style.display = 'none';
        contentDiv.classList.remove('hidden');

        // Construimos la lista de specs dinámicamente
        let specsHTML = '';
        data.specs.forEach(spec => {
            specsHTML += `
                <li class="spec-item">
                    <span style="color:#8b9bb4">${spec.label}</span>
                    <span>${spec.val} <small>${spec.unit}</small></span>
                </li>
            `;
        });

        // Inyectamos el HTML
        contentDiv.innerHTML = `
            <img src="${data.header.imagen}" class="detail-img">
            <div class="detail-header">
                <small style="color: #00ffb3">${data.header.marca}</small>
                <h2>${data.header.modelo}</h2>
                <span class="price">${data.precio.display}</span>
            </div>
            <ul class="specs-list">
                ${specsHTML}
            </ul>
        `;
    }
});