<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/**
 * Controlador de comentarios.
 */

abstract class Controller
{

    /**
     * Crea un nuevo comentario.
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function create(Request $request)
    {
        //TODO
    }


    /**
     * Actualiza un comentario.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return void
     */
    public function update(Request $request, Comment $comment)
    {
        //TODO
    }

    /**
     * Elimina un comentario.
     * @param \App\Models\Comment $comment
     * @return void
     */
    public function delete(Comment $comment)
    {
        //TODO
    }

    /**
     * Muestra los comentarios de un post.
     * @param mixed $postId
     * @return void
     */
    public function index($postId)
    {
        //TODO
    }
}
