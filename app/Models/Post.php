<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Post
 * Representa una publicación en la aplicación.
 * Se utiliza el trait HasFactory para permitir la creación de instancias mediante factories,
 * facilitando las pruebas y la generación de datos de ejemplo.
 * 
 * @property int $id Identificador único de la publicación
 * @property string $title Título de la publicación
 * @property string $description Descripción/contenido de la publicación
 * @property \Illuminate\Support\Carbon|null $publish_date Fecha y hora de la publicación
 * @property int $n_likes El número de likes que tiene la publicación
 * @property int $user_id Identificador del usuario que creó la publicación
 * @property string|null $image_url URL de la imagen asociada al post
 */
class Post extends Model
{
    use HasFactory;

    /**
     * Atributos que se pueden asignar de manera masiva.
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'publish_date',
        'n_likes',
        'user_id',
        'image_url'
    ];

    /**
     * Relación: Un post pertenece a un único usuario.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Post>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Un post puede tener múltiples comentarios.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Comment, Post>
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relación: Un post puede tener múltiples likes.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<User, Post>
     */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }
}
