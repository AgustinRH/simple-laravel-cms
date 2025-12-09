<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>
    <h1>Comparar números</h1>

    <form method="POST" action="/comparar">
        @csrf
        <label for="numero1">Número 1:</label>
        <input type="number" name="numero1" id="numero1" required><br>
        <label for="numero2">Número 2:</label>
        <input type="number" name="numero2"id="numero2" required><br>

        <button type="submit">Comparar</button>
    </form>
</body>
</html>