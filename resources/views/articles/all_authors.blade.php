@extends('layouts.master')

@section('title', 'Autores y artículos')

@section('sidebar')
    @parent
    <p>Sección adicional del sidebar para artículos</p>
@endsection

@section('content')
    <h1>Todos los autores y sus artículos</h1>

    {{-- Itera sobre todos los usuarios (autores) --}}
    @foreach ($authors as $author)
        <h2>{{ $author->name }} (ID: {{ $author->id }})</h2>

        {{-- Verifica si el autor tiene artículos asociados --}}
        @if ($author->articles->isNotEmpty())
            <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; width: 100%; margin-bottom: 20px;">
                <thead style="background-color: #f0f0f0;">
                    <tr>
                        <th>Título del artículo</th>
                        <th>Descripción</th>
                        <th>Fecha de creación</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Itera sobre los artículos de CADA autor --}}
                    @foreach ($author->articles as $article)
                        <tr>
                            <td>{{ $article->title }}</td>
                            <td>{{ $article->description }}</td>
                            <td>{{ $article->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p><em>Este autor no tiene artículos.</em></p>
        @endif
    @endforeach
@endsection