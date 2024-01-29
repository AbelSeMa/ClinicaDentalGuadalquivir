<!-- editarTrabajador.blade.php -->
@extends('adminlte::page')

@section('title', 'Editar trabajador')

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

    <h2 class="text-center">Editar información de un trabajador</h2>
    <form class="max-w-sm mx-auto" action="{{ route('update.user', $usuario->id) }}" method="post" id="form-usuario">
        @csrf
        @method('PUT') <!-- Utiliza el método PUT para enviar una solicitud de actualización -->
        <div class="mb-2">
            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                readonly>Nombre</label>
            <input type="text" id="nombre" name="first_name" value="{{ $usuario->first_name }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Nombre del usuario" required>
        </div>
        <div class="mb-2">
            <label for="apellido" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                readonly>Nombre</label>
            <input type="text" id="apellido" name="last_name" value="{{ $usuario->last_name }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Apellido del usuario" required>
        </div>
        <div class="mb-2">
            <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                readonly>Dirección</label>
            <input type="text" id="direccion" name="address" value="{{ $usuario->address }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Calle real nº 1" required>
        </div>
        <div class="mb-2">
            <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                readonly>Teléfono</label>
            <input type="number" id="telefono" name="phone" value="{{ $usuario->phone }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Ej: 956443322 o 666112233" required>
        </div>
        <div class="mb-2">
            <label for="nacimiento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" readonly>Fecha
                nacimiento</label>
            <input type="date" id="nacimiento" name="birth_date" value="{{ $usuario->birth_date }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Ej: 01/01/1991" required>
        </div>
        <div class="mb-2">
            <label for="dni" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" readonly>DNI</label>
            <input type="text" id="dni" name="dni" value="{{ $usuario->dni }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="DNI: 00000000X" required>
        </div>
        <div class="mb-2">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                readonly>Email</label>
            <input type="text" id="email" name="email" value="{{ $usuario->email }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Titulación del trabajador" required>
        </div>

        <button type="submit"
            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 my-4 ">Actualizar</button>
    </form>
@endsection

@section('js')
    <script src="{{ asset('js/formulario-usuario.js') }}"></script>
@endsection
