@extends('layouts.template')

@section('title', 'Contratar plan')

@section('content')

    <div>
        <h1
            class="px-5 text-center text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl">
            Elige el plan que mejor se adapte a tí.
        </h1>
    </div>

    <div class="grid grid-cols-1 content-stretch mt-3 gap-4 md:grid-cols-2 lg:flex lg:justify-around lg:mt-44">
        @foreach ($planes as $plan)
            @if ($plan->active)
                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                    <a href="{{ route('show.plan', $plan->id) }}">
                        <img class="h-40 w-72 p-8 rounded-t-lg slide-top" src="{{ asset('img/' . $plan->name . '.png') }}"
                            alt="Logo plan dental" />
                    </a>
                    <div class="px-5 pb-5">
                        <p class="text-xl font-semibold tracking-tight text-gray-900">
                            Plan {{ $plan->name }}:</p>
                        <div>

                        </div>
                        <div class="grid grid-cols-1 content">
                            <span class="text-3xl font-bold text-gray-900">{{ $plan->price }}€ / Año</span>
                            <a href="{{ route('show.plan', $plan->id) }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2.5 text-center">
                                Más información</a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>



@endsection
