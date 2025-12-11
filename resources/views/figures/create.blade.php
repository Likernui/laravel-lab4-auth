@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Добавить фигурку</h1>

    <form action="{{ route('figures.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="mb-4">
        @csrf

        {{-- Название --}}
        <div class="mb-3">
            <label class="form-label">Название *</label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
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
                   value="{{ old('type') }}"
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
                   value="{{ old('height_cm') }}"
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
                   value="{{ old('material') }}"
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
                      class="form-control @error('short_description') is-invalid @enderror">{{ old('short_description') }}</textarea>
            @error('short_description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Полное описание --}}
        <div class="mb-3">
            <label class="form-label">Полное описание</label>
            <textarea name="full_description"
                      rows="4"
                      class="form-control @error('full_description') is-invalid @enderror">{{ old('full_description') }}</textarea>
            @error('full_description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Дата выхода --}}
        <div class="mb-3">
            <label class="form-label">Дата выхода</label>
            <input type="date"
                   name="release_date"
                   value="{{ old('release_date') }}"
                   class="form-control @error('release_date') is-invalid @enderror">
            @error('release_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Изображение (обязательно) --}}
        <div class="mb-3">
            <label class="form-label">Изображение *</label>
            <input type="file"
                   name="image"
                   class="form-control @error('image') is-invalid @enderror"
                   accept="image/*"
                   required>
            <div class="form-text">
                Допустимые форматы: jpg, jpeg, png, webp. Максимум 4 МБ.
            </div>
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="{{ route('figures.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
@endsection
