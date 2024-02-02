@extends('layouts.userDashboard')

@section('title', 'Reserva tu cita')

@section('content')

    <h2 class="text-5xl  font-extrabold dark:text-white text-center ">Reserva tu cita ahora</h2><br>

    <div class="rounded-lg w-[355px] text-center mx-auto backdrop-blur-xl bg-white/30 lg:w-[500px]">
        <form action="/almacenar-cita" method="POST" class="max-w-sm mx-auto py-3">
            @csrf
            <label for="doctor" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Selecciona un
                doctor:</label>
            @error('doctor')
                <div class="text-orange-700 p-4" role="alert">
                    <p class="font-bold">¡CUIDADO!</p>
                    <p>{{ $message }}</p>
                </div>
            @enderror
            <select name="doctor" id="doctor"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-[90%] mx-5  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="" default>--Elige una opción--</option>
                @foreach ($doctores as $doctor)
                    @if($doctor->usuario->dni !== auth()->user()->dni)
                    <option value="{{ $doctor->id }}">{{ $doctor->usuario->first_name }} - {{ $doctor->specialty }}
                    </option>
                    @endif
                @endforeach
            </select><br>
            <label for="fecha" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Selecciona una
                fecha:</label>
            @error('fecha')
                <div class="text-orange-700 p-4" role="alert">
                    <p class="font-bold">¡CUIDADO!</p>
                    <p>{{ $message }}</p>
                </div>
            @enderror
            <input name="fecha" type="text" id="fecha" placeholder="Haz click para elegir fecha"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-[90%] mx-5 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><br>


            <label for="horas-disponibles" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Elige
                una
                hora: </label>
            @error('hora')
                <div class="text-orange-700 p-4" role="alert">
                    <p class="font-bold">¡CUIDADO!</p>
                    <p>{{ $message }}</p>
                </div>
            @enderror
            <select id="horas-disponibles" name="hora"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-[90%] mx-5  p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></select><br>



            <label for="notas" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Describe brevemente
                el motivo de tu consulta:</label>
            <textarea
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                name="notas" id="notas" cols="30" rows="10" placeholder="Escribe una breve descripción"></textarea>

            <x-primary-button class="ms-3 mt-2">
                {{ 'Reservar cita' }}
            </x-primary-button>
        </form>
    </div>



    <script>
        $(document).ready(function() {
            $('#doctor').select2();
        });

        $(document).ready(function() {

            $('#doctor').change(function() {
                var doctor = $(this).val();
                $.ajax({
                    url: '/obtener-dias-sin-citas',
                    data: {
                        doctor: doctor
                    },
                    type: 'GET',
                    success: function(data) {
                        const diasSinCitas = data.dias;
                        console.log(diasSinCitas)

                        const finesDeSemana = obtenerFinesDeSemana();

                        const anyo = new Date();
                        const anyoActual = anyo.getFullYear();

                        const diasFiesta = [
                            `${anyoActual}-01-01`,
                            `${anyoActual}-01-06`,
                            `${anyoActual}-02-28`,
                            `${anyoActual}-05-01`,
                            `${anyoActual}-08-15`,
                            `${anyoActual}-10-12`,
                            `${anyoActual}-11-01`,
                            `${anyoActual}-12-06`,
                            `${anyoActual}-12-08`,
                            `${anyoActual}-12-06`,
                            `${anyoActual}-12-25`,
                        ]

                        // Combinar días sin citas y fines de semana
                        const diasDeshabilitados = [...diasSinCitas, 
                                                    ...finesDeSemana, 
                                                    ...diasFiesta
                        ];

                        flatpickr("#fecha", {
                            minDate: 'today',
                            maxDate: new Date().getFullYear() + "-12-31",
                            disable: diasDeshabilitados,
                            dateFormat: "d-m-Y",
                            locale: "es",
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            })
        });

        function obtenerFinesDeSemana() {

            const hoy = new Date();
            const finDeSemana = [];

            for (let i = 0; i <
                365; i++) { // Agregar los próximos 365 días y descartamos los sábados y domingos
                const dia = new Date();
                dia.setDate(hoy.getDate() + i);

                if (dia.getDay() === 0 || dia.getDay() === 6) {
                    finDeSemana.push(dia.toISOString().split("T")[0]);
                }
            }

            return finDeSemana;
        }
    </script>
@endsection
