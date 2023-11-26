<!-- editarTrabajador.blade.php -->
@extends('layouts.template')

@section('title', 'Editar trabajador')

@section('content')



    <h2 class="text-center">Editar información de un trabajador</h2>
    <form class="max-w-sm mx-auto" action="{{ route('update.worker', $trabajador->id) }}" method="post">
        @csrf
        @method('PUT') <!-- Utiliza el método PUT para enviar una solicitud de actualización -->
        <div class="mb-5">
            <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" readonly>Título</label>
            <input type="text" id="titulo" name="title" value="{{ $trabajador->title }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Titulación del trabajador" required>
        </div>
        <div class="mb-5">
            <label for="specialty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Especialidad</label>
            <input type="text" name="specialty" value="{{ $trabajador->specialty }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
    </form>
@endsection
