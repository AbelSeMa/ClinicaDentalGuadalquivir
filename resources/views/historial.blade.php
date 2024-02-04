@extends('layouts.userDashboard')

@section('numCitas')
    {{ $numCitas }}
@endsection


@section('title', 'Historial de citas')

@section('content')

    <div>
        <form action="{{ route('citas.historial') }}">
            <label for="mes">Filtrado por mes</label>
            <select name="filtro_mes" id="mes">
                <option value="" selected>Selecciona un mes</option>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            <label for="anyo">Filtrado por año</label>
            <input type="number" name="filtro_anyo" id="anyo">
            <button type="submit">Buscar</button>
        </form>
    </div>




    <h2 class="text-3xl  font-extrabold text-gray-400 dark:text-gray-500 text-center">Historial de citas</h2>
    <div class="container">
        <div class="relative overflow-x-auto">
            <table class="table-auto w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-center">
                            Fecha
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Atendido por
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Informe
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td scope="row"
                                class="text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ \Carbon\Carbon::parse($cita->date)->format('d-m-Y') }}
                            </td>
                            <td class="text-center font-medium text-gray-900 dark:text-white">
                                {{ $cita->worker->usuario->first_name }} {{ $cita->worker->usuario->last_name }}
                            </td>
                            <td>
                                @if ($cita->report)
                                <button onclick="abrirInforme({{$cita->report->id}})">Ver reporte</button>
                                @else
                                    <p class="text-center">Sin informe disponible</p>
                                @endif
                            </td>
                        </tr>

                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

    <script>
        function abrirInforme(id) {
            var url = '/usuario/ver-informe/' + id;
            window.open(url, '_blank', 'width:800');
        }
    </script>
@endsection
