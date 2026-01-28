document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.btn-ver').forEach(btn => {
        btn.addEventListener('click', e => {

            const card = e.target.closest('.card-coche');
            const id = card.dataset.id;

            window.location.href = `base.html?id=${id}`;
        });
    });

});
