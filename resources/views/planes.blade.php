@extends('layouts.template')

@section('title', 'Planes')

@section('content')

    <div>
        <h1
            class="px-5 text-center mt-5 mb-2 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
            Elige el plan que mejor se adapte a tí:</h1>
    </div>

    <div class="h-auto w-auto grid grid-cols-1 content-stretch py-8 px-8 gap-4 md:grid-cols-2 lg:grid-cols-4"">
        @for ($i = 0; $i < 4; $i++)
            <div
                class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="{{route('show.planes', 'premium')}}">
                    <img class="p-8 rounded-t-lg" src="{{ asset('img/premium.png')}}" alt="product image" />
                </a>
                <div class="px-5 pb-5">
                    <a href="#">
                        <a href="{{ route('show.planes', 'básico') }}"
                            class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">Plan básico
                            dental</a>
                    </a>
                    <div>

                    </div>
                    <div class="grid grid-cols-1 content">
                        <span class="text-3xl font-bold text-gray-900 dark:text-white">599€</span>
                        <a href="#"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                            to cart</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>



@endsection
