@extends('layouts.userDashboard')

@section('content')
    <br>
    <div class="container">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @if ($patient->plan->name)
                                {{ $patient->plan->name }}
                            @else
                                No tienes ningún plan contratado
                            @endif
                        </th>
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
    </div>
@endsection
