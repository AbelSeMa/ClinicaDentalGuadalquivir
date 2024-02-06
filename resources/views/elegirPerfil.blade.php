@extends('layouts.template')

@section('title', 'Elige tu perfil')

@section('content')
    @include('_mensajesError')

    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <!-- Session Status -->
            <div
                class="w-full p-4 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-6 dark:bg-gray-800 dark:border-gray-700">
                <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="" src=" {{ asset('img/logo-2.png') }} " alt="logo">
                </a>
                <h1
                    class="text-xl mb-6 text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Accede al sitio con tus Perfil
                </h1>

                <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                    <button id="paciente"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2.5 text-center">Perfil
                        de paciente</button>
                    <button id="trabajador"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2.5 text-center">Perfil
                        de trabajador</button>
                </div>
            </div>
    </section>

    <script>
        document.getElementById('paciente').addEventListener('click', function() {
            window.location.href = '/usuario/dashboard'; 
        });

        document.getElementById('trabajador').addEventListener('click', function() {
            window.location.href = '/trabajador/dashboard'; 
        });
    </script>

@endsection
