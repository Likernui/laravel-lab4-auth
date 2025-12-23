<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Asakura Shop — Auth</title>


    {{-- Подключаем Bootstrap CDN (чтобы было красиво СРАЗУ, даже если Vite/Bootstrap в проекте не собран) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-7 col-lg-5">

                <div class="text-center mb-4">
                    <a href="/" class="text-decoration-none text-dark">
                        <h2 class="mb-0">Asakura Shop</h2>
                    </a>
                    <div class="text-muted">Auth</div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        {{ $slot }}
                    </div>
                </div>

                <div class="text-center mt-3">
                    <a href="/" class="text-decoration-none">← На главную</a>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
