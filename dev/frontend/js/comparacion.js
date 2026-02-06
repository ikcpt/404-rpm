document.addEventListener('DOMContentLoaded', () => {

    const carCards = document.querySelectorAll('.car-card');
    const slots = document.querySelectorAll('.drop-slot');
    const compararBtn = document.getElementById('btnComparar');
    const reiniciarBtn = document.getElementById('reiniciar-comparacion');
    let draggedCar = null;

    // DRAG START
    carCards.forEach(card => {
        card.addEventListener('dragstart', e => {
            draggedCar = card;
            e.dataTransfer.effectAllowed = 'move';
        });
    });

    // DROP SLOTS
    slots.forEach(slot => {
        slot.addEventListener('dragover', e => {
            e.preventDefault();
            slot.classList.add('drag-over');
        });

        slot.addEventListener('dragleave', () => {
            slot.classList.remove('drag-over');
        });

        slot.addEventListener('drop', async () => {
            slot.classList.remove('drag-over');
            if (!draggedCar) return;

            const carId = draggedCar.dataset.id;

            try {
                const response = await fetch(`/comparacion/${carId}`);
                const car = await response.json();

                renderSpecs(slot.querySelector('.specs'), car);

                // Comprobamos si ambos slots tienen coche
                const carAId = document.querySelector('#slotA .specs').dataset.carId;
                const carBId = document.querySelector('#slotB .specs').dataset.carId;
                compararBtn.disabled = !(carAId && carBId);

                if (carAId && carBId) {
                    await guardarComparacion(carAId, carBId);
                }

            } catch (err) {
                console.error('Error al cargar coche:', err);
            }

            draggedCar = null;
        });
    });

    // RENDER SPECS
    function renderSpecs(container, car) {
        container.innerHTML = '';
        container.dataset.carId = car.id;

        const specs = [
            { name: 'Marca', value: car.brand.name },
            { name: 'Modelo', value: car.model },
            { name: 'Par (Nm)', value: car.torque },
            { name: 'Año', value: car.year },
            { name: 'Kilómetros', value: car.km },
            { name: 'Transmisión', value: car.transmission },
            { name: 'Combustible', value: car.fuel },
            { name: 'Extras', value: car.extras.map(e => e.name).join(', ') },
            { name: 'Precio (€)', value: car.price }
        ];

        specs.forEach(spec => {
            const div = document.createElement('div');
            div.classList.add('spec-item');
            div.innerHTML = `<span class="spec-name">${spec.name}</span><span class="spec-value">${spec.value}</span>`;
            container.appendChild(div);
        });

        const p = container.parentElement.querySelector('p');
        if(p) p.style.display = 'none';
    }

    // GUARDAR AUTOMÁTICAMENTE LA COMPARACIÓN
    async function guardarComparacion(carAId, carBId) {
        try {
            const res = await fetch('/comparacion', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ car_a_id: carAId, car_b_id: carBId })
            });
            const data = await res.json();
            if (data.success) {
                console.log('Comparación guardada ✅', data.comparacion_id);

            }
        } catch (err) {
            console.error('Error guardando comparación:', err);
        }
    }

    // BOTÓN REINICIAR
    reiniciarBtn.addEventListener('click', () => {
        slots.forEach(slot => {
            slot.querySelector('.specs').innerHTML = '';
            slot.querySelector('.specs').dataset.carId = '';
            const p = slot.querySelector('p');
            if(p) p.style.display = 'block';
        });
        compararBtn.disabled = true;
    });

});

function filterCars(brandId, btnElement) {
    // 1. GESTIÓN DE BOTONES (ESTÉTICA)
    // Quitamos la clase 'active' de todos los botones
    const allButtons = document.querySelectorAll('.brand-btn');
    allButtons.forEach(btn => btn.classList.remove('active'));
    
    // Se la ponemos solo al que hemos hecho clic
    btnElement.classList.add('active');


    // 2. FILTRADO DE COCHES (LÓGICA)
    const allCars = document.querySelectorAll('.car-card');

    allCars.forEach(car => {
        // Obtenemos el ID de marca de la tarjeta (el que pusimos en el HTML)
        const carBrandId = car.getAttribute('data-brand-id');

        // Lógica: Si pulsamos "Todas" ('all') O el ID coincide...
        // Usamos '==' en vez de '===' para que no importe si es texto o número
        if (brandId === 'all' || carBrandId == brandId) {
            
            car.classList.remove('hidden'); // Lo mostramos
            
            // Reiniciamos la animación para que quede bonito
            car.classList.remove('fade-in');
            void car.offsetWidth; // Truco para reiniciar animación CSS
            car.classList.add('fade-in');

        } else {
            car.classList.add('hidden'); // Lo ocultamos
        }
    });
}