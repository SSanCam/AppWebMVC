<header class="body__header">
    <div class="header__logo">
        <a href="{{ url('/') }}">temuGram</a>
    </div>
    <nav class="header__nav">
        @auth
            <a href="{{ url('/post/create') }}" class="nav__link">Nuevo Post</a>
            <a href="#" class="nav__link" onclick="document.getElementById('logout-form').submit();">Cerrar Sesión</a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a href="{{ url('/login') }}" class="nav__link">Iniciar Sesión</a>
            <a href="{{ url('/register') }}" class="nav__link">Registrarse</a>
        @endauth
    </nav>
</header>
