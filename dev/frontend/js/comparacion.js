$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Hacemos los coches arrastrables
    $('.car-card').attr('draggable', true);
    let draggedCar = null;

    // Cuando empieza a arrastrar
    $('.car-card').on('dragstart', function (e) {
        draggedCar = $(this);
        e.originalEvent.dataTransfer.effectAllowed = 'move';
    });

    // Dragover & Drop de los slots
    $('.drop-slot').on('dragover', function (e) {
        e.preventDefault();
        $(this).addClass('drag-over');
    });

    $('.drop-slot').on('dragleave', function () {
        $(this).removeClass('drag-over');
    });

    $('.drop-slot').on('drop', function (e) {
        e.preventDefault();
        $(this).removeClass('drag-over');

        if (!draggedCar) return;

        let slot = $(this);
        let carId = draggedCar.data('id');

        // Limpiamos slot si ya había coche
        slot.find('.specs').html('');
        slot.find('.specs').data('car-id', '');
        slot.find('p').show();

        // Traemos datos del coche
        $.getJSON('/comparacion/' + carId, function (car) {

            // Render specs
            renderSpecs(slot.find('.specs'), car);

            // Comprobamos si ambos slots tienen coche
            let carAId = $('#slotA .specs').data('car-id');
            let carBId = $('#slotB .specs').data('car-id');

            if (carAId && carBId) {
                $('#btnComparar').prop('disabled', false);

                // Guardar automáticamente en BD
                $.post('/comparacion', {
                    car_a_id: carAId,
                    car_b_id: carBId,
                    _token: $('meta[name="csrf-token"]').attr('content')
                }, function (data) {
                    console.log('Comparación guardada ✅', data.comparacion_id);
                }, 'json');
            } else {
                $('#btnComparar').prop('disabled', true);
            }
        });

        draggedCar = null;
    });

    // Función para renderizar specs
    function renderSpecs(container, car) {
        container.html('');
        container.data('car-id', car.id);

        let specs = [
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

        specs.forEach(function (spec) {
            container.append(
                '<div class="spec-item">' +
                '<span class="spec-name">' + spec.name + '</span>' +
                '<span class="spec-value">' + spec.value + '</span>' +
                '</div>'
            );
        });

        container.parent().find('p').hide();
    }

    // Botón reiniciar
    $('#reiniciar-comparacion').on('click', function () {

        // Limpiar vista
        $('.drop-slot .specs').each(function () {
            $(this).html('');
            $(this).data('car-id', '');
            $(this).parent().find('p').show();
        });

        $('#btnComparar').prop('disabled', true);

        // Borrar comparación en BD
        $.ajax({
            url: '/comparacion',
            type: 'DELETE'
        });
    });

});

// Filtrado de coches
function filterCars(brandId, btnElement) {
    $('.brand-btn').removeClass('active');
    $(btnElement).addClass('active');

    $('.car-card').each(function () {
        let carBrandId = $(this).data('brand-id');

        if (brandId === 'all' || carBrandId == brandId) {
            $(this).removeClass('hidden');
        } else {
            $(this).addClass('hidden');
        }
    });
}
