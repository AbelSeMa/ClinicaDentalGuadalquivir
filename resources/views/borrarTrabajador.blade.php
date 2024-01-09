@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Elige un trabajador al que quieras eliminar</h1>
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
                <th class="px-6 py-3">Trabajador</th>
                <th class="px-6 py-3">Titulo</th>
                <th class="px-6 py-3">Especialidad</th>
                <th class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($trabajadores as $trabajador)
            <tr>
                <td scope="row" class="px-6 py-4">{{$trabajador->usuario->first_name}} {{$trabajador->usuario->last_name}}</td>
                <td scope="row" class="px-6 py-4">{{$trabajador->title}}</td>
                <td scope="row" class="px-6 py-4">{{$trabajador->specialty}}</td>
                <td scope="row" class="px-6 py-4">
                    <form action="{{ route('worker.destroy', $trabajador) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="material-symbols-outlined">
                            delete_forever
                        </button>
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