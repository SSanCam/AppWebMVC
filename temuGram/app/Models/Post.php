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
 * @property int $id Identificador unico de la publicacion
 * @property string $title Titulo de la publicacion 
 * @property string $description Descripcion/contenido de la publicacion
 * @property \Illuminate\Support\Carbon|null $publish_date Fecha y hora de la publicacion
 * @property int $n_likes El numero de likes que tiene la publicacion
 * @property int $user_id Identificador del usuario que creo la publicacion 
 */
class Post extends Model
{
    use HasFactory;

    /**
     * Summary of fillable
     * Atributos que se pueden asignar de manera masiva.
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'publish_date',
        'n_likes',
        'user_id'
    ];

    /**
     * Summary of casts
     * Con la conversión 'datetime' en publish_date, Laravel lo convierte automáticamente
     * a una instancia de Carbon, facilitando su manipulación y formateo.
     * @var array
     */
    protected $casts = [
        'publish_date' => 'datetime',
    ];

    /**
     * Relación: Un post pertenece a un único usuario.vvvv
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Post>
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Un post puede tener múltiples comentarios.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Comment, Post>
     */
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
