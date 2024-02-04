<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe de la cita</title>
</head>

<body>
    <img src="{{ public_path('img/logo-2.png') }}" alt="">
    <div style="display: flex; justify-content: space-between;">
        <div id="1" style="flex: 1;">
            <p>Paciente: {{ $report->appointment->patient->usuario->first_name }} 
                {{ $report->appointment->patient->usuario->last_name }} <br>
                DNI: {{ $report->appointment->patient->usuario->dni }} <br>
                fecha de la cita:
                {{ \Carbon\Carbon::parse($report->appointment->date)->isoFormat('D [de] MMMM [de] YYYY') }}</p>
        </div>

        <div id="2" style="flex: 1;">
            <p> Atendido por: {{ $report->appointment->worker->usuario->first_name }}
                {{ $report->appointment->worker->usuario->last_name }}</p>
            Informe generado:
            {{ \Carbon\Carbon::parse($report->updated_at)->isoFormat('D [de] MMMM [de] YYYY [a las] H:m') }}
        </div>
    </div>
    <br><br>
    <p>Informe:</p>
    <p>{{$report->content}}</p>
</body>


</html>
