                        <!-- Pacientes -->
                        <h2 class="text-center bold">Lista de Pacientes</h2>
                        <table>
                            <!-- Cabecera de la tabla -->
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <!-- Agregar más columnas según las propiedades de Patient -->
                            </tr>

                            <!-- Filas de datos de pacientes -->
                            @foreach ($pacientes as $paciente)
                                <tr>
                                    <td>{{ $paciente->id }}</td>
                                    <td>{{ $paciente->usuario->first_name }}</td>
                                    <!-- Mostrar más datos según las propiedades de Patient -->
                                </tr>
                            @endforeach
                        </table>

                        {{$pacientes->links()}}