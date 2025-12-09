<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController; // Importar el Controller de Laravel

// Ya no debe ser 'abstract'
class Controller extends BaseController // Extender la clase base del framework
{
    use AuthorizesRequests, ValidatesRequests;
}