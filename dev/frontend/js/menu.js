document.addEventListener('DOMContentLoaded', () => {
    const menu = document.querySelector('.navegacion-principal');
    const itemsConDesplegable = document.querySelectorAll('.item-con-desplegable');

    document.addEventListener('click', (e) => {
    if (e.target.closest('.boton-menu') || e.target.closest('.boton-cerrar-menu')) {
        const menu = document.querySelector('.navegacion-principal');
        menu.classList.toggle('activo');
        
        if (menu.classList.contains('activo')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = 'auto';
        }
    }
    if (e.target.matches('.navegacion-principal')) {
        const menu = document.querySelector('.navegacion-principal');
        menu.classList.remove('activo');
        document.body.style.overflow = 'auto';
    }
});

    itemsConDesplegable.forEach(item => {
        item.addEventListener('click', (e) => {
            if (window.innerWidth <= 1024) {
    
                if (e.target.closest('.enlace-perfil')) {
                     if (!item.classList.contains('activado')) {
                        e.preventDefault();
                     }
                }
                item.classList.toggle('activado');
            }
        });
    });
});