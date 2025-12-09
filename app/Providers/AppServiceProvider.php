<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // <-- ¡AÑADE ESTA LÍNEA!

/**
 * Proveedor de Servicios Principal (AppServiceProvider)
 * Aquí se configuran servicios globales de la aplicación y configuraciones de arranque.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra servicios en el contenedor de inyección de dependencias.
     */
    public function register(): void
    {
        //
    }

    /**
     * Inicializa cualquier servicio de la aplicación después de que todos los servicios hayan sido registrados.
     */
    public function boot(): void
    {
        // Configura la longitud predeterminada de las cadenas para las migraciones.
        // Esto previene errores de "Specified key was too long" en versiones antiguas de MySQL/MariaDB.
        Schema::defaultStringLength(191);
    }
}