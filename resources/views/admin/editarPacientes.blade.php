@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Elige un trabajador al que quieras editar</h1>
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
                <th class="px-6 py-3">Paciente</th>
                <th class="px-6 py-3">Historial médico</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacientes as $paciente)
            <tr>
                <td scope="row" class="px-6 py-4">{{$paciente->usuario->first_name}} {{$paciente->usuario->last_name}}</td>
                <td scope="row" class="px-6 py-4">{{$paciente->medical_history}}</td>
                <td scope="row" class="px-6 py-4"><a href="/admin/editar-paciente/{{$paciente->id}}"><span class="material-symbols-outlined">
                    edit
                    </span></a></td>
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