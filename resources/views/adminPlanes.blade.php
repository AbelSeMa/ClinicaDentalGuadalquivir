@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="flex justify-center items-center">Panel de planes</h1>
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
                <th class="px-6 py-3">Plan</th>
                <th>Estado</th>
                <th class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($planes as $plan)
                <tr>
                    <td scope="row" class="px-6 py-4">{{ $plan->name }}</td>
                    <td scope="row">{{ $plan->active ? 'Activo' : 'Desactivado' }}</td>
                    <td>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:flex lg:justify-around lg:mt-44">
                            <a href="editar-plan/{{ $plan->id }}"
                                class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 shadow-lg shadow-cyan-500/50 dark:shadow-lg dark:shadow-cyan-800/80 font-medium rounded-lg text-sm py-2.5 text-center me-2 mb-2 w-32">
                                Editar</a>
                            <form method="POST" action="{{ route('admin.desactivar-plan', $plan->id) }}">
                                @csrf
                                @if ($plan->active)
                                    <button type="submit"
                                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm py-2.5 text-center me-2 mb-2 w-32">Deshabilitar</button>
                                @else
                                    <button type="submit"
                                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm py-2.5 text-center me-2 mb-2 w-32">Habilitar</button>
                                @endif
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal toggle -->
    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 my-4"
        type="button">
        Crear nuevo plan
    </button>

    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative pt-6 bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Crear un nuevo plan
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form method="POST" action="{{ route('admin.store-plan') }}" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Nomre para el plan" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Precio</label>
                            <input type="number" name="price" id="price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="2999€" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="duration_in_months"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duración</label>
                            <input type="number" name="duration_in_months" id="duration_in_months"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="12 meses" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="active"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">¿Quieres que el plan
                                esté activo?</label>
                            <select id="category"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option value="True" selected>Sí</option>
                                <option value="False">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1">
                        <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">Selecciona los servicios</h3>
                        <ul
                            class="w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach ($services as $service)
                                <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                    <div class="flex items-center ps-3">
                                        <input id="service{{ $service->id }}" type="checkbox" value="{{ $service->id }}"
                                            name="services[]" title="{{ $service->description }}"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="service{{ $service->id }}"
                                            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $service->service }}</label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Añadir plan
                    </button>
                </form>
            </div>
        </div>
    </div>

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
