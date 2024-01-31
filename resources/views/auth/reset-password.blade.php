@extends('layouts.template')

@section('title', 'Reserva tu cita')

@section('content')
    <section>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <!-- Session Status -->
            <div
                class="w-full p-4 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-6 dark:bg-gray-800 dark:border-gray-700">
                <a href="/" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="" src=" {{ asset('img/logo-2.png') }} " alt="logo">
                </a>
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Introduce la nueva contraseña
                </h1><br>
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="mt-4">
                        <label for="email" class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo electrónico</label>
                        <input type="hidden" id="email" name="email" value="{{$request->email}}" disabled
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Nueva contraseña</label>
                        <input type="password" name="password" id="password" required autocomplete="new-password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <label for="password_confirmation" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Nueva contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit"
                        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 my-4 ">Actualizar contraseña</button>
                
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
