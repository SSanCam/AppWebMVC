<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - TemuGram</title>
    <link rel="stylesheet" href="{{ asset('css/app.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/show.css?v=' . time()) }}">

</head>

<body>
    @include('partials.header')

    <main>
        <div class="post-detail-container">
            <h2 class="post-title">{{ $post->title }}</h2>

            <!-- Imagen del post -->
            @if ($post->image)
                <div class="post-image">
                    <img src="{{ Storage::url($post->image) }}" alt="Imagen del post" class="post-img">
                </div>
            @endif

            <!-- Descripción del post -->
            <p class="post-description">{{ $post->description }}</p>

            <!-- Información adicional -->
            <p><strong>{{ $post->user->name }} </strong>- {{ $post->created_at }}</p>

            <!-- Contador de likes -->
            <p><strong>❤️ Le ha gustado a: </strong>{{ $post->n_likes }} persona/s</p>

            <!-- Formulario para eliminar el post (solo si el usuario logueado es el autor del post) -->
            @if (Auth::check() && Auth::id() === $post->user_id)
                <!-- Formulario para eliminar el post (solo si el usuario logueado es el autor del post) -->
                <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Eliminar este post</button>
                </form>
            @endif

            <!-- Sección de comentarios -->
            <h3 class="comments-section">Comentarios:</h3>
            @foreach ($post->comments as $comment)
                <div class="comment">
                    <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>

                    <!-- Eliminar comentario solo si el usuario es el autor -->
                    @if (Auth::check() && Auth::id() === $comment->user_id)
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-comment-button">Eliminar Comentario</button>
                        </form>
                    @endif
                </div>
            @endforeach


            <!-- Formulario para agregar un comentario -->
            <h3 class="comments-section">Agregar Comentario:</h3>
            <form action="{{ route('post.create_comment', $post->id) }}" method="POST" class="comment-form">
                @csrf
                <textarea name="comment" required placeholder="Escribe tu comentario..."></textarea>
                <button type="submit" class="comment-button">Comentar</button>
            </form>

            <a href="{{ route('post.index') }}" class="back-link">Volver a los Posts</a>
        </div>
    </main>

    <footer>
        @include('partials.footer')
    </footer>
</body>

</html>