<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Posts</title>
    <!-- Agregar estilos -->
    <link rel="stylesheet" href="{{ asset('css/indexposts.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/app.css?v=' . time()) }}">
</head>

<body>
    <!-- header -->
    <header>
        @include('partials.header') 
    </header>

    <!-- main -->
    <main>
        <div class="posts-list">
            @foreach ($posts as $post)
                <div class="post-card">
                    <!-- Imagen del post -->
                    @if ($post->image_url)
                        <div class="post-image">
                            <img src="{{ asset('storage/' . $post->image_url) }}" alt="Imagen del post" class="post-img">
                        </div>
                    @endif

                    <!-- Descripción del post -->
                    <div class="post-body">
                        <h2 class="post-title">
                            <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                        </h2>
                        <div class="info-post">
                            <p class="post-description">{{ $post->description }}</p>
                            <p class="publicado-por"><strong>Publicado por:</strong> {{ $post->user->name }} || Likes:
                                {{ $post->n_likes }} || Comentarios: {{ $post->comments()->count() }}
                            </p>
                        </div>
                    </div>
                    <!-- Botones de like y eliminar -->
                    <div class="post-actions">
                        <form action="{{ route('post.like', $post->id) }}" method="POST" class="like-form">
                            @csrf
                            <button type="submit" class="like-button">❤️</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- footer -->
    <footer>
        @include('partials.footer') 
    </footer>
</body>

</html>