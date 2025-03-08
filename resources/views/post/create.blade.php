<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva publicación</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
    <header>
        @include('partials.header')
    </header>
    <main>

        @section('content')
            <div class="create-post-wrapper">
                <div class="create-post-container">
                    <h2 class="create-post-title">Crear Nuevo Post</h2>

                    <!-- Mostrar errores de validación -->
                    @if ($errors->any())
                        <div class="error-messages">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Título del Post -->
                        <label class="create-post-label" for="title">Título:</label>
                        <input class="create-post-input" type="text" name="title" value="{{ old('title') }}" required>

                        <!-- Contenido del Post -->
                        <label class="create-post-label" for="content">Contenido:</label>
                        <textarea class="create-post-input" name="content" rows="5" required>{{ old('content') }}</textarea>

                        <!-- Cargar Imagen -->
                        <label class="create-post-label" for="image">Imagen (opcional):</label>
                        <input class="create-post-input" type="file" name="image">

                        <!-- Botón para enviar el formulario -->
                        <button class="create-post-button" type="submit">Crear Post</button>
                    </form>
                </div>
            </div>
        @endsection
    </main>

    <footer>
        @include('partials.footer')
    </footer>
</body>

</html>