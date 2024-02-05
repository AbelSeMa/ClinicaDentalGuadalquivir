@extends('layouts.userDashboard')

@section('numCitas')
    {{ $numCitas }}
@endsection


@section('content')
    @if ($errors->any())
        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Danger</span>
            <div>
                <span class="font-medium">Algunos campos no cumplen los requisitos:</span>
                <ul class="mt-1.5 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>
        </div>
    @endif
    <section>
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                <div
                    class="w-full p-4 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-6 dark:bg-gray-800 dark:border-gray-700">
                    <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                        <img class="" src=" {{ asset('img/logo-2.png') }} " alt="logo">
                    </a>
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Datos del usuario</h2>


                    <form id="edit-usuario" class="max-w-sm mx-auto" method="POST"
                        action="{{ route('usuario.actualizar') }}">
                        @csrf
                        @method('put')
                        <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">


                            <div class="mb-5">
                                <label for="nombre"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                                <input type="text" id="nombre" name="first_name"
                                    value="{{ auth()->user()->first_name }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Nombre del usuario" required>
                            </div>
                            <div class="mb-5">
                                <label for="apellido"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido</label>
                                <input type="text" id="apellido" name="last_name"
                                    value="{{ auth()->user()->last_name }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Apellido del usuario" required>
                            </div>

                            <div class="mb-5">
                                <label for="dni"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DNI</label>
                                <input type="text" id="dni" name="dni" value="{{ auth()->user()->dni }}"
                                    class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Calle para pruebas nº 5"
                                    title="Ponte en contacto con administración para modificar el DNI" disabled>

                            </div>

                            <div class="mb-5">
                                <label for="emial"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Emial</label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="usuario@ejempl.com" required>
                            </div>

                            <div class="mb-5">
                                <label for="direccion"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección</label>
                                <input type="text" id="direccion" name="address" value="{{ auth()->user()->address }}"v
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Calle para pruebas nº 5" required>
                            </div>

                            <div class="mb-5">
                                <label for="telefono"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
                                <input type="text" id="telefono" name="phone" value="{{ auth()->user()->phone }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="611223344" required>
                            </div>

                            <div class="mb-5">
                                <label for="nacimiento"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha
                                    nacimiento</label>
                                <input type="date" id="nacimiento" name="birthdate"
                                    value="{{ auth()->user()->birth_date }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                            </div>


                            <button type="submit"
                                class="text-white lg:mt-7 h-10 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
                        </div>
                    </form>

                </div>

            </div>
            <div class="max-w-2xl px-4 py-8 mx-auto lg:py-16">
                <div
                    class="w-full p-4 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-6 dark:bg-gray-800 dark:border-gray-700">
                    <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                        <img class="" src=" {{ asset('img/logo-2.png') }} " alt="logo">
                    </a>
                    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Cambio de contraseña</h2>


                    <form id="edit-password" class="max-w-sm mx-auto" method="POST"
                        action=" {{ route('usuario.actualizar-contraseña') }} "">
                        @csrf
                        @method('put')
                        <div
                    class="w-full p-4 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-6 dark:bg-gray-800 dark:border-gray-700">
                            <div class="mb-5">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                                <input type="password" id="password" name="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                            </div>

                            <div class="mb-5">
                                <label for="password-repeat"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirma
                                    contraseña</label>
                                <input type="password" id="password-repeat" name="password_confirmation"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>
                            </div>
                            <button type="submit"
                                class="text-white lg:mt-7 h-10 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/editar-usuario.js') }}"></script>
    <script src="{{ asset('js/validaciones.js') }}"></script>
@endsection
