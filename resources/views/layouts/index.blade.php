<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />


    @vite('resources/js/app.js')
    @vite('resources/css/index.css')
    @yield('css')

</head>

<body class="h-ful">
    <!-- Header -->

    <!-- NavBar -->
    @include('layouts.navbar')

    @yield('content')

    <!-- Main modal -->
    <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Políticas de privacidad de la emrpesa
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Para continuar utilizando nuestro sitio web, por favor, acepta nuestras políticas de privacidad.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Las políticas de privacidad se han actualizado para cumplir con los requisitos de protección de
                        datos.
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="static-modal" type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Si, acepto.</button>
                    <a href="/politicas-privacidad"
                        class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Leer
                        politicas</button></a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        @include('_footerIndex')
    </footer>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("static-modal");
            var acceptButton = modal.querySelector(
                ".relative > div > button:nth-child(2)"); // Selección del segundo botón dentro del modal
            var closeButton = modal.querySelector(
                ".relative > div > button:first-child"); // Selección del primer botón dentro del modal


            // Verificar si la cookie no está presente
            if (!checkCookie("policiesAccepted")) {
                modal.classList.remove("hidden");
                modal.classList.add("flex");
            }

            // Función para establecer la cookie y ocultar el modal cuando se hace clic en "Aceptar"
            closeButton.addEventListener("click", function() {
                console.log(
                    "Botón de aceptar clicado"); // Verificar si el evento de clic se está ejecutando
                var date = new Date();
                date.setMonth(date.getMonth() + 1);
                document.cookie = "policiesAccepted=true; expires=" + date.toUTCString();
                modal.classList.remove("flex");
                modal.classList.add("hidden"); // Ocultar el modal
            });

            // Función para ocultar el modal cuando se hace clic en el botón de cerrar
            acceptButton.addEventListener("click", function() {
                modal.classList.add("hidden"); // Ocultar el modal
            });

            function checkCookie(cookieName) {
                var cookies = document.cookie.split("; ");
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = cookies[i].split("=");
                    if (cookie[0] === cookieName) {
                        return true;
                    }
                }
                return false;
            }
        });
    </script>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

</body>

</html>
