@extends('layouts.index')

@section('title', 'Contactanos')

@section('content')
    @include('_mensajesError')


    <main>

        <section class="no-parallax">
            <div class="container">
                <h1>Contacto</h1>
                <div class="contact-info">
                    <h2>Clínica Dental Guadalquivir</h2>
                    <p>Calle amarguillo, 14</p>
                    <p>11540 Sanlúcar de Bda. , España</p>
                    <p>Teléfono: +34 955 123 456</p>
                    <p>Email: info@clinicadentalguadalquivir.com</p>
                </div>
            </div>
        </section>
    </main>

@endsection
