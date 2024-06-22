<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">

    <nav class="fixed top-0 left-0 min-h-32 flex bg-white shadow">
        <div></div>
    </nav>

    <div class="relative h-screen w-screen">
        <img class="size-full absolute z-20" src="welcome-fondo.jpg">
        <div class="size-full absolute z-30  grid grid-cols-3">
            <div class="h-full col-span-2"></div>
            <div class="h-full bg-gray-800 flex flex-col justify-center items-center">
                <div class="w-2/3 p-6 rounded bg-slate-700 flex flex-col items-center py-28">
                    <div class="w-4/12 p-2">
                        <x-application-logo />
                    </div>
                    <h1 class="app-text font-semibold text-xl pt-4">Dirección de asuntos públicos</h1>

                    <div class="grid grid-cols-1 gap-4 w-full justify-items-center mt-12">
                        @auth
                            @php

                            switch(Auth::user()->perfil->tipo) {
                                case 'solicitante':
                                    $route = route('dashboard');
                                    break;
                                case 'funcionario':
                                    $route = route('admin.dashboard');
                                    break;
                                case 'dat':
                                $route = route('dat.dashboard');
                                    break;
                            }
                            @endphp
                            <a href="{{ $route }}" class="size-full"><div class="app-text bg-slate-500 w-full p-3 rounded text-center text-lg">Inicio</div></a>
                        @else
                            <a href="{{ route('login') }}" class="size-full"><div class="app-text bg-slate-500 w-full p-3 rounded text-center text-lg">Iniciar sesión</div></a>
                            <a href="{{ route('register') }}" class="size-full"><div class="app-text bg-slate-500 w-full p-3 rounded text-center text-lg">Registrarse</div></a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Content -->
{{--    <img src="welcome-fondo.jpg" class="z-50">--}}

</div>
</body>
</html>
