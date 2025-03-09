<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

/**
 * Controlador para los post.
 */
class PostController extends Controller
{
    /**
     * Muestra todos los post.
     * @return View
     */
    public function index(): View
    {
        $posts = Post::orderBy("created_at", "desc")->get();
        return view("post.index", compact("posts"));
    }

    /**
     * Muestra la vista para editar un post.
     * @param \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Corregir aquí
        ]);

        // Se verifica si se ha cargado la imagen
        $defaultimage_url = null;

        if ($request->hasFile('image_url')) {
            $defaultimage_url = $request->file('image_url')->store('img', 'public');
        }

        // Se crea el post
        Post::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_url' => $defaultimage_url, // Corregir aquí
            'user_id' => Auth::id(),
        ]);

        // Redirige a la página de posts después de crear un post
        return redirect()->route('post.index')->with('success', 'Post creado correctamente.');
    }

    /**
     * Muestra la vista para editar un post.
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            abort(403, 'No tienes permiso para editar este post.');
        }

        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10',
            'image_url' => 'nullable|image_url|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Si hay una nueva image_url, se actualiza
        if ($request->hasFile('image_url')) {
            $image_urlPath = $request->file('image_url')->store('img', 'public');
            $post->image_url = $image_urlPath;
        }

        $post->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_url' => $post->image_url,
        ]);

        return redirect()->route('post.index')->with('success', 'Post actualizado correctamente.');
    }

    /**
     * Elimina un post.
     * @param mixed $id
     * @return mixed|RedirectResponse
     */
    public function destroy($id)
    {
        // Buscar el post por el ID
        $post = Post::findOrFail($id);

        // Eliminar la imagen si existe
        if ($post->image_url && Storage::exists('public/' . $post->image_url)) {
            Storage::delete('public/' . $post->image_url);
        }

        // Eliminar el post de la base de datos
        $post->delete();

        // Redirigir al índice de post
        return redirect()->route('post.index');
    }

    /**
     * Muestra un post y sus comentarios.
     * @param int $id
     * @return View
     */
    public function show($id): View
    {
        $post = Post::findOrFail($id);
        return view('post.show', compact('post'));
    }

    /**
     * Muestra la vista para crear un nuevo post.
     * @return View
     */
    public function showCreate(): View
    {
        return view('post.create');
    }

    /**
     * Muestra la vista para editar un post.
     * @param mixed $id
     * @return RedirectResponse
     */
    public function like($id)
    {
        $post = Post::findOrFail($id);

        // Lógica para manejar el like
        $post->n_likes = $post->n_likes + 1;
        $post->save();

        // Redirigir de vuelta a la lista de post
        return redirect()->route('post.index')->with('success', 'Post liked!');
    }

    /**
     * Añade un comentario a un post.
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return mixed|RedirectResponse
     */
    public function addComment(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Validación del comentario
        $validated = $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        // Crear el comentario asociado al post
        $post->comments()->create([
            'comment' => $validated['comment'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('post.show', $post->id);
    }

    /**
     * Muestra la imagen de un post.
     * @param mixed $filename
     * @return mixed|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function showImage($filename)
    {
        // Ruta completa del archivo en el servidor
        $path = storage_path('resources/' . $filename);

        if (file_exists($path)) {
            return response()->file($path);
        }

        abort(404);
    }

}
