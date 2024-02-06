@extends('layouts.userDashboard')

@section('content')
    <h2 class="text-3xl  font-extrabold  text-gray-400 dark:text-gray-500 text-center">Facturas</h2>
    <div class="container">
        <div class="relative overflow-x-auto">
            <table class="table-auto w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-3 text-center">
                            Nº de factura
                        </th>
                        <th scope="col" class="px-4 py-3 text-center">
                            Fecha de factura
                        </th>
                        <th scope="col" class="px-4 py-3 text-center">
                            Importe
                        </th>
                        <th scope="col" class="px-4 py-3 text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pagos as $pago)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td scope="row" class="text-center font-medium text-gray-900 dark:text-white">
                                {{ $pago->id }}</td>
                            <td scope="row" class="text-center font-medium text-gray-900 dark:text-white">
                                {{ $pago->date }}</td>
                            <td scope="row" class="text-center font-medium text-gray-900 dark:text-white">
                                {{ $pago->amount }}</td>
                            <td>
                                <button onclick="abrirFactura({{$pago->id}})" > Ver factura </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function abrirFactura(id) {
            var url = '/usuario/ver-factura/' + id;
            window.open(url, '_blank', 'width:800');
        }
    </script>
@endsection
