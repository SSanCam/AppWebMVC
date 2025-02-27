<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Muestra todos los posts en la página principal.
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Muestra el formulario para crear un post.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Guarda un nuevo post.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'publish_date' => now(),
            'user_id' => Auth::id(),
        ]);

        return redirect('/')->with('success', 'Post publicado.');
    }

    /**
     * Muestra un post en detalle.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Elimina un post (solo si pertenece al usuario autenticado).
     */
    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403, 'No tienes permiso para eliminar este post.');
        }

        $post->delete();
        return redirect('/')->with('success', 'Post eliminado.');
    }
}
