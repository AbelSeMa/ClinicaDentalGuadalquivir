@extends('layouts.userDashboard')

@section('title', 'Reserva tu cita')

@section('content')

    <h2 class="text-center pt-12">Reserva tu cita ahora</h2>
    <form action="/almacenar-cita">
        @csrf
        <label for="fecha">Elige un día:</label>
        <input type="date" name="fecha" id="fecha" min="2023-12-18">

        <label for="horas-disponibles">Elige una hora:</label>
        <select id="horas-disponibles" name="hora"></select>

        <label for="doctor">Selecciona un doctor:</label>
        <select name="doctor" id="doctor">
            @foreach($doctores as $doctor)
                <option value="{{$doctor->id}}">{{ $doctor->user }}</option>
            @endforeach
        </select>
    </form>
@endsection
