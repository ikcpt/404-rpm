document.addEventListener('DOMContentLoaded', () => {
        const boton = document.querySelector('.boton-menu');
        const menu = document.querySelector('.navegacion-principal');
        const itemsConDesplegable = document.querySelectorAll('.item-con-desplegable');

        boton.addEventListener('click', () => {
            menu.classList.toggle('activo');
        });

        menu.addEventListener('click', (e) => {
            if (e.target === menu) {
                menu.classList.remove('activo');
            }
        });

        itemsConDesplegable.forEach(item => {
            item.addEventListener('click', (e) => {
                if (window.innerWidth <= 1024) {
                     if (e.target.closest('.enlace-perfil')) {
                         e.preventDefault(); 
                     }
                    item.classList.toggle('activado');
                }
            });
        });
    });