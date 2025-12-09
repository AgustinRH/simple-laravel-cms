<x-app-layout>
    {{--
    DEFINICIÓN DEL HEADER
    Usamos <x-slot name="header"> para insertar contenido en la variable $header del layout.
        Esto se renderizará dentro de las etiquetas <header> en app.blade.php.
            --}}
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>

            {{--
            CONTENIDO PRINCIPAL
            Todo lo que está fuera del x-slot se considera el $slot por defecto.
            Esto se inyectará donde pusimos {{ $slot ?? '' }} en el layout.
            --}}
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">

                            {{-- BIENVENIDA PERSONALIZADA --}}
                            <h3 class="text-2xl font-bold mb-4">
                                ¡Bienvenido/a, {{ Auth::user()->name }}! 👋
                            </h3>

                            <p class="mb-6 text-lg text-gray-700 dark:text-gray-300">
                                Este es tu panel de control. Aquí puedes ver un resumen de tu actividad.
                            </p>

                            {{-- TARJETA DE ESTADÍSTICAS --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                                {{-- Artículos Publicados --}}
                                <div
                                    class="bg-indigo-50 dark:bg-indigo-900/50 p-6 rounded-xl shadow-lg border border-indigo-200 dark:border-indigo-900">
                                    <h4
                                        class="text-md font-semibold text-indigo-800 dark:text-indigo-200 uppercase tracking-wider">
                                        Tus Artículos
                                    </h4>
                                    <p class="text-5xl font-extrabold text-indigo-600 dark:text-indigo-400 mt-2">
                                        {{ $articleCount }}
                                    </p>
                                    <a href="{{ route('articles.index') }}"
                                        class="text-sm text-indigo-600 dark:text-indigo-300 hover:text-indigo-800 dark:hover:text-indigo-100 mt-3 inline-block font-medium transition duration-150">
                                        Gestionar mis publicaciones →
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
</x-app-layout>