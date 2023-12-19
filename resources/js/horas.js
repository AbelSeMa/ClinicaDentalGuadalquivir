$('#fecha').change(function () {
    var fecha = $(this).val();

    $.ajax({
        url: '/horas-disponibles',
        type: 'GET',
        data: {fecha: fecha},
        dataType: 'json',
        success: function (response) {
            var horas = response.horas;
            console.log(horas)

            var select = $('#horas-disponibles');

            // Limpiar las opciones existentes
            select.empty();

            // Agregar las nuevas opciones
            $.each(horas, function (index, hora) {
                $('<option>').val(hora).text(hora).appendTo(select);
            });
        },
        error: function () {
            alert('Error al cargar las horas disponibles');
        }
    });
});