const carCards = document.querySelectorAll('.car-card');
let draggedCarId = null;

// Slots de tabla
const slot1 = document.querySelector('.coche1');
const slot2 = document.querySelector('.coche2');

[slot1, slot2].forEach(slot => {
    slot.addEventListener('dragover', e => e.preventDefault());
    slot.addEventListener('dragenter', e => slot.classList.add('dragover'));
    slot.addEventListener('dragleave', e => slot.classList.remove('dragover'));
    slot.addEventListener('drop', async e => {
        e.preventDefault();
        slot.classList.remove('dragover');
        const carId = draggedCarId;
        if (!carId) return;

        const response = await fetch(`/api/cars/${carId}`);
        const data = await response.json();
        llenarSlot(slot, data);
    });
});

carCards.forEach(card => {
    card.addEventListener('dragstart', e => {
        draggedCarId = card.getAttribute('data-car-id');
    });
});

function llenarSlot(slot, data) {
    slot.innerHTML = ''; // limpiar

    // Imagen + nombre
    const img = document.createElement('img');
    img.src = '/' + data.image;
    img.alt = data.model;
    img.style.width = '100px';
    slot.appendChild(img);

    const nombre = document.createElement('div');
    nombre.textContent = `${data.brand.name} ${data.model}`;
    nombre.style.fontWeight = '600';
    slot.appendChild(nombre);

    // Extras
    const extras = data.extras.map(e => e.name).join(', ');
    const rows = slot.closest('table').querySelectorAll('tbody tr');

    const mapping = {
        brand: data.brand.name,
        model: data.model,
        hp: data.hp,
        torque: data.torque,
        engine_size: data.engine_size,
        fuel: data.fuel,
        transmission: data.transmission,
        year: data.year,
        km: data.km,
        weight: data.weight,
        price: data.price + ' €',
        extras: extras
    };

    rows.forEach(row => {
        const attr = row.getAttribute('data-attr');
        const cell = row.querySelector(`.${slot.classList[0]}`);
        if (mapping[attr] !== undefined) {
            cell.textContent = mapping[attr];
        }
    });
}
