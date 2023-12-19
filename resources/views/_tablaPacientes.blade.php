
                        <h2 class="text-center bold">Lista de Pacientes</h2>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Product name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Color
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Category
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Price
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pacientes as $paciente)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$paciente->usuario->first_name}}

                                        </th>
                                        <td class="px-6 py-4">
                                            {{$paciente->usuario->last_name}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{$paciente->plan->name}}

                                        </td>
                                        <td class="px-6 py-4">
                                            {{$paciente->plan->duration_in_months}} meses
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>                     

                        {{$pacientes->links()}}