<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    {{-- Define el título dinámicamente usando @yield --}}
    <title>@yield('title')</title>
</head>

<body>

    {{-- Navegación simple para el layout Master --}}
    <nav style="background:#f5f5f5; padding:10px;">
        <a href="{{ route('articles.index') }}">Artículos</a> |
        <a href="{{ route('articles.create') }}">Nuevo artículo</a>
    </nav>

    {{-- Contenedor principal donde se inyectará el contenido de las vistas hijas --}}
    <div class="container" style="padding:20px;">
        @yield('content')
    </div>

</body>

</html>