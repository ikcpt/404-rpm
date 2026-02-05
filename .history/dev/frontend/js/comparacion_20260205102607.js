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
                <h3>${data.modelo}</h3>
                <ul>
                    <li>Potencia: ${data.potencia} CV</li>
                    <li>Motor: ${data.motor}</li>
                    <li>0-100: ${data.cero_cien}s</li>
                    <li>Velocidad máx: ${data.velocidad} km/h</li>
                    <li>Precio: ${data.precio} €</li>
                </ul>
            `
        })
}
