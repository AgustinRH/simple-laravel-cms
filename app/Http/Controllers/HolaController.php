<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controlador de Ejemplo (HolaController)
 * Demuestra una respuesta simple retornando texto plano.
 */
class HolaController extends Controller
{

   // Método índice: Retorna un saludo simple.
   public function index()
   {
      return "Hola, mundo";
   }
}
