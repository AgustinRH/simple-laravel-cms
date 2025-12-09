<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
</head>

<body>

    <nav style="background:#f5f5f5; padding:10px;">
        <a href="{{ route('articles.index') }}">Artículos</a> |
        <a href="{{ route('articles.create') }}">Nuevo artículo</a>
    </nav>

    <div class="container" style="padding:20px;">
        @yield('content')
    </div>

</body>

</html>