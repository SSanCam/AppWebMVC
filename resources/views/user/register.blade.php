<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/app.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/register.css?v=' . time()) }}">
</head>

<body>
    <!-- Incluir el Header -->
    @include('partials.header')

    <!-- Formulario de registro -->
    <main>
        <div class="register-wrapper">
            <div class="register-container">
                <h2 class="register-title">Registro de Usuario</h2>

                <!-- Mostrar errores de validación -->
                @if ($errors->any())
                    <div class="error-messages">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <label class="register-label" for="name">Nombre:</label>
                    <input class="register-input" type="text" name="name" value="{{ old('name') }}" required>

                    <label class="register-label" for="email">Email:</label>
                    <input class="register-input" type="email" name="email" value="{{ old('email') }}" required>

                    <label class="register-label" for="password">Contraseña:</label>
                    <input class="register-input" type="password" name="password" required>

                    <label class="register-label" for="password_confirmation">Confirmar Contraseña:</label>
                    <input class="register-input" type="password" name="password_confirmation" required>

                    <button class="register-button" type="submit">Registrarse</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Incluir el Footer -->
    @include('partials.footer')
</body>

</html>
