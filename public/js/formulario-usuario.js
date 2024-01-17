document.addEventListener('DOMContentLoaded', function () {
    var formulario = document.getElementById('form-usuario');

    formulario.addEventListener('submit', function (event) {
        // Cancelar el envío predeterminado del formulario
        event.preventDefault();

        // Realizar la validación
        if (validarFormulario()) {
            // Si la validación es exitosa, enviar el formulario
            formulario.submit();
        } else {
            // Si la validación falla, puedes mostrar mensajes de error o realizar otras acciones
            alert('La validación del formulario falló. Por favor, corrija los errores.');
        }
    });

    function validarFormulario() {
        // Obtener el valor del campo de título
        var nombre = document.getElementById('nombre').value;
        var apellido = document.getElementById('apellido').value;
        var direccion = document.getElementById('direccion').value;
        var telefono = document.getElementById('telefono').value;
        var nacimiento = document.getElementById('nacimiento').value;
        var dni = document.getElementById('dni').value;
        var correo = document.getElementById('email').value;

        // Realizar la validación (cadena de letras incluyendo mayúsculas)
        var regexAlfabetico = /^[A-Za-zÑñÁáÉéÍíÓóÚúÜü]+$/;
        var regexDireccion = /^[a-zA-Z0-9\s\-\/\.,]+$/;
        var regexTelefono = /^(956\d{6}|[67]\d{8})$/;
        var regexDNI = /^[0-9]{8}[a-zA-Z]$/;
        var regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


        if (!regexAlfabetico.test(nombre)) {
            // La validación falla

            document.getElementById('nombre').className = 'border-red-600';
            return false;
        }

        if (!regexAlfabetico.test(apellido)) {

            document.getElementById('apellido').className = 'border-red-500';
            return false;
        }

        if (!regexDireccion.test(direccion)) {

            document.getElementById('direccion').className = 'border-red-500';
            return false;
        }

        if (!regexTelefono.test(telefono)) {

            document.getElementById('telefono').className = 'border-red-500';
            return false;
        }


        if (dni) {
            var regexDNI = /^[0-9]{8}[a-zA-Z]$/;

            // Verificar el formato del DNI
            if (!regexDNI.test(dni)) {
                document.getElementById('telefono').className = 'border-red-500';
                return false;
            }

            // Extraer el número y la letra del DNI
            var numero = dni.substring(0, 8);
            var letra = dni.charAt(8).toUpperCase();

            // Calcular la letra esperada
            var letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
            var letraEsperada = letras[numero % 23];

            // Verificar si la letra coincide
            return letra === letraEsperada;


        }

        if (!regexCorreo.test(correo)) {
            document.getElementById('correo').className = 'border-red-500';
            return false;
        }
        // La validación es exitosa
        return true;
    }
});