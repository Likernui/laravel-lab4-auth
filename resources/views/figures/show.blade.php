@extends('layouts.app')

@section('content')
    <h1 class="mb-4">{{ $figure->name }}</h1>

    <div class="row">
        <div class="col-md-5">
            <img
                src="{{ $figure->image ? asset('storage/' . $figure->image) : asset('images/no-image.png') }}"
                alt="{{ $figure->name }}"
                class="img-fluid rounded shadow"
            >
        </div>

        <div class="col-md-7">
            <h4 class="mb-3">{{ $figure->type }}</h4>

            <ul class="list-group mb-4">
                @if($figure->height_cm)
                    <li class="list-group-item">
                        <strong>Высота:</strong> {{ $figure->height_cm }} см
                    </li>
                @endif

                @if($figure->material)
                    <li class="list-group-item">
                        <strong>Материал:</strong> {{ $figure->material }}
                    </li>
                @endif

                @if($figure->release_date)
                    <li class="list-group-item">
                        <strong>Дата выхода:</strong> {{ $figure->release_date }}
                    </li>
                @endif
            </ul>

            <p class="mb-4">{{ $figure->full_description ?? 'Описание отсутствует.' }}</p>

            {{-- Кнопки действий --}}
            <a href="{{ route('figures.edit', $figure) }}" class="btn btn-warning me-2">Редактировать</a>

            <!-- Удаление -->
            <form action="{{ route('figures.destroy', $figure) }}" method="POST" class="d-inline-block"
                  onsubmit="return confirm('Вы уверены, что хотите удалить фигурку?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>

            <a href="{{ route('figures.index') }}" class="btn btn-secondary ms-2">Назад</a>
        </div>
    </div>
@endsection
