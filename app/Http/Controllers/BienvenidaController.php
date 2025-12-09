<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controlador de Bienvenida
 * Muestra ejemplos de paso de parámetros a vistas.
 */
class BienvenidaController extends Controller
{
    // Retorna un string simple
    public function index()
    {
        return "Hola, mundo";
    }

    // Recibe un parámetro por URL y lo pasa a la vista 'Hola'
    public function show($nombre)
    {
        return view('Hola', ['nombre' => $nombre]);
    }

    // Ejemplo de paso de datos estructurados (array) a una vista
    public function articles()
    {
        $data = [
            'id' => 1,
            'autor' => 'agustin',
            'articles' => ['articulo1', 'articulo2', 'articulo3']
        ];
        return view('articles.page', $data);
    }
}
