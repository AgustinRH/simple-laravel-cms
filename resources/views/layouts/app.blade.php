<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
{{--
ARCHIVO DE DISEÑO PRINCIPAL (LAYOUT)
Este archivo define la estructura base HTML que compartirán la mayoría de las páginas.
Incluye la configuración del

<head>, estilos, scripts y la estructura del

<body>.
    --}}

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- Token CSRF para seguridad en peticiones AJAX --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- El título se toma de la configuración de la app (config/app.php) --}}
        <title>{{ config('app.name', 'Laravel') }}</title>

        {{-- Fuentes de Google/Bunny --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- Directiva @vite para cargar y compilar activos (CSS y JS) --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            {{-- Incluye la barra de navegación superior --}}
            @include('layouts.navigation')

            {{--
            HEADER OPCIONAL
            Se muestra solo si la vista define un slot o variable llamada 'header'.
            Usado para títulos de página (e.g., "Dashboard", "Perfil").
            --}}
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{--
            CONTENIDO PRINCIPAL
            Aquí se renderiza el cuerpo de las páginas.
            Soporta dos métodos de inserción de contenido:
            1. $slot: Para componentes Blade modernos (<x-app-layout>).
                2. @yield('content'): Para vistas tradicionales que usan @extends.
                --}}
                <main>
                    {{ $slot ?? '' }} {{-- Renderiza el slot si existe --}}
                    @yield('content') {{-- Renderiza la sección 'content' si existe --}}
                </main>
        </div>
    </body>

</html>