function trabajadorExiste() {
    var radios = document.getElementsByName("respuesta");
    var selectContainer = document.getElementById("selectUsuarios");
    selectContainer.innerHTML = ""; // Limpiar el contenedor

    // Llamada AJAX para obtener usuarios no registrados
    $.ajax({
        url: "/usuarios-sin-roles",
        method: "GET",
        dataType: "json",
        success: function (data) {
            // Crear el select y agregar opciones
            var select = document.createElement("select");
            select.name = "usuario";
            select.id = "usuarios_sin_roles";

            var labelSelect = document.createElement("label");
            labelSelect.classList.add(
                "block",
                "text-sm",
                "font-medium",
                "text-gray-900",
                "dark:text-white"
            );
            labelSelect.for = "usuarios_sin_roles";
            labelSelect.textContent = "Selecciona al usuario";

            var defaultOption = document.createElement("option");
            defaultOption.value = "";
            defaultOption.text = "Seleccione un usuario";
            select.appendChild(defaultOption);

            data.users.forEach(function (user) {
                var option = document.createElement("option");
                option.value = user.id;
                option.text = user.first_name + " " + user.last_name;
                select.appendChild(option);
            });

            // Agregar el select al contenedor
            selectContainer.innerHTML = ""; // Limpiar el contenedor
            selectContainer.appendChild(labelSelect);
            selectContainer.appendChild(select);


            // Escuchar el evento de cambio del nuevo select
            $(select).change(function () {
                let divTitulo = document.getElementById("titulo");
                let divEspecialidad = document.getElementById("especialidad");

                var labelTitulacion = document.createElement("label");
                labelTitulacion.classList.add(
                    "block",
                    "text-sm",
                    "font-medium",
                    "text-gray-900",
                    "dark:text-white"
                );
                labelTitulacion.for = "titulacion";
                labelTitulacion.textContent = "Titulación";

                let titulo = document.createElement("input");
                titulo.type = "text";
                titulo.classList.add(
                    "bg-gray-50",
                    "border",
                    "border-gray-300",
                    "text-gray-900",
                    "sm:text-sm",
                    "rounded-lg",
                    "focus:ring-primary-600",
                    "focus:border-primary-600",
                    "block",
                    "w-full",
                    "p-2.5",
                    "dark:bg-gray-700",
                    "dark:border-gray-600",
                    "dark:placeholder-gray-400",
                    "dark:text-white",
                    "dark:focus:ring-blue-500",
                    "dark:focus:border-blue-500"
                );
                titulo.name = "titulacion";
                titulo.id = "titulacion";
                titulo.placeholder = "Indica la titulación del trabajador.";


                divTitulo.appendChild(labelTitulacion);
                divTitulo.appendChild(titulo);


                var labelEspecializacion = document.createElement("label");
                labelEspecializacion.classList.add(
                    "block",
                    "text-sm",
                    "font-medium",
                    "text-gray-900",
                    "dark:text-white"
                );
                labelEspecializacion.for = "especializacion";
                labelEspecializacion.textContent = "Especialización";

                let especializacion = document.createElement("input");
                especializacion.type = "text";
                especializacion.classList.add(
                    "bg-gray-50",
                    "border",
                    "border-gray-300",
                    "text-gray-900",
                    "sm:text-sm",
                    "rounded-lg",
                    "focus:ring-primary-600",
                    "focus:border-primary-600",
                    "block",
                    "w-full",
                    "p-2.5",
                    "dark:bg-gray-700",
                    "dark:border-gray-600",
                    "dark:placeholder-gray-400",
                    "dark:text-white",
                    "dark:focus:ring-blue-500",
                    "dark:focus:border-blue-500"
                );
                especializacion.name = "especializacion";
                especializacion.id = "especializacion";
                especializacion.placeholder =
                    "Indica la especializacion del trabajador.";


                divEspecialidad.appendChild(labelEspecializacion);
                divEspecialidad.appendChild(especializacion);
            });
        },
        error: function (error) {
            console.error("Error:", error);
        },
    });
}



document.addEventListener('DOMContentLoaded', function () {
    var formulario = document.getElementById('contenido');

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
        var titulo = document.getElementById('titulacion').value;
        var especialidad = document.getElementById('especializacion').value;

        // Realizar la validación (cadena de letras incluyendo mayúsculas)
        var expresionRegular = /^[A-Za-z]+$/;

        if (!expresionRegular.test(titulo)) {
            // La validación falla
            let div = document.getElementById('titulo');
            let br = document.createElement('br')

            document.getElementById('titulacion').className = 'border-red-500';
            let span = document.createElement('span');
            span.textContent = "Error! Sólo se admiten caracteres alfabéticos";
            span.classList.add('text-sm', 'text-red-800')
            div.appendChild(br);
            div.appendChild(span);
            return false;
        }

        if (!expresionRegular.test(especialidad)) {
            // La validación falla
            let div = document.getElementById('especialidad');
            let br = document.createElement('br')

            document.getElementById('especializacion').className = 'border-red-500';
            let span = document.createElement('span');
            span.textContent = "Error! Sólo se admiten caracteres alfabéticos";
            span.classList.add('text-sm', 'text-red-800')
            div.appendChild(br);
            div.appendChild(span);
            return false;
        }

        // La validación es exitosa
        return true;
    }
});
