@extends('layouts.userDashboard')

@section('content')
    <br>
    <h2 class="text-3xl  font-extrabold dark:text-white text-center">Plan actual</h2>
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
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($patient->plan->name)
                                {{ $patient->plan->name }}
                            @else
                                No tienes ningún plan contratado
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->plan->duration_in_months }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->plan->price }}€
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <br>
    <h2 class="text-3xl  font-extrabold dark:text-white text-center">Citas pendientes</h2>
    <div class="container">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                            <td scope="row"
                                class="text-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ \Carbon\Carbon::parse($cita->date)->formatLocalized('%d %B %Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ substr($cita->hour, 0, 5) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $cita->worker->usuario->last_name }}, {{ $cita->worker->usuario->first_name }}
                            </td>
                            <td class="text-center">
                               <form action="{{route('citas.destroy', $cita)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="material-symbols-outlined">
                                    delete_forever
                                </button>
                            </form>
                            <span class="material-symbols-outlined">
                                edit_calendar
                                </span>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
