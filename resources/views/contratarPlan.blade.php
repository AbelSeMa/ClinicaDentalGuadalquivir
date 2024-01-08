@extends('layouts.template')

@section('title', 'Información detallada de los planes')

@section('css')
    @vite('resources/css/boton-pago.css')
@endsection


@section('content')
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <!-- Session Status -->
            <div
                class="w-full p-4 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-6 dark:bg-gray-800 dark:border-gray-700">
                <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="" src=" {{ asset('img/logo-2.png') }} " alt="logo">
                </a>
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Datos de la compra:
                </h1>


                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                            <tr>
                                <th scope="col" colspan="2" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Resumen de
                                    la suscripción
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-200 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                    Nombre</th>
                                <td>{{ $user->first_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                    Apellido</th>
                                <td>{{ $user->last_name }}</td>
                            </tr>
                            <tr>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                    Nombre del plan</th>
                                <td>{{ $plan->name }}</td>
                            </tr>
                            <tr>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                    Duración</th>
                                <td>{{ $plan->duration_in_months }} meses</td>
                            </tr>
                            <tr>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                    Fecha de inicio</th>
                                <td>{{ now()->format('d-m-Y') }}</td>
                            </tr>
                            <tr>

                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                    Fecha de inicio</th>
                                <td>{{ now()->addYear()->format('d-m-Y') }}</td>
                            </tr>
                            <tr>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                    Precio</th>
                                <td>{{ $plan->price }}€</td>
                            </tr>

                        </tbody>

                    </table>

                </div>
                <div class="md:flex">
                    <form action="{{ route('paypal.payment') }}" method="post">
                        @csrf
                        <input type="text" name="idPlan" value="{{ $plan->id }}" hidden>
                        <button class="button mt-4">
                            Pagar con PayPal
                            <svg class="cartIcon" viewBox="0 0 576 512">
                                <path
                                    d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z">
                                </path>
                            </svg>
                        </button>
                    </form>
                    <a href="{{ route('index.plan') }}"
                        class="button mt-4 md:ml-4">
                        Elegir otro plan</a>
                </div>
                
                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">

                </form>
            </div>
    </section>
@endsection
