@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Página de administración</h1>
@stop

@section('content')
    <!-- Trabajadores Table -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div>
        <h2>Panel de citas</h2>
        <div class="grid grid-cols-1 gap-2 lg:grid-cols-3 pb-2">
            <div>
                <form method="GET" action="{{ route('admin.dashboard') }}">
                    <label for="filtro_anio">Filtrar por año:</label>
                    <input type="number" name="filtro_anio" id="filtro_anio" min="1900" max="{{ date('Y') + 1 }}">
                    <button type="submit" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
                        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        Buscar
                        </span>
                        </button>
                </form>
            </div>

            <div class="flex items-center">
                <form method="GET" action="{{ route('admin.dashboard') }}">
                    <input type="hidden" name="ver_citas_hoy" value="1">
                    <button type="submit">Ver citas para hoy</button>
                </form>
            </div>

            <div class="flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="button">Mostrar todas las citas</a>
            </div>
        </div>
        <div>
            <table id="citas-table">
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
                            {{ \Carbon\Carbon::parse($cita->date)->format('d/m/Y') }}
                        </td>
                        @if ($cita->attended)
                            <td class="px-6 py-4">
                                Atentidida
                            </td>
                        @else
                            <td class="px-6 py-4">
                                No presentado
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
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

        <script>
            $('#citas-table').DataTable({
                paging: false,
                bInfo: false,
                searching: false

            });
        </script>

    @stop
