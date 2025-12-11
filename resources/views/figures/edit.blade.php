@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Редактировать фигурку</h1>

    <form action="{{ route('figures.update', $figure) }}"
          method="POST"
          enctype="multipart/form-data"
          class="mb-4">

        @csrf
        @method('PUT')

        {{-- Название --}}
        <div class="mb-3">
            <label class="form-label">Название *</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $figure->name) }}"
                   class="form-control @error('name') is-invalid @enderror">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Тип --}}
        <div class="mb-3">
            <label class="form-label">Тип *</label>
            <input type="text"
                   name="type"
                   value="{{ old('type', $figure->type) }}"
                   class="form-control @error('type') is-invalid @enderror">

            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Высота --}}
        <div class="mb-3">
            <label class="form-label">Высота (см)</label>
            <input type="number"
                   name="height_cm"
                   value="{{ old('height_cm', $figure->height_cm) }}"
                   class="form-control @error('height_cm') is-invalid @enderror">

            @error('height_cm')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Материал --}}
        <div class="mb-3">
            <label class="form-label">Материал</label>
            <input type="text"
                   name="material"
                   value="{{ old('material', $figure->material) }}"
                   class="form-control @error('material') is-invalid @enderror">

            @error('material')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Краткое описание --}}
        <div class="mb-3">
            <label class="form-label">Краткое описание *</label>
            <textarea name="short_description"
                      rows="2"
                      class="form-control @error('short_description') is-invalid @enderror">{{ old('short_description', $figure->short_description) }}</textarea>

            @error('short_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Полное описание --}}
        <div class="mb-3">
            <label class="form-label">Полное описание</label>
            <textarea name="full_description"
                      rows="4"
                      class="form-control @error('full_description') is-invalid @enderror">{{ old('full_description', $figure->full_description) }}</textarea>

            @error('full_description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Дата выхода --}}
        <div class="mb-3">
            <label class="form-label">Дата выхода</label>
            <input type="date"
                   name="release_date"
                   value="{{ old('release_date', $figure->release_date) }}"
                   class="form-control @error('release_date') is-invalid @enderror">

            @error('release_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Текущее изображение --}}
        <div class="mb-3">
            <label class="form-label d-block">Текущее изображение</label>

            @php
                $currentImage = $figure->image
                    ? asset('storage/' . $figure->image)
                    : asset('images/default.png');
            @endphp

            <img src="{{ $currentImage }}"
                 alt="{{ $figure->name }}"
                 class="img-fluid mb-2"
                 style="max-height: 200px; object-fit: cover;">
        </div>

        {{-- Новое изображение --}}
        <div class="mb-3">
            <label class="form-label">Заменить изображение</label>
            <input type="file"
                   name="image"
                   class="form-control @error('image') is-invalid @enderror"
                   accept="image/*">

            <div class="form-text">
                Оставьте пустым, если не хотите менять картинку.
            </div>

            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="{{ route('figures.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection
