<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>asakura shop – Лабораторная №3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Скомпилированные стили (Bootstrap + твой SCSS) --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
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

        <div class="header__info">
            {{-- Кнопка "Добавить фигурку" --}}
            <a href="{{ route('figures.create') }}"
               class="header__download-btn header__download-btn--small header__download-btn--gap-right">
                Добавить фигурку
            </a>

            {{-- Кнопка "Загрузить" (показывает toast) --}}
            <a href="#"
               id="downloadBtn"
               class="header__download-btn header__download-btn--small">
                Загрузить
            </a>
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

{{-- Toast-контейнер (правый верхний угол) --}}
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1080;">

    {{-- Toast для кнопки "Загрузить" --}}
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

    {{-- Toast для успеха CRUD (добавление/редактирование/удаление) --}}
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

{{-- Скомпилированный JS (Bootstrap + твой app.js) --}}
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
