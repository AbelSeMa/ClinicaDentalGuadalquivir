$('#fecha').change(function () {
    var fecha = $(this).val();
    var doctor = $('#doctor').val();
    console.log(fecha);

    $.ajax({
        url: '/horas-disponibles',
        type: 'GET',
        data: {fecha: fecha, doctor: doctor},
        dataType: 'json',
        success: function (response) {
            var horas = response.horas;
            console.log(horas)

            var select = $('#horas-disponibles');

            // Limpiar las opciones existentes
            select.empty();

            // Agregar las nuevas opciones
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