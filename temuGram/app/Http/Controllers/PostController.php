<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

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
        // Validación de datos
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.min' => 'El título debe tener al menos 3 caracteres.',
            'title.max' => 'El título no puede superar los 255 caracteres.',
            'content.required' => 'El contenido es obligatorio.',
            'content.min' => 'El contenido debe tener al menos 10 caracteres.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'Formatos permitidos: jpeg, png, jpg, gif.',
            'image.max' => 'La imagen no puede superar los 2MB.',
        ]);

        // Manejo de imagen si se proporciona
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img', 'public'); // Cambiado a "img"
        }

        // Crear post
        Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'user_id' => Auth::id(), // Usuario autenticado
        ]);

        return redirect()->route('posts.index')->with('success', 'Post creado correctamente.');

    }

    /**
     * Muestra un post específico.
     * @param int $id
     * @return View
     */
    public function show($id): View
    {
        $post = Post::findOrFail($id);
        return view("post.show", compact("post"));
    }


    /**
     * Actualiza un post.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        // Verificar si el usuario autenticado es el propietario del post
        if (Auth::id() !== $post->user_id) {
            abort(403, 'No tienes permiso para editar este post.');
        }

        // Validación de datos
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.min' => 'El título debe tener al menos 3 caracteres.',
            'title.max' => 'El título no puede superar los 255 caracteres.',
            'content.required' => 'El contenido es obligatorio.',
            'content.min' => 'El contenido debe tener al menos 10 caracteres.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'Formatos permitidos: jpeg, png, jpg, gif.',
            'image.max' => 'La imagen no puede superar los 2MB.',
        ]);

        // Manejo de imagen (Si el usuario sube una nueva)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('img', 'public');
            $post->image = $imagePath;
        }

        // Actualizar los campos del post
        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $post->image, // Imagen actualizada si hay nueva
        ]);

        return redirect()->route('posts.index')->with('success', 'Post actualizado correctamente.');
    }


    /**
     * Elimina un post.
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(Request $request, $id): RedirectResponse
    {
        $post = Post::findOrFail($id);
    
        // Verificar si el usuario autenticado es el propietario del post
        if (Auth::id() !== $post->user_id) {
            abort(403, 'No tienes permiso para eliminar este post.');
        }
    
        // Si el post tiene una imagen, eliminarla del almacenamiento
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
    
        // Eliminar el post
        $post->delete();
    
        return redirect()->route('posts.index')->with('success', 'Post eliminado correctamente.');
    }


    
}
