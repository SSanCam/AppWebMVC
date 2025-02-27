<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Summary of Comment
 * 
 * @property int $id Identificador unico del comentario
 * @property string $comment Texto del comentario
 * @property \Illuminate\Support\Carbon|null $publish_date Fecha de publicacion
 * @property int $user_id Identificador del usuario que realizo el comentario
 * @property int $post_id Identificador del post al que pertenece el comentario
 */


class Comment extends Model
{
    // Se incluye HasFactory para poder usar Comment::factory() en tests y seeds
    use HasFactory;
    /**
     * Summary of fillable
     * Atributos que se pueden asignar masivamente.
     * @var array
     */
    protected $fillable = [
        'comment',
        'publish_date',
        'user_id',
        'post_id'
    ];

    /**
     * Summary of cast
     * Atributos que deben ser convertidos a un tipo específico.
     * Laravel convierte el valor de $publish_date a una instancia de Carbon, que extiende de DateTime.
     * 
     * @var array
     */
    protected $casts = [
        'publish_date' => 'datetime',
    ];

    /**
     * Summary of user
     * Relación: Un comentario pertenece a un usuario.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Comment>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Summary of comments
     * Relación: Un comentario pertenece a un post.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Comment, Comment>
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
