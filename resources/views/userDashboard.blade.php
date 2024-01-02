@extends('layouts.userDashboard')

@section('numCitas')
    {{$numCitas}}
@endsection
    

@section('content')
    <br>
    <h2 class="text-3xl  font-extrabold text-gray-400 dark:text-gray-500 text-center">Plan actual</h2>
    <div class="container">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nombre del plan actual
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Duración del plan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Precio
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        @if ($patient->plan)
                            <td scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $patient->plan->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $patient->plan->duration_in_months }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $patient->plan->price }}€
                            </td>
                            @else
                            <td class="px-6 py-4 col-span-3">
                                No tienes ningún plan contratado. <br>
                                 Revisa nuestros planes <a href="{{ Route('index.plan')}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"> aquí</a>
                            </td>
                            <td></td>
                            <td></td>
                        @endif

                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <br>
    <h2 class="text-3xl  font-extrabold  text-gray-400 dark:text-gray-500 text-center">Citas pendientes</h2>
    <div class="container">
        <div class="relative overflow-x-auto">
            <table class="w-full table-fixed text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Fecha
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Hora
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Doctor
                        </th>
                        <th>
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                        <tr class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td scope="row" class="text-center px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ \Carbon\Carbon::parse($cita->date)->formatLocalized('%d %B %Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ substr($cita->hour, 0, 5) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $cita->worker->usuario->last_name }}, {{ $cita->worker->usuario->first_name }}
                            </td>
                            <td class="text-center">
                                <form action="{{ route('citas.destroy', $cita) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="material-symbols-outlined">
                                        delete_forever
                                    </button>
                                </form>

                                <button data-fecha="{{ $cita->date }}" data-modal-target="crud-modal"
                                    data-modal-toggle="crud-modal" class="material-symbols-outlined editar-cita"
                                    type="button">edit_calendar</button>


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
                                                    Modifica tu cita
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="crud-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <form id="formulario-edicion" class="p-4 md:p-5"
                                                action="{{ route('citas.update', $cita->id) }}" method="post">
                                                @method('PUT')
                                                @csrf
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <label for="hora"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Elige
                                                            nueva hora</label>
                                                        <select name="hora" id="hora"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

                                                        </select>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="description"
                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Escribe
                                                            una nota
                                                        </label>
                                                        <textarea id="description" rows="4"
                                                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                            placeholder="Escribe lo necesario que debámos saber.">{{ $cita->notes }}</textarea>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Modificar cita
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $citas->links() }}
        </div>
    </div>
@endsection
