<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TemuGram</title>
    <link rel="stylesheet" href="{{ asset('css/app.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css?v=' . time()) }}">

</head>

<body>
    <!-- Header -->
    <header>
        @include('partials.header')
    </header>

    <!-- Main -->
    <main>


        @auth
            <h1>Bienvenido a TemuGram , {{ auth()->user()->name }}!</h1>
        @else
            <h2>Bienvenido a Temugram!</h2>
        @endauth

    </main>

    <!-- Footer -->
    <footer>
        @include('partials.footer')
    </footer>

</body>

</html>