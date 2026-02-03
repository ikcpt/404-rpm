document.addEventListener('DOMContentLoaded', () => {
    // Buscamos todos los botones que sirven para desplegar contenido
    const botonesDesplegar = document.querySelectorAll('.btn-desplegar');

    botonesDesplegar.forEach(boton => {
        boton.addEventListener('click', function() {
            // Leemos a qué div apunta este botón (ej: #extra-alta)
            const selectorObjetivo = this.getAttribute('data-target');
            const divObjetivo = document.querySelector(selectorObjetivo);

            if (divObjetivo) {
                // Si está oculto, lo mostramos
                if (divObjetivo.style.display === 'none' || divObjetivo.style.display === '') {
                    divObjetivo.style.display = 'block';
                    // Opcional: Cambiar texto del botón
                    if(this.textContent.includes('Ver')) {
                         this.textContent = 'Ver menos ↑';
                    }
                } 
                // Si está visible, lo ocultamos
                else {
                    divObjetivo.style.display = 'none';
                    // Restauramos texto (esto es genérico, puedes ajustarlo si quieres textos específicos)
                    if(this.textContent.includes('Ver')) {
                        this.textContent = 'Ver colección completa ↓';
                    }
                }
            }
        });
    });
});