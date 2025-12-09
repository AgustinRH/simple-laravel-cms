<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

/**
 * Proveedor de Servicios de Rutas
 * Se encarga de cargar y configurar los archivos de rutas (web.php, api.php).
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * CONSTANTE HOME
     * Define la ruta a la que se redirige a los usuarios tras loguearse.
     * Modificado para apuntar a '/articles' en lugar del dashboard por defecto.
     *
     * @var string
     */
    public const HOME = '/articles';

    /**
     * Método de arranque (boot)
     * Define los grupos de rutas, middleware y limitadores de velocidad.
     */
    public function boot(): void
    {
        // Configura la limitación de peticiones (Rate Limiting)
        $this->configureRateLimiting();

        $this->routes(function () {
            // Rutas de API (prefijo /api, middleware 'api')
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Rutas WEB (middleware 'web', gestión de sesiones, CSRF, etc.)
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configura el limitador de tasa para las peticiones API.
     * Por defecto: 60 peticiones por minuto por usuario/IP.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}