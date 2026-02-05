document.addEventListener('DOMContentLoaded', () => {

    const carCards = document.querySelectorAll('.car-card');
    const slots = document.querySelectorAll('.drop-slot');

    let draggedCar = null;

    // Inicia el arrastre
    carCards.forEach(card => {
        card.addEventListener('dragstart', e => {
            draggedCar = card;
            e.dataTransfer.effectAllowed = 'move';
        });
    });

    // Zona donde se puede soltar
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
                // Traemos los datos del coche vía AJAX
                const response = await fetch(`/comparacion/${carId}`);
                const car = await response.json();

                renderSpecs(slot.querySelector('.specs'), car);

            } catch (err) {
                console.error('Error al cargar coche:', err);
            }

            draggedCar = null;
        });
    });

    // Función para renderizar especificaciones
    function renderSpecs(container, car) {
        container.innerHTML = '';

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

            const spanName = document.createElement('span');
            spanName.classList.add('spec-name');
            spanName.textContent = spec.name;

            const spanValue = document.createElement('span');
            spanValue.classList.add('spec-value');
            spanValue.textContent = spec.value;

            div.appendChild(spanName);
            div.appendChild(spanValue);
            container.appendChild(div);
        });
    }
// Botón para reiniciar comparacion
const reiniciarBtn = document.getElementById('reiniciar-comparacion');

reiniciarBtn.addEventListener('click', () => {
    slots.forEach(slot => {
        slot.querySelector('.specs').innerHTML = '';
        slot.querySelector('p').style.display = 'block'; // vuelve a mostrar texto "Arrastra coche"
    });
});



});
