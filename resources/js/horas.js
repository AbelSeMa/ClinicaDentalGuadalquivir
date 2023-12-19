$('#fecha').change(function () {
    var fecha = $(this).val();

    $.ajax({
        url: '/horas-disponibles',
        type: 'GET',
        data: {fecha: fecha},
        dataType: 'json',
        success: function (response) {
            var horas = response.horas;

            var select = $('<select>').attr('name', 'hora');
            $.each(horas, function (index, hora) {
                $('<option>').val(hora).text(hora).appendTo(select);
            });
            $('#horas-disponibles').html(select);
        },
        error: function () {
            alert('Error al cargar las horas disponibles');
        }
    });
});