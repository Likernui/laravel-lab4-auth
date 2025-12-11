<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>asakura shop – Laravel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Стили, собранные Laravel Mix --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    {{-- Иконки Font Awesome (по желанию) --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">asakura shop (Laravel + Bootstrap)</h1>

    <button class="btn btn-primary">
        Проверка Bootstrap
    </button>
</div>

{{-- Скрипты, собранные Laravel Mix --}}
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
