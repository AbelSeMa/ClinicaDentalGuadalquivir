$('.editar-cita').click(function () {
    var fecha = $(this).data('fecha');
    console.log(fecha);

    $('#hora').empty();
    
    // Realizar una solicitud AJAX para obtener las horas disponibles
    $.ajax({
        url: '/horas-disponibles',
        type: 'GET',
        data: {fecha: fecha},
        dataType: 'json',
        success: function (response) {
            var horas = response.horas;
            console.log(horas)

            // Generar las opciones de hora para el select
            var select = $('#hora');

            $.each(horas, function (index, hora) {
                let formateada = hora.split(':');
                $('<option>').val(hora).text(formateada[0] + ':' + formateada[1]).appendTo(select);
            });
        },
        error: function () {
            alert('Error al cargar las horas disponibles');
        }
    });

});
