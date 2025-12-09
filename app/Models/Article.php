<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Importar User para la relación

/**
 * Modelo de Artículo (Article)
 * Representa los artículos creados por los usuarios.
 */
class Article extends Model
{
    use HasFactory;

    // CAMPOS ASIGNABLES MASIVAMENTE
    // Protege contra asignación masiva. Solo estos campos pueden ser llenados con Article::create() o $article->update().
    protected $fillable = [
        'title',
        'description',
        'user_id' // Clave foránea del autor
    ];

    /**
     * RELACIÓN: Un artículo pertenece a un único usuario (autor).
     * Define la relación inversa de "uno a muchos" (Belongs To).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
