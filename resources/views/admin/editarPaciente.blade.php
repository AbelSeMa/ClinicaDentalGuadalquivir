<!-- editarTrabajador.blade.php -->
@extends('adminlte::page')

@section('title', 'Editar trabajador')

@section('content')


    <h2 class="text-center">Editar información de un paciente</h2>
    <form class="max-w-sm mx-auto" action="{{ route('update.patient', $paciente->id) }}" method="post">
        @csrf
        @method('PUT')
        <!-- Utiliza el método PUT para enviar una solicitud de actualización -->
        <input type="hidden" name="usuario" value=" {{$paciente->id }}"> 
        <div class="mb-5">
            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" readonly>Trabajador</label>
            <input type="text" id="nombre" name="name" value="{{ $paciente->usuario->last_name }}, {{ $paciente->usuario->first_name }}"
                class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Nombre del usuario" disabled>
        </div>
        <div class="mb-5">
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Historial
                médico</label>
            <textarea id="message" rows="4" name="medical_history"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Historial del paciente aquí..."></textarea>
        </div>
        <button type="submit"
        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 my-4 ">Actualizar</button>
    </form>
@endsection
