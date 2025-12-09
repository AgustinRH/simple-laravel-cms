<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controlador de Números
 * Ejemplo de procesamiento de formularios y lógica matemática simple.
 */
class NumeroController extends Controller
{
    // Muestra la vista del formulario para introducir números
    public function formulario()
    {
        return view('comparar');
    }

    // Procesa el formulario enviado por POST
    public function comparar(Request $request)
    {
        // Valida que los inputs sean números obligatorios
        $request->validate([
            'numero1' => 'required|numeric',
            'numero2' => 'required|numeric'
        ]);

        $numero1 = $request->input('numero1');
        $numero2 = $request->input('numero2');

        // Lógica de comparación
        $menor = min($numero1, $numero2);
        $mayor = max($numero1, $numero2);

        // Genera un rango de números entre el menor y el mayor
        $numeros = range($menor, $mayor);

        // Retorna la vista 'resultado' con los datos calculados
        return view('resultado', compact('numero1', 'numero2', 'mayor', 'menor', 'numeros'));
    }


}
