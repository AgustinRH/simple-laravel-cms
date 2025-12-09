<!DOCTYPE html>
<html>
<head>
    <title>Resultado</title>
</head>
<body>
    <h1>Resultado de la Comparación</h1>

    <p>Números introducidos: {{ $numero1 }} y {{ $numero2 }}</p>
    <p>Menor: {{ $menor }}</p>
    <p>Mayor: {{ $mayor }}</p>
    <p>Números entre ellos:</p>
    <ul>
        @foreach ($numeros as $num)
            <li>{{ $num }}</li>
        @endforeach
    </ul>

    <a href="/comparar">Volver</a>
</body>
</html>