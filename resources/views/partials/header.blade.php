<header class="header">
    <!-- Logo de la cámara -->

    <a href="{{ url('/') }}" class="header__logo">
        <img src="{{ asset('img/icono.png') }}" alt="Inicio" class="header__icon">
    </a>

    <!-- Título -->
    <h1>TemuGram</h1>

    <!-- Navegación -->
    <nav class="header__nav">
        @auth
            <!-- Nuevo post -->
            <a href="{{ url('/posts/create') }}" class="nav__button">Nuevo Post</a>

            <!-- Cerrar sesión -->
            <a href="#" class="nav__button"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <!-- Eliminar cuenta -->
            <a href="{{ route('user.confirmDelete') }}" class="nav__button">Eliminar Cuenta</a>

            <!-- Imagen de perfil -->
            <!-- Imagen de perfil -->
            <a class="header__logo" href="{{ route('post.index') }}">
                <img class="header__icon"
                    src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('img/default.avif') }}"
                    alt="Imagen de perfil">
            </a>

        @else
            <a href="{{ url('/login') }}" class="nav__button">Iniciar Sesión</a>
            <a href="{{ url('/register') }}" class="nav__button">Registrarse</a>
        @endauth
    </nav>
</header>