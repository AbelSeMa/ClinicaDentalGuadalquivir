@extends('layouts.userDashboard')

@section('title', 'Reserva tu cita')

@section('content')
    <h2>Fechas sin citas disponibles:</h2>

    @if (count($fechas_sin_citas) > 0)
        <ul>
            @foreach ($fechas_sin_citas as $fecha)
                <li>{{ $fecha }}</li>
            @endforeach
        </ul>
    @else
        <p>No hay fechas sin citas disponibles.</p>
    @endif
@endsection