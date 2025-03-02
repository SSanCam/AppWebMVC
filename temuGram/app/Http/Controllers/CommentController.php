<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador de comentarios.
 */
class CommentController extends Controller
{
    /**
     * Muestra los comentarios de un post.
     * @param mixed $postId
     * @return void
     */
    public function index($postId): \Illuminate\View\View
    {
        $post = Post::findOrFail($postId);
        $comments = $post->comments()->orderBy('publish_date', 'desc')->get();

        return view('comment.index', compact('post', 'comments'));
    }

    /**
     * Almacena un nuevo comentario.
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Valida los datos del formulario
        $request->validate([
            'comment' => 'required|string|min:3|max:500',
            'post_id' => 'required|exists:posts,id'
        ], [
            'comment.required' => 'El comentario no puede estar vacío.',
            'comment.min' => 'El comentario debe tener al menos 3 caracteres.',
            'comment.max' => 'El comentario no puede superar los 500 caracteres.',
            'post_id.required' => 'El comentario debe estar asociado a un post.',
            'post_id.exists' => 'El post seleccionado no existe.'
        ]);

        // Crear un nuevo comentario
        $comment = Comment::create([
            'comment' => $request->comment,
            'post_id' => $request->post_id,
            'user_id' => Auth::id(), // Usuario autenticado
            'publish_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Comentario publicado correctamente.');

    }


    /**
     * Muestra un comentario específico.
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id): \Illuminate\View\View
    {
        $comment = Comment::findOrFail($id);

        return view('comment.show', compact('comment'));
    }


    /**
     * Actualiza un comentario.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Comment $comment): \Illuminate\Http\RedirectResponse
    {
        // Verifica si el usuario autenticado es el autor
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'No tienes permiso para editar este comentario.');
        }

        // Valida la entrada
        $request->validate([
            'comment' => 'required|string|min:3|max:500',
        ], [
            'comment.required' => 'El comentario no puede estar vacío.',
            'comment.min' => 'El comentario debe tener al menos 3 caracteres.',
            'comment.max' => 'El comentario no puede superar los 500 caracteres.',
        ]);

        // Actualiza el comentario
        $comment->update([
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comentario actualizado.');
    }

    /**
     * Elimina un comentario.
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Comment $comment): \Illuminate\Http\RedirectResponse
    {
        // Solo el autor o un administrador pueden eliminarlo
        if (Auth::id() !== $comment->user_id && !Auth::user()->is_admin) {
            abort(403, 'No tienes permiso para eliminar este comentario.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comentario eliminado.');
    }

}
