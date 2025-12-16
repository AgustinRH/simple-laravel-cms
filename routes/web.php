<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolaController;
use App\Http\Controllers\BienvenidaController;
use App\Http\Controllers\NumeroController;
use App\Http\Controllers\ArticlesController;

/*
|--------------------------------------------------------------------------
| Web Routes (Rutas Web)
|--------------------------------------------------------------------------
|
| Aquí es donde se registran las rutas web para la aplicación.
| Estas rutas son cargadas por el RouteServiceProvider y todas ellas
| tienen asignado el grupo de middleware "web".
|
*/

// ==========================================
// RUTA PRINCIPAL
// ==========================================
// Página de inicio que muestra la vista 'welcome'.
Route::get('/', function () {
    return view('welcome');
});

// ==========================================
// RUTAS PROTEGIDAS (Requieren Login)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {

    // Prueba de datos para el dashboard (depuración)
    Route::get('/test-data', [ArticlesController::class, 'testDashboardData']);

    // DASHBOARD
    // Muestra el resumen de actividad del usuario (modificado para usar ArticlesController).
    Route::get('/dashboard', [ArticlesController::class, 'dashboardSummary'])->name('dashboard');

    // CRUD DE ARTÍCULOS
    // Crea automáticamente las rutas: index, create, store, show, edit, update, destroy.
    Route::resource('articles', ArticlesController::class);

    // PERFIL DE USUARIO
    // Rutas para editar, actualizar y eliminar el perfil del usuario.
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// AUTENTICACIÓN
// ==========================================
// Carga las rutas de autenticación de Laravel Breeze (login, registro, etc.)
require __DIR__ . '/auth.php';


// ==========================================
// RUTAS DE EJEMPLO / PÚBLICAS
// ==========================================

// Ejemplo básico: Retorna un string
Route::get('/saludo', function () {
    return '¡Hola, Buenos días!';
});

// Ejemplo Controller: Usa un método simple
Route::get('/saludo2', [HolaController::class, 'index']);

// Ejemplo Parámetros: Recibe {nombre} por URL
Route::get('/hola/{nombre}', [BienvenidaController::class, 'show']);

// Ejemplo Formulario: Comparación de números (GET muestra form, POST procesa)
Route::get('/comparar', [NumeroController::class, 'formulario']);
Route::post('/comparar', [NumeroController::class, 'comparar']);

// ==========================================
// CONSULTAS AVANZADAS ELOQUENT (Testing)
// ==========================================

// Relación: Autor -> Artículos
Route::get('/author/{id}', [ArticlesController::class, 'showAuthor']);

// Relación: Autores con Artículos
Route::get('/authors', [ArticlesController::class, 'showAllAuthors']);

// Tests varios de Eloquent
Route::get('/test-eloquent', [ArticlesController::class, 'testEloquent']);