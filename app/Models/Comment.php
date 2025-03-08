<?php

namespace App\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Comment
 * Representa un comentario en la aplicación.
 * Se utiliza el trait HasFactory para permitir la creación de instancias mediante factories,
 * facilitando las pruebas y la generación de datos de ejemplo.
 * 
 * @property int $id Identificador único del comentario
 * @property string $comment Contenido del comentario
 * @property int $user_id Identificador del usuario que creó el comentario
 * @property int $post_id Identificador del post al que pertenece el comentario
 * @property \Illuminate\Support\Carbon|null $created_at Fecha de creación
 * @property \Illuminate\Support\Carbon|null $updated_at Última actualización
 */
class Comment extends Model
{
    use HasFactory;

    /**
     * Atributos que se pueden asignar de manera masiva.
     * @var array
     */
    protected $fillable = [
        'comment',
        'publish_date',
        'user_id',
        'post_id'
    ];

    /**
     * Relación: Un comentario pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Un comentario pertenece a un post.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}