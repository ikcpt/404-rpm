// Lógica simple para el carrusel
let slideIndex = 0;

function moverSlide(n) {
    slideIndex += n;
    mostrarSlides();
}

function irASlide(n) {
    slideIndex = n;
    mostrarSlides();
}

function mostrarSlides() {
    let i;
    let slides = document.getElementsByClassName("slide");
    let puntos = document.getElementsByClassName("punto");
    if (slides.length == 0) return;

    if (slideIndex >= slides.length) {
        slideIndex = 0
    }
    if (slideIndex < 0) {
        slideIndex = slides.length - 1
    }

    for (i = 0; i < slides.length; i++) {
        slides[i].classList.remove("activa");
    }
    for (i = 0; i < puntos.length; i++) {
        puntos[i].classList.remove("activo");
    }
    slides[slideIndex].classList.add("activa");
    puntos[slideIndex].classList.add("activo");
}

document.addEventListener("DOMContentLoaded", function() {
    cargarResenas();
});

function cargarResenas() {
    const contenedor = document.getElementById('contenedor-resenas');

    // Petición al endpoint de la API de reseñas de Laravel
    fetch('/api/reviews')
        .then(response => response.json())
        .then(data => {
            if (!data.length) {
                contenedor.innerHTML = '<p style="text-align: center; padding: 2rem; background: #f9f9f9; border-radius: 8px;">Aún no hay reseñas. ¡Sé el primero en opinar!</p>';
                return;
            }

            // Creamos todo el HTML de una sola vez
            contenedor.innerHTML = data.map(review => {
                const nombre = review.user?.name ?? 'Cliente Anónimo';
                const inicial = nombre.charAt(0).toUpperCase();
                const fecha = new Date(review.created_at);
                
                // Truco para las estrellas: Repetir el caracter según el rating
                const estrellas = '★'.repeat(review.rating) + '<span style="color: #ddd;">★</span>'.repeat(5 - review.rating);

                return `
                    <article class="tarjeta-resena" style="background: #fff; padding: 2rem; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border-top: 4px solid #1e4fa3;">
                        <div class="header-resena" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <div class="usuario" style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 40px; height: 40px; background: #eee; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #666;">
                                    ${inicial}
                                </div>
                                <h3 style="margin: 0; font-size: 1.1rem; color: #333;">${nombre}</h3>
                            </div>
                            <div class="estrellas" style="color: #f1c40f; letter-spacing: 2px;">
                                ${estrellas}
                            </div>
                        </div>
                        <p style="color: #666; line-height: 1.6; font-style: italic; margin-bottom: 1rem;">"${review.content}"</p>
                        <small style="color: #999; display: block; text-align: right;">${fecha}</small>
                    </article>
                `;
            }).join(''); // Unimos todo el array en un solo texto
        })
        .catch(error => {
            console.error('Error:', error);
            contenedor.innerHTML = '<p style="text-align:center; color:red;">Error al cargar reseñas.</p>';
        });
}