{{-- Extiende del layout 'master' (una plantilla simple) --}}
@extends('layouts.master')

{{-- Define el título de la página --}}
@section('title', $article->title)

{{-- Sección principal de contenido --}}
@section('content')
    <h1>{{ $article->title }}</h1>

    {{-- Muestra información del autor y fecha --}}
    <p><strong>Autor:</strong> {{ $article->user->name }}</p>
    <p><strong>Fecha de creación:</strong> {{ $article->created_at->format('d/m/Y') }}</p>
    <hr>

    {{-- Muestra el contenido del artículo --}}
    <p>{{ $article->description }}</p>

    <a href="{{ route('articles.index') }}">← Volver a la lista de artículos</a>
@endsection