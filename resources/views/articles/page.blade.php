@extends('layouts.master')

@section('title', 'Página de artículos')

@section('sidebar')
    @parent
    <p>Sección adicional del sidebar para artículos</p>
@endsection

@section('content')
    <h1>Información del autor</h1>
    <p><strong>ID del autor:</strong> {{ $id }}</p>
    <p><strong>Nombre del autor:</strong> {{ $autor }}</p>

    <br>

    <h2>Artículos del autor</h2>
    @if ($articles->isNotEmpty())
        <ul>
            @foreach ($articles as $article)
                <li>
                    <strong>{{ $article->title }}</strong><br>
                    {{ $article->description }}<br>
                    <em>Creado el: {{ $article->created_at->format('d/m/Y') }}</em>
                </li>
            @endforeach
        </ul>
    @else
        <p>No hay artículos.</p>
    @endif
@endsection