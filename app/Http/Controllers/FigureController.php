<?php

namespace App\Http\Controllers;

use App\Models\Figure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FigureController extends Controller
{
    public function index()
    {
        $figures = Figure::orderBy('id')->get();

        return view('figures.index', compact('figures'));
    }

    public function create()
    {
        return view('figures.create');
    }

    public function store(Request $request)
    {
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
                'image.required'            => 'Необходимо загрузить изображение.',
                'image.image'               => 'Файл должен быть изображением.',
                'image.mimes'               => 'Допустимые форматы: jpg, jpeg, png, webp.',
                'image.max'                 => 'Размер файла не должен превышать 4 МБ.',
            ]
        );

        // загрузка картинки
        $path = $request->file('image')->store('figures', 'public');

        $figure = new Figure();
        $figure->fill($validated);
        $figure->image = $path;
        $figure->save();

        return redirect()
            ->route('figures.index')
            ->with('success', 'Фигурка успешно добавлена!');
    }

    public function edit(Figure $figure)
    {
        return view('figures.edit', compact('figure'));
    }

    public function update(Request $request, Figure $figure)
    {
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
        if ($figure->image) {
            Storage::disk('public')->delete($figure->image);
        }

        $figure->delete();

        return redirect()
            ->route('figures.index')
            ->with('success', 'Фигурка удалена.');
    }
}
