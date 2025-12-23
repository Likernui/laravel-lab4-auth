<?php

namespace App\Http\Controllers;

use App\Models\Figure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FigureController extends Controller
{
    /**
     * Контроллер для работы с фигурками.
     *
     * Здесь реализованы:
     * - вывод списка фигурок;
     * - создание новой фигурки;
     * - редактирование существующей;
     * - удаление;
     * - просмотр деталей.
     */

    public function index()
    {
        /**
         * Показать список фигурок текущего пользователя.
         */

        $figures = Figure::where('user_id', auth()->id())
            ->orderBy('id')
            ->get();

        return view('figures.index', compact('figures'));
    }

    public function create()
    {
        return view('figures.create');
    }

    public function store(Request $request)
    {
        /**
         * Сохранить новую фигурку в базу данных.
         *
         * Здесь выполняется валидация формы и загрузка изображения.
         */

        // Картинка ОБЯЗАТЕЛЬНА
        $validated = $request->validate(
            [
                'name'              => 'required|string|max:255',
                'type'              => 'required|string|max:255',
                'height_cm'         => 'nullable|numeric|min:1|max:200',
                'material'          => 'nullable|string|max:255',
                'short_description' => 'required|string|max:500',
                'full_description'  => 'nullable|string|max:2000',
                'release_date'      => 'nullable|date',
                'image'             => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            ],
            [
                'name.required'              => 'Это поле обязательно для заполнения.',
                'type.required'              => 'Это поле обязательно для заполнения.',
                'short_description.required' => 'Это поле обязательно для заполнения.',
                'image.required'             => 'Необходимо загрузить изображение.',
                'image.image'                => 'Файл должен быть изображением.',
                'image.mimes'                => 'Допустимые форматы: jpg, jpeg, png, webp.',
                'image.max'                  => 'Размер файла не должен превышать 4 МБ.',
            ]
        );

        // загрузка картинки
        $path = $request->file('image')->store('figures', 'public');

        $figure = new Figure();
        $figure->fill($validated);

        // сохраняем путь в то же поле, что используется дальше в контроллере
        $figure->image = $path;

        // ✅ привязка фигурки к текущему пользователю
        $figure->user_id = auth()->id();

        $figure->save();

        return redirect()
            ->route('figures.index')
            ->with('success', 'Фигурка успешно добавлена!');
    }

    public function edit(Figure $figure)
    {
        /**
         * Показать форму редактирования существующей фигурки.
         */

        return view('figures.edit', compact('figure'));
    }

    public function update(Request $request, Figure $figure)
    {
        /**
         * Обновить данные фигурки в базе.
         *
         * При необходимости можно заменить изображение:
         * старое удаляется из storage, новое сохраняется.
         */

        $validated = $request->validate(
            [
                'name'              => 'required|string|max:255',
                'type'              => 'required|string|max:255',
                'height_cm'         => 'nullable|numeric|min:1|max:200',
                'material'          => 'nullable|string|max:255',
                'short_description' => 'required|string|max:500',
                'full_description'  => 'nullable|string|max:2000',
                'release_date'      => 'nullable|date',
                'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            ],
            [
                'name.required'              => 'Это поле обязательно для заполнения.',
                'type.required'              => 'Это поле обязательно для заполнения.',
                'short_description.required' => 'Это поле обязательно для заполнения.',
                'image.image'                => 'Файл должен быть изображением.',
                'image.mimes'                => 'Допустимые форматы: jpg, jpeg, png, webp.',
                'image.max'                  => 'Размер файла не должен превышать 4 МБ.',
            ]
        );

        $figure->fill($validated);

        // если загрузили новую картинку
        if ($request->hasFile('image')) {
            if ($figure->image) {
                Storage::disk('public')->delete($figure->image);
            }

            $path = $request->file('image')->store('figures', 'public');
            $figure->image = $path;
        }

        $figure->save();

        return redirect()
            ->route('figures.index')
            ->with('success', 'Фигурка успешно обновлена!');
    }

    public function destroy(Figure $figure)
    {
        /**
         * Удалить фигурку и её изображение (если оно было загружено).
         */

        if ($figure->image) {
            Storage::disk('public')->delete($figure->image);
        }

        $figure->delete();

        return redirect()
            ->route('figures.index')
            ->with('success', 'Фигурка удалена.');
    }
}
