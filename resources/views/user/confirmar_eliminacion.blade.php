<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar eliminación de cuenta</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

    <!-- Header -->
    <header>
        @include('partials.header')
    </header>

    <!-- Main content -->
    <main>
        <div class="confirm-wrapper">
            <div class="confirm-container">
                <h2 class="confirm-title">¿Estás seguro de que deseas eliminar tu cuenta?</h2>
                <p class="confirm-message">Esta acción es irreversible. Todos tus datos se perderán.</p>

                <form action="{{ route('user.destroy', Auth::user()->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="confirm-actions">
                        <button type="submit" class="confirm-button">Eliminar cuenta</button>
                        <a href="{{ route('user.profile', Auth::user()->id) }}" class="cancel-button">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        @include('partials.footer')
    </footer>
    
</body>
</html>
