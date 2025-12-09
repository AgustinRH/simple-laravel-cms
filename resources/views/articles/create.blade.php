{{-- 
    VISTA DE CREACIÓN Y EDICIÓN DE ARTÍCULOS
    Esta vista es híbrida: se usa tanto para crear como para editar artículos.
--}}

{{-- 1. Lógica Dinámica: Determina si estamos en modo "Edición" o "Creación" --}}
@php
    // La variable $article solo existe si se pasa desde el método 'edit' del controlador.
    // Si $article no está definida, asumimos modo 'creación'.
    $isEditMode = isset($article);
    
    // Define el título del formulario dinámicamente
    $formTitle = $isEditMode ? 'Editar Artículo: ' . $article->title : 'Crear nuevo artículo';
    
    // Define la ruta de destino del formulario (update o store)
    // - Si es edición, usa la ruta 'update' (PUT/PATCH a articles/{id})
    // - Si es creación, usa la ruta 'store' (POST a articles)
    $formAction = $isEditMode 
        ? route('articles.update', $article->id) 
        : route('articles.store');              
@endphp

@extends('layouts.app')

{{-- 2. HEADER: Define el título del slot 'header' usando la variable calculada arriba --}}
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $formTitle }}
    </h2>
</x-slot>

{{-- 3. CONTENT: Formulario principal --}}
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Formulario: Action es dinámico ($formAction) --}}
                    <form action="{{ $formAction }}" method="POST">
                        @csrf
                        
                        {{-- Si estamos editando, necesitamos "falsificar" el método PUT, ya que los formularios HTML solo soportan GET y POST --}}
                        @if ($isEditMode)
                            @method('PUT') 
                        @endif

                        {{-- CAMPO: TÍTULO --}}
                        <div>
                            <x-input-label for="title" :value="__('Título:')" />
                            <x-text-input 
                                id="title" 
                                class="block mt-1 w-full" 
                                type="text" 
                                name="title"
                                {{-- value: si hay un error previo (old) usa ese, si no, usa el valor de la DB (edit), si no, vacío (create) --}}
                                :value="old('title', $article->title ?? '')" 
                                required autofocus 
                            />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- CAMPO: DESCRIPCIÓN (TEXTAREA) --}}
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Contenido:')" />
                            <textarea 
                                name="description" 
                                id="description" 
                                rows="5" 
                                required
                                class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            >{{ old('description', $article->description ?? '') }}</textarea>
                            {{-- Contenido del textarea: misma lógica que el título --}}
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        {{-- CAMPO: FECHA --}}
                        <div class="mt-4">
                            <x-input-label for="created_at" :value="__('Fecha:')" />
                            <x-text-input 
                                id="created_at" 
                                class="block mt-1 w-full" 
                                type="date" 
                                name="created_at"
                                {{-- Lógica de fecha:
                                     1. old() tiene prioridad
                                     2. si es edición ($article existe), formatea su fecha
                                     3. si es creación, usa la fecha actual (date('Y-m-d')) 
                                --}}
                                :value="old('created_at', optional($article->created_at ?? null)->format('Y-m-d') ?: date('Y-m-d'))" 
                                required 
                            />
                            <x-input-error :messages="$errors->get('created_at')" class="mt-2" />
                        </div>

                        {{-- BOTONES DE ACCIÓN --}}
                        <div class="flex items-center justify-between mt-6">
                            {{-- Texto del botón cambia según el modo --}}
                            <x-primary-button type="submit">
                                {{ $isEditMode ? 'Guardar Cambios' : 'Guardar Artículo' }}
                            </x-primary-button>

                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                href="{{ route('articles.index') }}">
                                ← Volver a la lista de artículos
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection