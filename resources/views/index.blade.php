@extends('layouts.index')

@section('title', 'Bienvenido')

@section('content')
    @include('_mensajesError')


    <main>
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
                En clínica Guadalquivir tenemos un sistema de suscripciones donde se ofrecen varios servicios con un precio anual.
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
                Contacta con nosotros a través del correo electronico:  <a href=""><span style="color: black">info@clinicaguadalquivir.com</span></a> <br>
                O si lo prefies llama al número de telefono <span style="color: black">609124988</span> para más información
            </p>
        </section>
    </main>
@include('_footer')
@endsection
