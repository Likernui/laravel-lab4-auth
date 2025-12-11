@extends('layouts.app')

@section('content')
    <h1 class="main__title mb-4">Ассортимент товаров "asakura shop"</h1>

    @if($figures->isEmpty())
        <p>Пока нет ни одной фигурки. Добавьте первую 😊</p>
    @else
        <div class="main__cards">
            <div class="row g-4">
                @foreach($figures as $figure)
                    @php
                        $imageUrl = $figure->image
                            ? asset('storage/' . $figure->image)
                            : asset('images/placeholder.png');

                        $colorIndex = ($loop->iteration % 5) + 1;
                    @endphp

                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="main__card card h-100 position-relative"
                             data-card-color="{{ $colorIndex }}">

                            {{-- КАРТИНКА --}}
                            <img src="{{ $imageUrl }}"
                                 alt="{{ $figure->name }}"
                                 class="card-img-top">

                            {{-- ТИП ФИГУРКИ + ПОДСКАЗКА --}}
                            @if($figure->type)
                                <span class="main__card-type">
                                    {{ $figure->type }}

                                    <span class="main__card-type-tooltip">
                                        Тип фигурки: {{ $figure->type }}
                                    </span>
                                </span>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h2 class="card-title">{{ $figure->name }}</h2>

                                <p class="card-text flex-grow-1">
                                    {{ $figure->short_description ?: 'Описание пока не добавлено.' }}
                                </p>

                                {{-- КНОПКА "ПОДРОБНЕЕ" --}}
                                <button
                                    type="button"
                                    class="btn btn-outline-primary mt-auto js-figure-details"
                                    data-bs-toggle="modal"
                                    data-bs-target="#figureModal"

                                    data-figure-name="{{ $figure->name }}"
                                    data-figure-image="{{ $imageUrl }}"
                                    data-figure-type="{{ $figure->type ?? '' }}"
                                    data-figure-height="{{ $figure->height_cm ?? '' }}"
                                    data-figure-material="{{ $figure->material ?? '' }}"
                                    data-figure-release="{{ $figure->release_date ?? '' }}"
                                    data-figure-description="{{ $figure->full_description ?? $figure->short_description ?? '' }}"
                                >
                                    Подробнее
                                </button>

                                <div class="mt-3 d-flex justify-content-between gap-2">
                                    <a href="{{ route('figures.edit', $figure) }}"
                                       class="btn btn-outline-secondary btn-sm">
                                        Редактировать
                                    </a>

                                    {{-- КНОПКА "УДАЛИТЬ" --}}
                                    <button
                                        type="button"
                                        class="btn btn-outline-danger btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-route="{{ route('figures.destroy', $figure) }}"
                                    >
                                        Удалить
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


    {{-- ===================== МОДАЛКА "ПОДРОБНЕЕ" ===================== --}}
    <div class="modal fade" id="figureModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title js-figure-title">Детали фигурки</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Закрыть"></button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-5 mb-3 text-center">
                            <img src="" alt=""
                                 class="img-fluid js-figure-image"
                                 style="max-height: 320px; object-fit: cover;">
                        </div>

                        <div class="col-md-7">
                            <p class="js-figure-description mb-3"></p>

                            <ul class="list-unstyled mb-0">
                                <li class="js-figure-type"></li>
                                <li class="js-figure-height"></li>
                                <li class="js-figure-material"></li>
                                <li class="js-figure-release"></li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button"
                            class="btn btn-outline-secondary js-figure-prev">
                        ← Предыдущая
                    </button>

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Закрыть
                    </button>

                    <button type="button"
                            class="btn btn-outline-secondary js-figure-next">
                        Следующая →
                    </button>
                </div>
            </div>
        </div>
    </div>


    {{-- ===================== МОДАЛКА УДАЛЕНИЯ ===================== --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Удаление фигурки</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Закрыть"></button>
                </div>

                <div class="modal-body">
                    Вы уверены, что хотите удалить эту фигурку?
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Отмена
                    </button>

                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-danger">
                            Да, удалить
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
