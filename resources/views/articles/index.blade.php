@extends('layouts.app')

{{--
1. HEADER: ESTO SE INSERTA ARRIBA, DEBAJO DEL NAV
Se usa <x-slot> porque este layout usa componentes de Blade.
    --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Artículos (Todos)') }}
        </h2>
    </x-slot>

    {{--
    2. CONTENT: ESTO SE INSERTA DENTRO DEL <main> DE app.blade.php
        Usamos @section('content') para ser compatibles con el @yield('content') del layout.
        El layout app.blade.php está modificado para soportar tanto $slot como @yield.
        --}}
        @section('content')
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">

                            {{--
                            BLOQUE PARA MOSTRAR MENSAJES DE SESIÓN
                            Se capturan los mensajes 'success' o 'error' enviados desde el controlador
                            usando ->with('success', ...) o ->with('error', ...).
                            --}}
                            @if (session('success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                                    role="alert">
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                                    role="alert">
                                    <span class="block sm:inline">{{ session('error') }}</span>
                                </div>
                            @endif
                            {{-- ---------------------------------------------------------------- --}}


                            {{-- Botón "+ Nuevo artículo" redirige a articles.create --}}
                            <a href="{{ route('articles.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mb-6">
                                + Nuevo artículo
                            </a>

                            {{-- Verificación si la lista de artículos está vacía --}}
                            @if($articlesList->isEmpty())
                                <p>No hay artículos disponibles.</p>
                            @else
                                {{-- LISTA DE ARTÍCULOS TABLA RESPONSIVA --}}
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                                    Título
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                                    Fecha de creación
                                                </th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                                    Acciones
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                            {{-- Iteración sobre cada $article en $articlesList --}}
                                            @foreach ($articlesList as $article)
                                                <tr>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        {{-- Enlace para ver los detalles del artículo --}}
                                                        <a href="{{ route('articles.show', $article->id) }}"
                                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                                                            {{ $article->title }}
                                                        </a>
                                                    </td>
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $article->created_at->format('d/m/Y') }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                                                        {{-- LÓGICA DE AUTORIZACIÓN EN VISTA --}}
                                                        {{-- Solo muestra botones editar/eliminar si el usuario autenticado es el
                                                        dueño --}}
                                                        @if ($article->user_id === Auth::id())

                                                            {{-- ENLACE DE EDICIÓN --}}
                                                            <a href="{{ route('articles.edit', $article->id) }}"
                                                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 mr-4">
                                                                Editar
                                                            </a>

                                                            {{-- Formulario de Eliminar (requiere confirmación JS) --}}
                                                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                                                onsubmit="return confirm('¿Estás seguro de borrar este artículo?');"
                                                                class="inline">
                                                                @csrf
                                                                {{-- Spoofing de método DELETE para rutas RESTful --}}
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200">
                                                                    Eliminar
                                                                </button>
                                                            </form>
                                                        @else
                                                            {{-- Muestra un texto si el usuario no es el dueño --}}
                                                            <span class="text-gray-500 dark:text-gray-400">Sin acciones</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endsection