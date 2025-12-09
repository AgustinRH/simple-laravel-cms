<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador de Artículos (ArticlesController)
 * Gestiona toda la lógica relacionada con los artículos: CRUD, listados, relaciones y dashboard.
 */
class ArticlesController extends Controller
{
    /**
     * Constructor
     * Aplica el middleware 'auth' para asegurar que todos los métodos (excepto si se excluyeran)
     * requieran que el usuario haya iniciado sesión.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * INDEX (Listado de artículos)
     * Muestra todos los artículos ordenados por fecha de creación descendente.
     */
    public function index()
    {
        // Obtener TODOS los artículos, ordenados por fecha de creación (los más recientes primero).
        $articlesList = Article::orderBy('created_at', 'desc')->get();

        return view('articles.index', compact('articlesList'));
    }

    /**
     * SHOW (Ver detalle)
     * Muestra un único artículo identificado por su ID.
     * Si no existe, findOrFail lanza un error 404 automáticamente.
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    /**
     * CREATE (Formulario de creación)
     * Muestra la vista con el formulario para crear un nuevo artículo.
     * Reutilizamos artículos/create.blade.php tanto para crear como para editar.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * STORE (Guardar nuevo artículo)
     * Valida los datos del formulario y guarda un nuevo registro en la base de datos.
     */
    public function store(Request $request)
    {
        // Validación de campos del formulario
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'created_at' => 'required|date',
        ]);

        // Guardado usando la relación 'articles' del usuario autenticado.
        // Esto asigna automáticamente 'user_id' = Auth::id() al nuevo artículo.
        Auth::user()->articles()->create($validated);

        return redirect()->route('articles.index')->with('success', 'Artículo creado correctamente.');
    }

    /**
     * EDIT (Formulario de edición)
     * Muestra el formulario para editar un artículo existente.
     * Incluye validación de permisos: solo el dueño puede editar.
     */
    public function edit(Article $article)
    {
        // Autorización manual: Si el usuario actual no es el dueño, abortar con error 403.
        if ($article->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para modificar este artículo.');
        }

        // Retorna la vista con los datos del artículo para rellenar el formulario.
        return view('articles.create', [
            'article' => $article,
        ]);
    }

    /**
     * UPDATE (Actualizar artículo)
     * Valida y actualiza un artículo existente en la base de datos.
     */
    public function update(Request $request, Article $article)
    {
        // Autorización manual
        if ($article->user_id !== Auth::id()) {
            return redirect()->route('articles.index')
                ->with('error', 'No tienes permiso para editar este artículo.');
        }

        // Validación
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'created_at' => 'required|date',
        ]);

        // Actualización masiva con los datos validados
        $article->update($validated);

        return redirect()->route('articles.index')->with('success', 'Artículo actualizado correctamente.');
    }

    /**
     * DESTROY (Eliminar artículo)
     * Elimina un artículo de la base de datos.
     */
    public function destroy(Article $article)
    {
        // Autorización manual
        if ($article->user_id !== Auth::id()) {
            return redirect()->route('articles.index')
                ->with('error', 'No tienes permiso para eliminar este artículo.');
        }

        try {
            $article->delete();
            return redirect()->route('articles.index')
                ->with('success', 'Artículo borrado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('articles.index')
                ->with('error', 'Error al borrar el artículo.');
        }
    }

    // ==========================================
    // MÉTODOS DE CONSULTAS AVANZADAS / EXTRAS
    // ==========================================

    /**
     * topArticles
     * Ejemplo de consulta con condiciones (filtros)
     */
    public function topArticles()
    {
        $articlesList = Article::where('id', '>', 100)
            ->take(10)
            ->get();
        return view('articles.top', compact('articlesList'));
    }

    /**
     * showAuthor
     * Carga un usuario y sus artículos usando Eager Loading (with 'articles')
     */
    public function showAuthor($id)
    {
        $user = User::with('articles')->findOrFail($id);

        return view('articles.page', [
            'id' => $user->id,
            'autor' => $user->name,
            'articles' => $user->articles
        ]);
    }

    /**
     * showAllAuthors
     * Carga todos los usuarios con sus artículos (evita problema N+1)
     */
    public function showAllAuthors()
    {
        $authors = User::with('articles')->get();
        return view('articles.all_authors', compact('authors'));
    }

    /**
     * dashboardSummary
     * Prepara los datos para la vista del Dashboard principal.
     */
    public function dashboardSummary()
    {
        // Cuenta los artículos del usuario autenticado
        $articleCount = Auth::user()->articles()->count();

        return view('dashboard', compact('articleCount'));
    }

    /**
     * testEloquent
     * Método de prueba para demostrar varias operaciones de Eloquent ORM.
     * Retorna un JSON con los resultados.
     */
    public function testEloquent()
    {
        $allArticles = \App\Models\Article::all();
        $articleById = \App\Models\Article::find(1);
        $articleOrFail = null;

        try {
            $articleOrFail = \App\Models\Article::findOrFail(1);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $articleOrFail = "No se encontró el artículo con ID 1";
        }

        $articlesWithCondition = \App\Models\Article::where('id', '>', 2)->take(5)->get();

        // Creación de prueba (¡Se ejecutará cada vez que se llame a la ruta!)
        $newArticle = new \App\Models\Article();
        $newArticle->title = 'Artículo de prueba (Test)';
        $newArticle->description = 'Descripción de prueba (Test)';
        $newArticle->user_id = 1;
        $newArticle->save();

        return response()->json([
            'all_articles' => $allArticles,
            'article_by_id' => $articleById,
            'article_or_fail' => $articleOrFail,
            'articles_with_condition' => $articlesWithCondition,
            'new_article_created' => $newArticle,
        ]);
    }
}