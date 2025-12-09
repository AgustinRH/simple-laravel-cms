# Simple Laravel CMS

Una aplicación web de gestión de contenido (CMS) ligera y moderna construida con **Laravel 10** y **Tailwind CSS**. Este proyecto sirve como una plataforma para publicar artículos, gestionar autores y demostrar funcionalidades clave del framework Laravel, incluyendo autenticación, autorización, Eloquent ORM y Blade Templates.

![Laravel Logo](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)

## 🚀 Características Principales

*   **Autenticación Robusta**: Sistema completo de login, registro y recuperación de contraseñas utilizando **Laravel Breeze**.
*   **Gestión de Artículos (CRUD)**:
    *   Crear, leer, actualizar y eliminar artículos.
    *   Asignación automática de autores a los artículos.
    *   **Autorización**: Los usuarios solo pueden editar o eliminar sus *propios* artículos.
*   **Roles y Permisos**: Lógica integrada para asegurar que solo los propietarios del contenido puedan modificarlo.
*   **Dashboard Interactivo**: Panel de control para usuarios autenticados.
*   **Diseño Responsivo**: Interfaz de usuario moderna y adaptable construida con **Tailwind CSS**.
*   **Funcionalidades Extra**:
    *   Ejemplo de saludo dinámico (`/Hola`).
    *   Comparador de números con lógica de controlador (`/comparar`).
    *   Listado de todos los autores y sus publicaciones.

## 🛠️ Tecnologías Utilizadas

*   **Backend**: [Laravel Framework](https://laravel.com) (PHP 8.2+)
*   **Frontend**: [Blade Templates](https://laravel.com/docs/blade), [Tailwind CSS](https://tailwindcss.com), [Alpine.js](https://alpinejs.dev)
*   **Base de Datos**: MySQL (o compatible con SQLite/PostgreSQL)
*   **Herramientas de Desarrollo**: Vite, Composer, NPM

## 📋 Requisitos del Sistema

Asegúrate de tener instalado lo siguiente en tu entorno local:

*   PHP >= 8.2
*   Composer
*   Node.js & NPM
*   Servidor de Base de Datos (MySQL, MariaDB o SQLite)

## 🔧 Instalación y Configuración

Sigue estos pasos para levantar el proyecto en tu máquina local:

1.  **Clonar el repositorio**
    ```bash
    git clone https://github.com/tu-usuario/simple-laravel-cms.git
    cd simple-laravel-cms
    ```

2.  **Instalar dependencias de PHP**
    ```bash
    composer install
    ```

3.  **Instalar dependencias de Frontend**
    ```bash
    npm install
    npm run build
    ```

4.  **Configurar entorno**
    Copia el archivo de ejemplo y genera la clave de la aplicación:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Configura tus credenciales de base de datos en el archivo `.env` (DB_DATABASE, DB_USERNAME, etc.).*

5.  **Migrar y Sembrar la Base de Datos**
    Este comando creará las tablas necesarias y poblará la base de datos con usuarios y artículos de prueba (incluyendo un "Test User").
    ```bash
    php artisan migrate --seed
    ```

6.  **Iniciar el Servidor**
    ```bash
    php artisan serve
    ```
    La aplicación estará disponible en `http://localhost:8000`.

## 📖 Uso

### Usuarios de Prueba
El `DatabaseSeeder` crea un usuario de prueba por defecto:
*   **Email**: `test@example.com`
*   **Contraseña**: `password`

También se generan múltiples usuarios y artículos aleatorios mediante `Faker`.

### Navegación
*   **Inicio**: Página de bienvenida estándar.
*   **Artículos**: `/articles` - Ver todos los artículos.
*   **Login/Registro**: Accesible desde el menú superior.
*   **Dashboard**: `/dashboard` - Área privada tras iniciar sesión.

## 📂 Estructura del Proyecto

El código ha sido documentado exhaustivamente para facilitar su comprensión. Los directorios principales son:

*   `app/Http/Controllers`: Lógica de negocio (ArticlesController, ProfileController, NumeroController, etc.).
*   `app/Models`: Modelos Eloquent (User, Article).
*   `resources/views`: Plantillas Blade (Layouts, Articles, Auth, Profile).
*   `routes`: Definición de rutas web y de autenticación.
*   `database/seeders`: Datos de prueba para el desarrollo.

## 📄 Licencia

Este proyecto es software de código abierto licenciado bajo la [MIT license](https://opensource.org/licenses/MIT).
