@extends('layouts.userDashboard')

@section('title', 'Reserva tu cita')

@section('content')
<h2 class="text-center pt-12">Reserva tu cita ahora</h2>
<form action="/almacenar-cita">
    <input type="date" name="fecha" id="fecha">

</form>
@endsection
