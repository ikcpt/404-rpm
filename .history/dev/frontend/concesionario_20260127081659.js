const botones = document.querySelectorAll('.btn-ver');

botones.forEach(boton => {
    boton.addEventListener('click', e => {
        const card = e.target.closest('.card-coche');
        const id = card.dataset.id;
        window.location.href = `base.html?id=${id}`;
    });
});
