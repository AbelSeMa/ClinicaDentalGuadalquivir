@extends('layouts.workerDashboard')


@section('content')
    <div>
        <h2 class="text-center">Panel de citas</h2>
        <div x-data="{ mostrarBusqueda: false }">
            <button @click="mostrarBusqueda = !mostrarBusqueda" class="my-4 bg-blue-500 text-white px-4 py-2 rounded-md">
                Opciones de búsqueda
            </button>

            <div class="container">
                <div x-show="mostrarBusqueda" class="grid grid-cols-1 gap-2 lg:grid-cols-2-">
                    <div>
                        <form method="GET" action="{{ route('worker.dashboard') }}">
                            <fieldset>
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

                                <button type="submit"
                                    class="block px-3 py-2 text-xs font-medium text-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 rounded-lg me-2 my-4 ">
                                    Buscar
                                </button>
                            </fieldset>
                        </form>
                    </div>

                    <div class="flex content-around">
                        <div class="flex items-center">
                            <form method="GET" action="{{ route('worker.dashboard') }}">
                                <input type="hidden" name="ver_citas_hoy" value="1">
                                <button type="submit"
                                    class="px-3 py-2 text-xs font-medium text-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 rounded-lg me-2 my-4 ">
                                    Citas para hoy</button>
                            </form>
                        </div>


                        <div class="flex items-center">
                            <form method="GET" action="{{ route('worker.dashboard') }}">
                                <input type="hidden" name="filtro_semana" value="1">
                                <button type="submit"
                                    class="px-3 py-2 text-xs font-medium text-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 rounded-lg me-2 my-4 ">
                                    Citas de la semana</button>
                            </form>
                        </div>

                        <div class="flex items-center">
                            <a href="{{ route('worker.dashboard') }}"
                                class="px-3 py-2 text-xs font-medium text-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 rounded-lg me-2 my-4 ">
                                Todas las citas</a>
                        </div>
                    </div>
                </div>
                <div>
                    <table class="table-fixed w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="row"
                                    class="px-2 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    Paciente
                                </th>
                                <th scope="row"
                                    class="px-2 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    Fecha</th>
                                <th scope="row"
                                    class="px-2 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    Asistencia</th>
                                <th scope="row"
                                    class="px-3 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    accion
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($citas as $cita)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td scope="row"
                                        class="px-2 py-4 font-medium text-gray-900 text-center dark:text-white">
                                        {{ $cita->patient->usuario->first_name }} {{ $cita->patient->usuario->last_name }}
                                    </td>
                                    <td scope="row" class="py-4 font-medium text-gray-900 text-center dark:text-white">
                                        {{ Carbon\Carbon::parse($cita->date)->format('m-d-Y') }} <br>
                                        {{ \Carbon\Carbon::parse($cita->hour)->format('H:i') }} </td>
                                    <td scope="row"
                                        class="px-2 py-4 font-medium text-gray-900 text-center text-sm dark:text-white">
                                        {{ $cita->status }}</td>
                                    <td scope="row" class="flex justify-center px-6 py-4 text-gray-900 dark:text-white">
                                        @if ($cita->date > now())
                                            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                                data-cita-id="{{ $cita->id }}"
                                                class="btn-atender block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-18 h-18 px-2 py-2.5 text-center md:w-32 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                type="button" disabled>
                                                Gestionar cita
                                            </button>
                                        @elseif($cita->date < now())
                                            <button
                                                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-18 h-18 px-2 py-2.5 text-center md:w-32 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                type="button" onclick="nuevaCita(this)"
                                                data-paciente-id="{{ $cita->patient->id }}">
                                                Nueva cita
                                            </button>
                                        @elseif($cita->date = now())
                                            <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                                data-cita-id="{{ $cita->id }}"
                                                class="btn-atender block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-18 h-18 px-2 py-2.5 text-center md:w-32 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                type="button">
                                                Gestionar cita
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <!-- Main modal -->
                    <div id="crud-modal" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                        Datos de la cita
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-toggle="crud-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form class="p-4 md:p-5" action="{{ route('worker-atender-cita') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="cita_id" id="cita-id">
                                    <input type="hidden" name="worker_id" id="worker-id"
                                        value="{{ auth()->user()->trabajador->id }}">
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-2">
                                            <label for="name"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paciente</label>
                                            <input type="text" name="name" id="name"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="Nombre del paciente" disabled>
                                        </div>
                                        <div class="col-span-2">
                                            <label for="dni"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">DNI</label>
                                            <input type="text" name="dni" id="dni"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                placeholder="DNI del paciente" disabled>
                                        </div>

                                        <div class="col-span-2 sm:col-span-1">
                                            <label for="estado"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">El
                                                paciente:</label>
                                            <select id="estado" name="estado"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                <option value="" selected="">--Selecciona una--</option>
                                                <option value="Presentado">Presentado</option>
                                                <option value="No presentado">No presentado</option>
                                            </select>
                                        </div>
                                        <div class="col-span-2">
                                            <label for="description"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Informe
                                                de
                                                la cita</label>
                                            <textarea id="description" rows="4" name="informe"
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Escriba el informe de la cita y todo lo relacionado aquí"></textarea>
                                        </div>
                                    </div>
                                    <div class="inline">
                                        <button type="submit"
                                            class="content-around text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-18 h-18 px-2 py-2.5 text-center md:w-32 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Guardar</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function nuevaCita(btn) {
                        const pacienteId = btn.getAttribute('data-paciente-id');

                        // Obtener la zona horaria del navegador del usuario
                        const userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

                        // Obtener la fecha y hora actual en la zona horaria del usuario
                        const now = new Date();
                        const userNow = new Date(now.toLocaleString('en-US', {
                            timeZone: userTimezone
                        }));

                        const expiration = new Date(userNow.getTime() + 10 * 60 * 1000); // 10 minutos * 60 segundos * 1000 milisegundos
                        const expirationString = expiration.toUTCString();

                        // Establecer la cookie con la fecha y hora de expiración y la zona horaria local
                        document.cookie = `paciente=${pacienteId}; expires=${expirationString}; path=/; SameSite=Strict`;

                        let nuevaVentana = window.open(`/trabajador/nueva-cita`, '_blank');

                        if (nuevaVentana === null || typeof(nuevaVentana) == 'undefined') {
                            alert(
                                'La ventana emergente ha sido bloqueada por tu navegador. Por favor, permite las ventanas emergentes para este sitio.'
                            );
                        }
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        const btnsAtender = document.querySelectorAll('.btn-atender');
                        const nombreInput = document.getElementById('name');
                        const dniInput = document.getElementById('dni');
                        const informeInput = document.getElementById('description');

                        btnsAtender.forEach(btn => {
                            btn.addEventListener('click', function() {
                                const citaId = this.getAttribute('data-cita-id');
                                document.getElementById('cita-id').value = citaId;

                                nombreInput.value = '';
                                dniInput.value = '';
                                informeInput.value = '';
                                fetch(`datos-paciente/${citaId}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        nombreInput.value = data.paciente.usuario.first_name + ' ' + data
                                            .paciente.usuario.last_name;
                                        dniInput.value = data.paciente.usuario.dni
                                        if (data.reporte != null) {
                                            informeInput.value = data.reporte.content;
                                        }
                                    })
                                    .catch(error => console.error(
                                        'Error al obtener detalles del paciente:', error));
                            });
                        });
                    });
                </script>
            @endsection
