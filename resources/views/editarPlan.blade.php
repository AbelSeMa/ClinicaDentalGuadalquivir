@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1 class="flex justify-center items-center">Panel de planes</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Danger</span>
            <div>
                <span class="font-medium">Algunos campos no cumplen los requisitos:</span>
                <ul class="mt-1.5 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>
            </div>
        </div>
    @endif
    <div class="flex justify-center items-center">
        <form method="POST" action="{{ route('admin.update-plan', $plan->id) }}">
            @csrf
            @method('PUT')

            <!-- Aquí irían otros campos del plan... -->
            <div>
                <label for="name">Nombre del plan</label>
                <input type="text" name="name" id="name" value="{{ $plan->name }}">
            </div>

            <div>
                <label for="price">Precio</label>
                <input type="number" name="price" id="price" value="{{ $plan->price }}">
            </div>

            <div>
                <label for="price">Duración en meses</label>
                <input type="number" name="duration_in_months" id="duration" value="{{ $plan->duration_in_months }}">
            </div>

            <h4>Seleciona los servicios que quieres añadir o quitar</h4>
            @foreach ($services as $service)
                <div>
                    <input type="checkbox" id="service{{ $service->id }}" name="services[]" value="{{ $service->id }}"
                        {{ $plan->services->contains($service->id) ? 'checked' : '' }} title="{{ $service->description }}">
                    <label for="service{{ $service->id }}">{{ $service->service }}</label>
                </div>
            @endforeach

            <button type="submit">Guardar cambios</button>
        </form>
    </div>
@endsection
