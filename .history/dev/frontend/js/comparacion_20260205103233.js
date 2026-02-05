const cards = document.querySelectorAll(".car-card")
const slots = document.querySelectorAll(".drop-slot")

let currentId = null

cards.forEach(card => {
    card.addEventListener("dragstart", () => {
        currentId = card.dataset.id
    })
})

slots.forEach(slot => {

    slot.addEventListener("dragover", e => {
        e.preventDefault()
        slot.classList.add("hover")
    })

    slot.addEventListener("dragleave", () => {
        slot.classList.remove("hover")
    })

    slot.addEventListener("drop", e => {
        e.preventDefault()
        slot.classList.remove("hover")
        cargarDatos(currentId, slot)
    })
})

function cargarDatos(id, slot){

    fetch(`/comparacion/${id}`)
        .then(res => res.json())
        .then(data => {

            const specs = slot.querySelector(".specs")

            specs.innerHTML = `
                <h3>${data.model}</h3>
                <ul>
                    <li>Marca: ${data.brand.name}</li>
                    <li>Motor: ${data.engine_size}</li>
                    <li>Potencia: ${data.hp} CV</li>
                    <li>Tipo: ${data.type}</li>
                    <li>Transmisión: ${data.transmission}</li>
                    <li>Año: ${data.year}</li>
                    <li>Color: ${data.color}</li>
                    <li>Kilómetros: ${data.km}</li>
                    <li>Precio: ${data.price.toLocaleString('es-ES', { style: 'currency', currency: 'EUR' })}</li>
                    <li>Extras: ${data.extras.map(e => e.name).join(', ')}</li>
                    <li>Descripción: ${data.description}</li>
                </ul>
                <img src="${data.image}" style="width:100%; margin-top:10px; border-radius:8px;">
            `
        })
}
