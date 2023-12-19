<h2 class="text-center font-semibold text-xl text-gray-800 leading-tight">Lista de Trabajadores</h2>
<table>
    <!-- Cabecera de la tabla -->
    <tr>
        <th>Nombre</th>
        <th>Titulación</th>
        <!-- Agregar más columnas según las propiedades de Worker -->
    </tr>

    <!-- Filas de datos de trabajadores -->
    @foreach ($trabajadores as $trabajador)
        <tr>
            <td class="text-center"><a href="{{route('edit.worker' ,$trabajador->id)}}">{{ $trabajador->usuario->first_name }}</a></td>
            <td>{{$trabajador->title}}</td>
        </tr>
    @endforeach
</table>