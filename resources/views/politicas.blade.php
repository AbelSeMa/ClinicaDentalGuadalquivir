@extends('layouts.template')

@section('title', 'Politicas de privacidad')

@section('content')
    @include('_mensajesError')


    <main>

        <section class="no-parallax">
            <div class="container">
                <h1 class="text-5xl font-extrabold dark:text-white">Políticas de Privacidad</h1>
                <div class="privacy-policy">
                    <p class="mb-3 text-gray-500 dark:text-gray-400">En la Clínica Dental Guadalquivir, nos tomamos muy en serio la privacidad de nuestros pacientes. Esta política de privacidad describe qué información personal recopilamos y cómo la usamos.</p>
                    <h2 class="text-4xl font-bold dark:text-white">Información que recopilamos</h2>
                    <p class="mb-3 text-gray-500 dark:text-gray-400">Recopilamos información personal, como nombres, direcciones de correo electrónico, etc., solo cuando nuestros pacientes nos la proporcionan voluntariamente.</p>
                    <h2 class="text-4xl font-bold dark:text-white">Cómo usamos la información</h2>
                    <p class="mb-3 text-gray-500 dark:text-gray-400">Usamos la información que recopilamos para proporcionar los servicios solicitados por nuestros pacientes, para comunicarnos con ellos sobre citas y para enviarles información sobre nuestros servicios.</p>
                    <h2 class="text-4xl font-bold dark:text-white">Cómo protegemos tu información</h2>
                    <p class="mb-3 text-gray-500 dark:text-gray-400">Tomamos medidas de seguridad adecuadas para proteger contra el acceso no autorizado o la alteración, divulgación o destrucción no autorizada de datos.</p>
                    <h2 class="text-4xl font-bold dark:text-white">Cambios en esta política de privacidad</h2>
                    <p class="mb-3 text-gray-500 dark:text-gray-400">Nos reservamos el derecho de cambiar esta política de privacidad en cualquier momento. Te recomendamos que revises esta política de privacidad periódicamente para cualquier cambio.</p>
                </div>
            </div>

        </section>
    </main>

@endsection
