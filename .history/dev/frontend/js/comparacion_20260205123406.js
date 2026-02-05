document.addEventListener('DOMContentLoaded', () => {

    const carCards = document.querySelectorAll('.car-card');
    const slots = document.querySelectorAll('.drop-slot');

    let draggedCar = null;

    // --- DRAG START ---
    carCards.forEach(card => {
        card.addEventListener('dragstart', e => {
            draggedCar = card;
            e.dataTransfer.effectAllowed = 'move';
        });
    });

    // --- DROP SLOTS ---
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

            } catch (err) {
                console.error('Error al cargar coche:', err);
            }

            draggedCar = null;
        });
    });

    // --- RENDER SPECS ---
    function renderSpecs(container, car) {
        container.innerHTML = '';
        container.dataset.carId = car.id; // <-- Guardamos el id para POST

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

        // Ocultamos el texto "Arrastra coche"
        const p = container.parentElement.querySelector('p');
        if(p) p.style.display = 'none';
    }

    // --- BOTÓN REINICIAR ---
    const reiniciarBtn = document.getElementById('reiniciar-comparacion');
    reiniciarBtn.addEventListener('click', () => {
        slots.forEach(slot => {
            slot.querySelector('.specs').innerHTML = '';
            slot.querySelector('.specs').dataset.carId = '';
            const p = slot.querySelector('p');
            if(p) p.style.display = 'block';
        });
    });

    // --- BOTÓN COMPARAR ---
    const compararBtn = document.getElementById('compararBtn');
    compararBtn.addEventListener('click', () => {
        const carAId = document.querySelector('#slotA .specs').dataset.carId;
        const carBId = document.querySelector('#slotB .specs').dataset.carId;

        if (!carAId || !carBId) {
            alert('Selecciona ambos coches para comparar.');
            return;
        }

        fetch('/comparacion', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ car_a_id: carAId, car_b_id: carBId })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Comparación guardada ✅');
                reiniciarBtn.click(); // Reinicia los slots
            }
        })
        .catch(err => console.error(err));
    });

});
