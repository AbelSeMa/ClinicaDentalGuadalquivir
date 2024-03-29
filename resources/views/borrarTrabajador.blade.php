@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Elige un trabajador al que quieras eliminar</h1>
@stop

@section('content')
    <!-- Trabajadores Table -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table id="trabajadores-table">
        <thead class="text-xs text-white uppercase bg-blue-600 border-b border-blue-400 dark:text-white">
            <tr>
                <th class="px-6 py-3">Trabajador</th>
                <th class="px-6 py-3">Titulo</th>
                <th class="px-6 py-3">Especialidad</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trabajadores as $trabajador)
                <tr>
                    <td scope="row" class="px-6 py-4">{{ $trabajador->usuario->first_name }}
                        {{ $trabajador->usuario->last_name }}</td>
                    <td scope="row" class="px-6 py-4">{{ $trabajador->title }}</td>
                    <td scope="row" class="px-6 py-4">{{ $trabajador->specialty }}</td>
                    <td scope="row" class="px-6 py-4">
                        <button data-modal-target="popup-modal-{{ $trabajador->id }}"
                            data-modal-toggle="popup-modal-{{ $trabajador->id }}" type="button">
                            <span class="material-symbols-outlined">
                                person_remove
                            </span>
                        </button>
                        <div id="popup-modal-{{ $trabajador->id }}" tabindex="-1"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="popup-modal-{{ $trabajador->id }}">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">¿Estás seguro que quieres eliminar al trabajador?</h3>
                                        <form action="{{ route('worker.destroy', $trabajador) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button data-modal-hide="popup-modal-{{ $trabajador->id }}" type="submit"
                                                class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Si,
                                                eliminar</button>
                                        </form>
                                        <button data-modal-hide="popup-modal-{{ $trabajador->id }}" type="button"
                                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">No,
                                            cancelar</button>
                                    </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https:////cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>
        $('#trabajadores-table').DataTable({
            paging: false,
            bInfo: false,
            searching: true,
            ordering: true

        });
    </script>

@stop
