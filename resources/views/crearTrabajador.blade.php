@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dar de alta a un trabajador</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <h4 class="text-2xl font-bold dark:text-white">¿El trabajador ya está registrado como usuario de la página?</h4>
        <div class="flex items-center mb-2">
            <input type="radio" name="respuesta" id="si" value="si"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                onclick="trabajadorExiste()">
            <label for="si" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Si</label>
        </div>
        <div class="flex items-center mb-2">
            <input type="radio" name="respuesta" id="no" value="no"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="no" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300" onclick="trabajadorNoExiste()">No</label>
        </div>
    </div>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div>
            <form id="form-existe" action="/admin/almacenar-trabajador" method="POST" class="md:space-y-6">
                @csrf
                    <div class="mb-3" id="selectUsuarios">
                        
                    </div>
                    
                    <div id='titulo'>
                        
                    </div>
                    <div id='especialidad'>
                        
                    </div>
                <button type="submit"
                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 my-4 ">Dar
                    de alta</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/formulario-trabajadores.js') }}"></script>
@endsection
