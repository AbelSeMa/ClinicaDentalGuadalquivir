@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Página de administración</h1>
@stop

@section('content')
    @include('_mensajesError')
    <div>
        <h2 class="text-center">Panel de citas</h2>
        <div x-data="{ mostrarBusqueda: false }">
            <button @click="mostrarBusqueda = !mostrarBusqueda" class="my-4 bg-blue-500 text-white px-4 py-2 rounded-md">
                Mostrar opciones de búsqueda
            </button>


            <div x-show="mostrarBusqueda" class="grid grid-cols-1 gap-2lg:grid-cols-2-">
                <div>
                    <form method="GET" action="{{ route('admin.dashboard') }}">
                        <fieldset>
                            <legend> Búsqueda de citas
                            </legend>
                            <label for="filtro_anio" class="">Buscar por
                                año:</label>
                            <input type="number" name="filtro_anio" id="filtro_anio" min="1900"
                                max="{{ date('Y') + 1 }}" aria-describedby="helper-text-explanation"
                                placeholder="Indica el año de busqueda"
                                class="block w-48 mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">



                            <label for="paciente" class="">Buscar por nombre de paciente</label>
                            <input type="text" name="paciente" id="paciente" placeholder="Introduce nombre paciente"
                                class="block w-48 mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <input type="hidden" id="paciente_id" name="paciente_id">


                            <label for="doctor" class="sr-only">Elige un
                                doctor</label>
                            <select name="doctor" id="doctor"
                                class=" py-2.5 px-0 w-48 text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                <option value="">Selecciona un doctor</option>
                                @foreach ($trabajadores as $trabajador)
                                    <option value="{{ $trabajador->id }}">{{ $trabajador->usuario->last_name }},
                                        {{ $trabajador->usuario->first_name }}</option>
                                @endforeach
                            </select>
                            <button type="submit"
                                class="block px-3 py-2 text-xs font-medium text-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 rounded-lg me-2 my-4 ">
                                Buscar
                            </button>
                        </fieldset>
                    </form>
                </div>

                <div class="flex content-around">
                    <div class="flex items-center">
                        <form method="GET" action="{{ route('admin.dashboard') }}">
                            <input type="hidden" name="ver_citas_hoy" value="1">
                            <button type="submit"
                                class="px-3 py-2 text-xs font-medium text-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 rounded-lg me-2 my-4 ">
                                Citas para hoy</button>
                        </form>
                    </div>


                    <div class="flex items-center">
                        <form method="GET" action="{{ route('admin.dashboard') }}">
                            <input type="hidden" name="filtro_semana" value="1">
                            <button type="submit"
                                class="px-3 py-2 text-xs font-medium text-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 rounded-lg me-2 my-4 ">
                                Citas de la semana</button>
                        </form>
                    </div>

                    <div class="flex items-center">
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-3 py-2 text-xs font-medium text-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 rounded-lg me-2 my-4 ">
                            Todas las citas</a>
                    </div>
                </div>
            </div>

            <div>
                <table id="citas-table" class="w-full">
                    <thead class="text-xs text-white uppercase bg-blue-600 border-b border-blue-400 dark:text-white">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Paciente
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Doctor
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha
                            </th>
                            <th>
                                Estado
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($citas as $cita)
                            <td class="px-6 py-4">
                                {{ $cita->patient->usuario->first_name }} {{ $cita->patient->usuario->last_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $cita->worker->usuario->first_name }} {{ $cita->worker->usuario->last_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($cita->date)->format('d/m/Y') }} <br>
                                {{ $cita->hour }}
                            </td>
                            @if ($cita->attended)
                                <td class="px-6 py-4">
                                    <span class="material-symbols-outlined">
                                        event_available
                                    </span>
                                </td>
                            @else
                                <td class="px-6 py-4 truncate">
                                    <span class="material-symbols-outlined">
                                        event_busy
                                    </span>
                                </td>
                            @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            {{ $citas->links() }}
        @endsection

        @section('js')

            <!-- jQuery -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <!-- jQuery UI -->
            <link rel="stylesheet"
                href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.js"></script>

            <script>
                $('#citas-table').DataTable({
                    paging: false,
                    bInfo: false,
                    searching: false,
                    responive: true,
                    "language": {
                        "emptyTable": "No hay datos."
                    }

                });

                $(document).ready(function() {
                    $('#paciente').autocomplete({
                        source: function(request, response) {
                            $.ajax({
                                url: "{{ route('obtener.usuario') }}",
                                dataType: "json",
                                data: {
                                    term: request.term
                                },
                                success: function(data) {
                                    response(data.map(function(item) {
                                        return {
                                            label: item.first_name + " " + item
                                                .last_name,
                                            value: item.id
                                        };
                                    }));
                                }
                            });
                        },
                        minLength: 1,
                        select: function(event, ui) {
                            $('#paciente').val(ui.item
                                .label); // Establecer el valor del campo de entrada como el nombre
                            $('#paciente_id').val(ui.item
                                .value); // Establecer el valor del campo oculto como el ID
                            return false; // Evitar que el valor seleccionado se muestre en el campo de entrada
                        }
                    });
                });
            </script>
        @stop
