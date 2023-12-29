<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"  rel="stylesheet" />


    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>

<body class="h-ful">
    <!-- Header -->

    <!-- NavBar -->
    @include('layouts.navbar')

    <div class="container w-auto h-auto mx-auto mb-10 py-8 px-8">
        @yield('content')
    </div>

    <!-- Footer -->
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

</body>

</html>
