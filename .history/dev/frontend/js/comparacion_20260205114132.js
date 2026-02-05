document.addEventListener('DOMContentLoaded', () => {
    
    const cards = document.querySelectorAll('.car-card');
    const zones = document.querySelectorAll('.drop-slot'); // Asegúrate que en el HTML sea class="drop-slot"

    // DRAG (Arrastrar)
    cards.forEach(card => {
        card.addEventListener('dragstart', (e) => {
            e.dataTransfer.setData('id', card.dataset.id);
        });
    });

    // DROP (Soltar)
    zones.forEach(zone => {
        zone.addEventListener('dragover', (e) => {
            e.preventDefault();
            zone.classList.add('hover');
        });

        zone.addEventListener('dragleave', () => {
            zone.classList.remove('hover');
        });

        zone.addEventListener('drop', async (e) => {
            e.preventDefault();
            zone.classList.remove('hover');
            
            const id = e.dataTransfer.getData('id');
            if(!id) return;

            try {
                zone.style.opacity = '0.5';
                
                // Petición a la API
                const response = await fetch(`/comparacion/api/${id}`);
                const json = await response.json();

                // PARA DEPURAR: Mira la consola (F12) para ver tus datos reales
                console.log("Datos recibidos del coche:", json);

                if(json.success) {
                    renderCar(json.data, zone);
                } else {
                    alert('Error: ' + (json.message || 'Error desconocido'));
                }
            } catch (err) {
                console.error(err);
                alert('Error al conectar con el servidor.');
            } finally {
                zone.style.opacity = '1';
            }
        });
    });

    function renderCar(data, zone) {
        // Generar lista de especificaciones (filtra las que sean N/A si quieres que no salgan)
        const specsHTML = data.specs
            .map(spec => 
            `<li style="display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid rgba(255,255,255,0.1)">
                <span style="color:#aaa">${spec.label}</span>
                <span style="font-weight:bold; color:white;">${spec.val}</span>
             </li>`
        ).join('');

        zone.innerHTML = `
            <div style="text-align:center; animation: fadeIn 0.5s; width:100%">
                <img src="${data.header.imagen}" style="width:100%; border-radius:10px; margin-bottom:15px; max-height:200px; object-fit:cover;">
                <h3 style="margin:5px 0; color:white;">${data.header.modelo}</h3>
                <small style="color:#00ffb3; text-transform:uppercase; letter-spacing:1px;">${data.header.marca}</small>
                <h2 style="color:#fff; margin:15px 0; font-size:1.8rem;">${data.precio.display}</h2>
                <ul style="list-style:none; padding:0; text-align:left; margin-top:20px; font-size:0.9rem;">
                    ${specsHTML}
                </ul>
            </div>
        `;
    }
});