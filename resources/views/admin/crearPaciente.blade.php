@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div>
        <h2>Si aún no está dado de alta como usuario</h2>
        <a href="/admin/crear-usuario"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-44 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear
            usuario</a>
    </div>
    <br>
    <h1>¿A quien quieres dar de alta como paciente?</h1>
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
                <th class="px-6 py-3">Usuario</th>
                <th class="px-6 py-3">Rol</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td scope="row" class="px-6 py-4">{{ $usuario->first_name }} {{ $usuario->last_name }}</td>
                    <td scope="row" class="px-6 py-4">
                        @if ($usuario->trabajador)
                            Trabajador
                        @endif
                    </td>
                    <td>
                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                            data-user-id="{{ $usuario->id }}"
                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            Dar de alta
                        </button>
                    </td>
            @endforeach
        </tbody>
    </table>

    <!-- Main modal -->
    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Rellena los campos del paciente
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="authentication-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form id="form-existe" action="/admin/almacenar-paciente" method="POST" class="md:space-y-6">
                        @csrf
                        <div class="mb-3" id="selectUsuarios">
                            <input type="hidden" name="usuario">
                        </div>


                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Historial
                            médico</label>
                        <textarea id="message" rows="4" name="medical_history"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Historial del paciente aquí..."></textarea>
                        <button type="submit"
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 my-4 ">Dar
                            de alta</button>
                    </form>
                </div>
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

    <script>
        function setUserId(userId) {
            var hiddenInput = document.querySelector('#selectUsuarios input[name="usuario"]');
            hiddenInput.value = userId;
        }

        // Selecciona todos los botones con el atributo 'data-modal-target'
        var modalToggleButtons = document.querySelectorAll('[data-modal-target="authentication-modal"]');

        modalToggleButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var userId = this.getAttribute('data-user-id');
                setUserId(userId);
            });
        });
    </script>
@stop
