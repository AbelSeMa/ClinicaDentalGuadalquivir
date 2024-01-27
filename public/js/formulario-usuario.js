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
            alert('El formulario no ha sido completado correctamente. Por favor verifique los campos en color rojo.');
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
        var regexDireccion = /^[a-zA-ZzÑñÁáÉéÍíÓóÚúÜü0-9\s\º\-\/\.,]+$/;
        var regexTelefono = /^(956\d{6}|[67]\d{8})$/;
        var regexDNI = /^[0-9]{8}[a-zA-Z]$/;
        var regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


        let isValid = true;

        if (!regexAlfabetico.test(nombre)) {
            // La validación falla

            document.getElementById('nombre').className = 'border-red-600';
            isValid =  false;
        }

        if (!regexAlfabetico.test(apellido)) {

            document.getElementById('apellido').className = 'border-red-500';
            isValid =  false;
        }

        if (!regexDireccion.test(direccion)) {

            document.getElementById('direccion').className = 'border-red-500';
            isValid =  false;
        }

        if (!regexTelefono.test(telefono)) {

            document.getElementById('telefono').className = 'border-red-500';
            isValid =  false;
        }


        if (dni) {
            var regexDNI = /^[0-9]{8}[a-zA-Z]$/;

            // Verificar el formato del DNI
            if (!regexDNI.test(dni)) {
                document.getElementById('dni').className = 'border-red-500';
                isValid =  false;
            }

            // Extraer el número y la letra del DNI
            var numero = dni.substring(0, 8);
            var letra = dni.charAt(8).toUpperCase();

            // Calcular la letra esperada
            var letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
            var letraEsperada = letras[numero % 23];

            // Verificar si la letra coincide
            if (letra !== letraEsperada) {
                isValid = false;
            }
        }

        if (nacimiento) {
           
                // Crear objeto de fecha a partir de la fecha de nacimiento
                var fechaNacimientoDate = new Date(nacimiento);
            
                // Crear objeto de fecha para la fecha actual
                var fechaActual = new Date();
            
                // Calcular la diferencia en años
                var edad = fechaActual.getFullYear() - fechaNacimientoDate.getFullYear();
            
                // Restar un año si la persona aún no ha tenido su cumpleaños este año
                if (fechaActual.getMonth() < fechaNacimientoDate.getMonth() ||
                    (fechaActual.getMonth() == fechaNacimientoDate.getMonth() && fechaActual.getDate() < fechaNacimientoDate.getDate())) {
                    edad--;
                }
            
                // Verificar si la persona tiene al menos 18 años y no más de 100 años
                if (edad < 18 || edad > 100) {
                    document.getElementById('nacimiento').className = 'border-red-500';
                    isValid =  false;
                }

        }
        if (!regexCorreo.test(correo)) {
            document.getElementById('correo').className = 'border-red-500';
            isValid =  false;
        }
        // La validación es exitosa
        return isValid;
    }
});