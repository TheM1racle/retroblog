<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Personal Retro Blog')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <script>
        if (localStorage.getItem('theme') === 'light') {
            document.body.classList.add('light-theme');
        }
    </script>

    <div class="container">
        @if(file_exists(public_path('banner.png')))
            <img src="{{ asset('banner.png') }}" alt="Banner" class="banner">
        @else
            <pre class="ascii-banner">
  ____  _____ _____ ____   ___    ____  _     ___   ____

 |  _ \| ____|_   _|  _ \ / _ \  | __ )| |   / _ \ / ___|
 | |_) |  _|   | | | |_) | | | | |  _ \| |  | | | | |  _
 |  _ <| |___  | | |  _ <| |_| | | |_) | |__| |_| | |_| |
 |_| \_\_____| |_| |_| \_\\___/  |____/|_____\___/ \____|
            </pre>
        @endif

        <nav class="navbar">
            <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') ? 'active' : '' }}">Blog</a>
            <a href="{{ route('progress') }}" class="{{ request()->routeIs('progress') ? 'active' : '' }}">Progress-Reports</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <button type="button" class="theme-btn" id="themeToggle" title="Сменить тему">🌗</button>
        </nav>

        @auth
            <div class="admin-bar">
                <span>Админ: <strong>{{ auth()->user()->name }}</strong></span>
                <a href="{{ route('posts.create') }}" class="btn" style="padding: 4px 10px; font-size: 12px;">+ Новый пост</a>
                <form action="{{ route('logout') }}" method="POST" style="margin-left: auto;">
                    @csrf
                    <button type="submit" class="btn btn-outline" style="padding: 4px 10px; font-size: 12px;">Выйти</button>
                </form>
            </div>
        @endauth

        @yield('content')

        <footer class="footer">
            <span>© {{ date('Y') }} Personal Log</span>
            @guest
                <a href="{{ route('login') }}">Admin Login</a>
            @endguest
        </footer>
    </div>

    <script>
        document.getElementById('themeToggle').addEventListener('click', function () {
            document.body.classList.toggle('light-theme');
            const isLight = document.body.classList.contains('light-theme');
            localStorage.setItem('theme', isLight ? 'light' : 'dark');
        });
    </script>
</body>
</html>
