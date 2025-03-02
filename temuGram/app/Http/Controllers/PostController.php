<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Controlador de publicaciones (posts).
 */
class PostController extends Controller
{
    /**
     * Muestra todos los posts.
     * @return View
     */
    public function index(): View
    {
        $posts = Post::orderBy("created_at", "desc")->get();
        return view("post.index", compact("posts"));
    }

    /**
     * Almacena un nuevo post.
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        return back(); // TEMPORAL hasta implementar
    }

    /**
     * Muestra un post específico.
     * @param int $id
     * @return View
     */
    public function show($id): View
    {
        return view('post.show'); // TEMPORAL hasta implementar
    }

    /**
     * Actualiza un post.
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        return redirect()->route('posts.index'); // TEMPORAL hasta implementar
    }

    /**
     * Elimina un post.
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Request $request, Post $post): RedirectResponse
    {
        return back(); // TEMPORAL hasta implementar
    }
}
