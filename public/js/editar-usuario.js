document.addEventListener("DOMContentLoaded", function () {
    var formulario = document.getElementById("edit-usuario");

    formulario.addEventListener("submit", function (event) {
        event.preventDefault();

        if (validarFormulario()) {
            formulario.submit();
        } else {
            alert(
                "El formulario no ha sido completado correctamente. Por favor verifique los campos en color rojo."
            );
        }
    });

    function validarFormulario() {

        var errores = {};
        var isValid = true;

        if (!nombre(errores)) {
            isValid = false;
        }

        if (!apellido(errores)) {
            isValid = false;
        }

        if (!direccion(errores)) {
            isValid = false;
        }

        if (!telefono(errores)) {
            isValid = false;
        }

        if (!dni(errores)) {
            isValid = false;
        }

        if (!nacimiento(errores)) {
            isValid = false;
        }

        if (!correo(errores)) {
            isValid = false;
        }

        var mensajesError = document.getElementsByClassName('error-message');
        while (mensajesError[0]) {
            mensajesError[0].parentNode.removeChild(mensajesError[0]);
        }

        if (!isValid) {
            mostrarErrores(errores)
        }

        return isValid;
    }


});

document.addEventListener("DOMContentLoaded", function () {
    var formulario = document.getElementById("edit-password");

    formulario.addEventListener("submit", function (event) {
        event.preventDefault();

        if (validarFormulario()) {
            formulario.submit();
        } else {
            alert(
                "El formulario no ha sido completado correctamente. Por favor verifique los campos en color rojo."
            );
        }
    });

    function validarFormulario() {

        var errores = {};
        var isValid = true;


        if (!password(errores)) {
            isValid = false;
        }

        var mensajesError = document.getElementsByClassName('error-message');
        while (mensajesError[0]) {
            mensajesError[0].parentNode.removeChild(mensajesError[0]);
        }

        if (!isValid) {
            mostrarErrores(errores)
        }

        return isValid;
    }


});

function mostrarErrores(errores) {
    for (var campo in errores) {
        var mensajeError = errores[campo];
        var elemento = document.getElementById(campo);

        // Eliminar el mensaje de error existente, si lo hay
        var errorExistente = document.getElementById(campo + '-error');
        if (errorExistente) {
            errorExistente.remove();
        }

        // Crear un elemento para el mensaje de error
        var errorDiv = document.createElement("div");
        errorDiv.id = campo + '-error'; // Asegúrate de que cada mensaje de error tenga un ID único
        errorDiv.className = "error-message block mt-2 text-sm text-red-600 dark:text-red-500";
        errorDiv.innerText = mensajeError;

        // Añadir el mensaje de error después del campo de entrada
        elemento.parentNode.insertBefore(errorDiv, elemento.nextSibling);
    }
}