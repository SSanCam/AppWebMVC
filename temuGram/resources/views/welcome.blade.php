<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>temuGram - Bienvenido</title>

    <!-- Estilos -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen text-center">

    <!-- Header -->
    <header class="w-full p-4 bg-white shadow-md flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">temuGram</h1>
        <nav>
            <a href="{{ route('register.show') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Registrarse</a>
            <a href="{{ route('login.show') }}" class="px-4 py-2 bg-gray-700 text-white rounded ml-2">Iniciar Sesión</a>
        </nav>
    </header>

    <!-- Contenido Principal -->
    <main class="mt-12">
        <h2 class="text-3xl font-semibold text-gray-800">Bienvenido a temuGram</h2>
        <p class="text-gray-600 mt-2">La mejor plataforma educativa para compartir imágenes y comentarios.</p>
    </main>

</body>
</html>
