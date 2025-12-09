{{-- Extiende del layout principal de la aplicación ('layouts.app') --}}
{{-- Este layout incluye la navegación y estilos base (Tailwind CSS) --}}
@extends('layouts.app')

{{-- Define el título de la página, visible en la pestaña del navegador --}}
@section('title', $article->title)

{{-- Sección principal de contenido: se inyectará en @yield('content') del layout --}}
@section('content')
    <div class="py-12">
        {{-- Contenedor centrado con ancho máximo --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Tarjeta con fondo blanco (oscuro en modo noche) y sombra --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Título principal del artículo --}}
                    <h1 class="text-4xl font-bold mb-4 text-gray-900 dark:text-gray-100">{{ $article->title }}</h1>

                    {{-- Información del autor y fecha de publicación --}}
                    <p class="text-gray-600 dark:text-gray-400 mb-2">
                        {{-- Accede al nombre del autor a través de la relación 'user' definida en el modelo Article --}}
                        <strong>Autor:</strong> <span class="font-semibold">{{ $article->user->name }}</span>
                    </p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                        {{-- Formatea la fecha de creación a día/mes/año --}}
                        <strong>Fecha de creación:</strong> {{ $article->created_at->format('d/m/Y') }}
                    </p>
                    <hr class="mb-6 border-gray-200 dark:border-gray-700">

                    {{-- Muestra el contenido/descripción del artículo --}}
                    <p class="text-lg text-gray-800 dark:text-gray-200 mb-8">{{ $article->description }}</p>

                    {{-- Enlace para regresar al listado de artículos --}}
                    <a href="{{ route('articles.index') }}"
                        class="inline-block text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-200">
                        ← Volver a la lista de artículos
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection