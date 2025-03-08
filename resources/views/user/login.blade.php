<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/login.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/app.css?v=' . time()) }}">



</head>

<body>


    <!-- Header -->
    <header>
        @include('partials.header')
    </header>

    <main>
        <div class="login-wrapper">
            <div class="login-container">
                <h2 class="login-title">Iniciar Sesión</h2>

                <!-- Mostrar errores de validación -->
                @if ($errors->any())
                    <div class="error-messages">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Formulario de inicio de sesión -->
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <!-- Email -->
                    <label class="login-label" for="email">Email:</label>
                    <input class="login-input" type="email" name="email" required>

                    <!-- Contraseña -->
                    <label class="login-label" for="password">Contraseña:</label>
                    <input class="login-input" type="password" name="password" required>

                    <!-- Botón de enviar -->
                    <button class="login-button" type="submit">Ingresar</button>
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