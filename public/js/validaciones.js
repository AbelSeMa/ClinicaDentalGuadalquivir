function nombre(errores) {
    var nombre = document.getElementById("nombre").value;
    var regexAlfabetico = /^[A-Za-zÑñÁáÉéÍíÓóÚúÜü]+$/;

    if (!regexAlfabetico.test(nombre)) {
        errores["nombre"] =
            "El nombre es inválido. Debe contener sólo letras.";
            document.getElementById("nombre").classList.remove("border-gray-300");
            document.getElementById("nombre").classList.add("border-red-300");  
        return false
    }

    document.getElementById("nombre").classList.remove("border-red-300");
    document.getElementById("nombre").classList.add("border-gray-300");

    return true
}

function apellido(errores) {
    var apellido = document.getElementById("apellido").value;
    var regexAlfabetico = /^[A-Za-zÑñÁáÉéÍíÓóÚúÜü]+$/;

    if (!regexAlfabetico.test(apellido)) {
        errores["apellido"] =
            "El apellido es inválido. Debe contener sólo letras.";
           document.getElementById("apellido").classList.remove("border-gray-300");
            document.getElementById("apellido").classList.add("border-red-300");
        return false;

    }
    document.getElementById("apellido").classList.remove("border-red-300");
    document.getElementById("apellido").classList.add("border-gray-300");

    return true;

}

function direccion(errores) {
    var direccion = document.getElementById("direccion").value;
    var regexDireccion = /^[a-zA-ZzÑñÁáÉéÍíÓóÚúÜü0-9\s\º\-\/\.,]+$/;

    if (!regexDireccion.test(direccion)) {
        errores["direccion"] = "La dirección es inválida.";
        document.getElementById("direccion").classList.remove("border-gray-300");
        document.getElementById("direccion").classList.add("border-red-300");
        return false;
    }
    document.getElementById("direccion").classList.remove("border-red-300");
    document.getElementById("direccion").classList.add("border-gray-300");

    return true

}


function telefono(errores) {
    var telefono = document.getElementById("telefono").value;
    var regexTelefono = /^(956\d{6}|[67]\d{8})$/;

    if (!regexTelefono.test(telefono)) {
        errores["telefono"] =
            "El teléfono es invalido. Asegurate que empiece por el prefijo (956) o si es un móvil por alguno de estos dígitos (6-7-8-9).";
            document.getElementById("telefono").classList.remove("border-gray-300");
            document.getElementById("telefono").classList.add("border-red-300");
        isValid = false;

    }
    document.getElementById("telefono").classList.remove("border-red-300");
    document.getElementById("telefono").classList.add("border-gray-300");

    return true
}


function dni(errores) {
    var dni = document.getElementById("dni").value;
    var regexDNI = /^[0-9]{8}[a-zA-Z]$/;

    if (!regexDNI.test(dni)) {
        errores["dni"] = "El DNI no tiene un formato válido.";
        document.getElementById("dni").classList.remove("border-gray-300");
        document.getElementById("dni").classList.add("border-red-300");
        return false;
    }

    var numero = dni.substring(0, 8);
    var letra = dni.charAt(8).toUpperCase();

    var letras = "TRWAGMYFPDXBNJZSQVHLCKE";
    var letraEsperada = letras[numero % 23];

    if (letra !== letraEsperada) {
        errores["dni"] = "El DNI no ha podido ser validado. Comprueba que que el nº de identificación sea correcto.";
        document.getElementById("dni").classList.remove("border-gray-300");
        document.getElementById("dni").classList.add("border-red-300");
        return false;
    }
    document.getElementById("dni").classList.remove("border-red-300");
    document.getElementById("dni").classList.add("border-gray-300");

    return true
}

function nacimiento(errores) {
    var nacimiento = document.getElementById("nacimiento").value;

    var fechaNacimientoDate = new Date(nacimiento);

    var fechaActual = new Date();

    var edad =
    fechaActual.getFullYear() - fechaNacimientoDate.getFullYear();

    if (
        fechaActual.getMonth() < fechaNacimientoDate.getMonth() ||
        (fechaActual.getMonth() == fechaNacimientoDate.getMonth() &&
            fechaActual.getDate() < fechaNacimientoDate.getDate())
    ) {
        edad--;
    }

    if (edad < 18) {
        document.getElementById("nacimiento").classList.remove("border-gray-300");
        document.getElementById("nacimiento").classList.add("border-red-300");
        errores["nacimiento"] = "Debes ser mayor de edad.";
        return false;
    }

    if (edad > 110) {
        document.getElementById("nacimiento").classList.remove("border-gray-300");
        document.getElementById("nacimiento").classList.add("border-red-300");
        errores["nacimiento"] =
            "Verifica la fecha de nacimiento. Si es correcta y tienes más de 110 años ponte en contacto con la dirección de la clínica";
        return false;
    }
    document.getElementById("nacimiento").classList.remove("border-red-300");
    document.getElementById("nacimiento").classList.add("border-gray-300");

    return true
}

function password(errores) {
    var password = document.getElementById("password").value;

    let mayus = /[A-Z]/;
    let minus = /[a-z]/;
    let num = /[0-9]/;


    if (password.length < 8) {
        document.getElementById("password").classList.remove("border-gray-300");
        document.getElementById("password").classList.add("border-red-300");
        errores["password"] =
            "La contraseña debe tener una longitud de al menos 8 carácteres.";
        return false;
    }

    if (!mayus.test(password) && !minus.test(password)) {
        document.getElementById("password").classList.remove("border-gray-300");
        document.getElementById("password").classList.add("border-red-300");
        errores["password"] =
            "La contraseña debe contener una letra mayúscula y una minúscula.";
        return false;
    }

    if (!num.test(password)) {
        document.getElementById("password").classList.remove("border-gray-300");
        document.getElementById("password").classList.add("border-red-300");
        errores["password"] =
            "La contraseña debe contener al menos un número.";
        return false;
    }

    document.getElementById("password").classList.remove("border-red-300");
    document.getElementById("password").classList.add("border-gray-300");

    return true
}

function correo(errores) {
    var correo = document.getElementById("email").value;
    var regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!regexCorreo.test(correo)) {
        document.getElementById("email").classList.remove("border-gray-300");
        document.getElementById("email").classList.add("border-red-300");
        errores["correo"] = "Formato de correo inválido.";

        isValid = false;
    }

    document.getElementById("email").classList.remove("border-red-300");
    document.getElementById("email").classList.add("border-gray-300");

    return true
}