@extends('layouts.index')

@section('title', 'Bienvenido')

@section('content')
    @include('_mensajesError')


    <main>
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('img/blanqueado.jpg') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('img/cepillado.jpg') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('img/blancos.jpg') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('img/dentista-2.jpg') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('img/boca.jpg') }}"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                    data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                    data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                    data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
                    data-carousel-slide-to="3"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5"
                    data-carousel-slide-to="4"></button>
            </div>
            <!-- Slider controls -->
            <button type="button"
                class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>

        <section class="no-parallax">
            <h1>Clínica dental Guadalquivir</h1>
            <p>Nos dedicamos a brindar una atención dental de calidad en un ambiente
                cálido y acogedor. Nuestro equipo de profesionales altamente capacitados se compromete a mejorar la salud y
                la belleza de su sonrisa.¡Estamos ansiosos por darle la bienvenida a nuestra familia dental!
            </p>
        </section>
        <section class="parallax bg-1">
            <p>En Clínica Dental Guadalquivir, ofrecemos una amplia gama de tratamientos para satisfacer todas sus
                necesidades dentales. Desde limpiezas dentales regulares y exámenes de rutina hasta tratamientos más
                avanzados como implantes dentales, ortodoncia y blanqueamiento dental.Cada tratamiento se personaliza para
                satisfacer las necesidades individuales del paciente.</p>
        </section>
        <section class="no-parallax">
            <h1>Nuestro equipo</h1>
            <p>Está compuesto por profesionales altamente capacitados y
                dedicados a su oficio. Cada miembro de nuestro equipo se esfuerza por proporcionar una atención al paciente
                excepcional y personalizada. Desde nuestros dentistas y ortodoncistas hasta nuestros higienistas y personal
                de recepción, todos compartimos una pasión por la salud dental y el bienestar de nuestros pacientes.
            </p>
        </section>
        <section class="parallax bg-2">
            <p>
                Nuestro equipo profesional principal valor. Profesionales cualificados y comprometidos, orientados a la
                excelencia, al trabajo en equipo, con vocación por su profesión. <br>
                Saber que estás en las mejores manos, es nuestro mejor seguro.
            </p>
        </section>
        <section class="no-parallax">
            <h1>Paga como quieras</h1>
            <p>
                En clínica Guadalquivir tenemos un sistema de suscripciones donde se ofrecen varios servicios con un precio
                anual.
                De la misma forma disponemos de financiación para los tratamientos. <br>
                Puedes preguntar por la financiación disponibles y nuestro equipo te hará un estudio.
            </p>
        </section>
        <section class="parallax bg-3">
            <p>
                En nuestra clínica puedes disfrutar de planes anuales que brindan todo tipo de servicios al paciente.
                Puedes elegir el plan que más se ajuste a ti. Para consultar los planes haga click <a
                    href="/planes">aquí</a>.
                <br>
                De igual manera, si no necesita uno de nuestros planes, siempre tienes la oportunidad de pagar en la clínica
                después
                de realizar nuestro trabajo.
                <p />
        </section>
        <section class="no-parallax">
            <h1>Si tienes alguna duda</h1>
            <p>
                Contacta con nosotros a través del correo electronico: <a href=""><span
                        style="color: black">info@clinicaguadalquivir.com</span></a> <br>
                O si lo prefies llama al número de telefono <span style="color: black">609124988</span> para más información
            </p>
        </section>
    </main>
@endsection
