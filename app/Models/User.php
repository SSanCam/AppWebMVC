<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación: Un usuario puede tener múltiples publicaciones.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Post, User>
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Relación: Un usuario puede tener múltiples comentarios.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Comment, User>
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relación: Un usuario puede dar like a múltiples publicaciones.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<Post, User>
     */
    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

}
