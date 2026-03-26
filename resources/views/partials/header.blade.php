{{-- resources/views/partials/header.blade.php --}}
<header class="header">
    <div class="container">
        <div class="header-content">
            <a href="{{ route('home') }}" class="logo">
                M<span>Tec</span>
            </a>
            
            <button class="mobile-menu-btn" aria-label="Menu">
                ☰
            </button>
            
            <nav class="nav">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Home
                </a>
                <a href="{{ route('posts.index') }}" class="nav-link {{ request()->routeIs('posts.*') ? 'active' : '' }}">
                    Posts
                </a>
                <a href="{{ route('categories.index') }}" class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    Categorias
                </a>
                <a href="{{ route('authors.index') }}" class="nav-link {{ request()->routeIs('authors.*') ? 'active' : '' }}">
                    Autores
                </a>
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                    Sobre
                </a>
                
                <form action="{{ route('search') }}" method="GET" class="search-form" onsubmit="return validateSearch(this)">
                    <input type="text" name="q" class="search-input" placeholder="Buscar..." value="{{ request('q') }}">
                    <button type="submit" class="search-btn">Buscar</button>
                </form>
                
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Painel</a>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer;">Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Entrar</a>
                @endauth
            </nav>
        </div>
    </div>
</header>