<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>asakura shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<header class="header">
    <div class="container header__border">
        <div class="header__info">
            <img src="{{ asset('images/logo.png') }}" alt="asakura shop" class="header__logo">
            <div>
                <div>asakura shop</div>
                <div style="font-size:14px;color:#777;">Магазин аниме-фигурок</div>
            </div>
        </div>

        <div class="header__info" style="gap: 10px;">
            <a href="{{ route('figures.create') }}"
               class="header__download-btn header__download-btn--small header__download-btn--gap-right">
                Добавить фигурку
            </a>

            <a href="#"
               id="downloadBtn"
               class="header__download-btn header__download-btn--small">
                Загрузить
            </a>

            {{-- Auth-блок --}}
            @auth
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="header__download-btn header__download-btn--small">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="header__download-btn header__download-btn--small">
                    Login
                </a>
                <a href="{{ route('register') }}" class="header__download-btn header__download-btn--small">
                    Register
                </a>
            @endauth
        </div>
    </div>
</header>

<main class="main">
    <div class="container main__border">
        @yield('content')
    </div>
</main>

<footer class="footer">
    <div class="container footer__info">
        <div>Ардашов Тимофей</div>

        <div class="footer__icons">
            <a href="#" aria-label="Facebook">
                <img src="{{ asset('images/icons8-facebook-50.png') }}" alt="Facebook">
            </a>
            <a href="#" aria-label="Instagram">
                <img src="{{ asset('images/icons8-instagram-50.png') }}" alt="Instagram">
            </a>
            <a href="#" aria-label="Twitter">
                <img src="{{ asset('images/icons8-twitter-50.png') }}" alt="Twitter">
            </a>
        </div>
    </div>
</footer>

{{-- Toast-контейнер --}}
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1080;">

    <div id="downloadToast"
         class="toast text-bg-primary border-0 mb-2"
         role="alert"
         aria-live="assertive"
         aria-atomic="true">
        <div class="d-flex align-items-center">
            <div class="spinner-border spinner-border-sm text-light me-2" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div class="toast-body">
                Загрузка файла пока не реализована в этой лабораторной 😊
            </div>
            <button type="button"
                    class="btn-close btn-close-white ms-2"
                    data-bs-dismiss="toast"
                    aria-label="Закрыть"></button>
        </div>
    </div>

    @if (session('success'))
        <div id="successToast"
             class="toast text-bg-success border-0"
             role="alert"
             aria-live="assertive"
             aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"
                        aria-label="Close"></button>
            </div>
        </div>
    @endif
</div>

<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
