<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva publicación</title>
    <!-- Agregar estilos -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/createposts.css') }}">

</head>

<body>
    <!-- header -->
    <header>
        @include('partials.header')
    </header>

    <!-- main -->
    <main>
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

                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Título del Post -->
                    <label class="create-post-label" for="title">Título:</label>
                    <input class="create-post-input" type="text" name="title" value="{{ old('title') }}" required>

                    <!-- Descripción del Post -->
                    <label class="create-post-label" for="description">Descripción:</label>
                    <textarea class="create-post-input" name="description" rows="5"
                        required>{{ old('description') }}</textarea>

                    <!-- Cargar Imagen -->
                    <label class="create-post-label" for="image_url">Imagen (opcional):</label>
                    <input class="create-post-input" type="file" name="image_url">

                    <!-- Botón para enviar el formulario -->
                    <button class="create-post-button" type="submit">Crear Post</button>
                </form>
            </div>
        </div>
    </main>

    <!-- footer -->
    <footer>
        @include('partials.footer')
    </footer>
</body>

</html>