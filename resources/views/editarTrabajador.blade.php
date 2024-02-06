<!-- editarTrabajador.blade.php -->
@extends('adminlte::page')

@section('title', 'Editar trabajador')

@section('content')


    <h2 class="text-center">Editar información de un trabajador</h2>
    <form class="max-w-sm mx-auto" action="{{ route('update.worker', $trabajador->id) }}" method="post">
        @csrf
        @method('PUT') <!-- Utiliza el método PUT para enviar una solicitud de actualización -->
        <input type="hidden" name="usuario" value=" {{$trabajador->id }}"> 
        <div class="mb-5">
            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" readonly>Trabajador</label>
            <input type="text" id="nombre" name="name" value="{{ $trabajador->usuario->last_name }}, {{ $trabajador->usuario->first_name }}"
                class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Nombre del usuario" disabled>
        </div>
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
        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 my-4 ">Actualizar</button>
    </form>
@endsection
