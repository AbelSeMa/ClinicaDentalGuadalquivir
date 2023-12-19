@extends('layouts.template')

@section('title', 'Información detallada de los planes')


@section('content')

<h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Detalles del plan 
    @if($plan->name == 'Oro')
    <span class="text-yellow-400">{{ $plan->name }}</span>        
    @endif
    @if($plan->name == 'Brillante')
    <span class="glow">{{ $plan->name }}</span>        
    @endif
    @if($plan->name == 'Básico')
    <span class="text-violet-500">{{ $plan->name }}</span>        
    @endif
</h1>

    <div class="relative overflow-x-auto">
        <table class="w-full text-lg table-fixed dark:text-gray-400 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                <tr>
                    <th scope="col" class="px-6 py-3 rounded-sm">Servicio</th>
                    <th scope="col" class="px-6 py-3 rounded-sms">Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servicios as $service)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="text-center text-blue-700">{{ $service->service }}</td>
                    <td class="text-center">{{ $service->description }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
