@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Elige un Usuario al que quieras editar</h1>
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
                <th class="px-6 py-3">DNI</th>
                <th class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td scope="row" class="px-6 py-4">{{ $usuario->first_name }}<br>{{ $usuario->last_name }}</td>
                    <td scope="row" class="px-6 py-4">{{ $usuario->dni }}</td>

                    <td scope="row" class="px-6 py-4">
                        <a href="/admin/editar-usuario/{{$usuario}}"><span class="material-symbols-outlined">
                                edit
                            </span></a>
                        <form action="{{ route('user.ban'), $usuario }}" method="POST">
                            @if ($usuario->banned)
                                <button type="submit">
                                    <span class="material-symbols-outlined">
                                        person_check
                                    </span>
                                </button>
                            @else
                                <button type="submit">
                                    <span class="material-symbols-outlined">
                                        person_cancel
                                    </span>
                                </button>
                            @endif
                        </form>
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
