<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Figure;

class FigureSeeder extends Seeder
{
    /**
     * Заполнить таблицу figures тестовыми данными.
     */
    public function run(): void
    {
        // На всякий случай очистим таблицу (мягко удалённые тоже)
        Figure::truncate();

        Figure::create([
            'name' => 'Исаги Йоичи',
            'type' => 'Эксклюзив',
            'height_cm' => 18,
            'material' => 'PVC',
            'short_description' => 'Фигурка нападающего из Blue Lock.',
            'full_description' => 'Детализированная фигурка Исаги Йоичи в форме из Blue Lock.',
            'release_date' => '01.02.2024',
        ]);

        Figure::create([
            'name' => 'Бачио Ренсукэ',
            'type' => 'Лимитированное издание',
            'height_cm' => 20,
            'material' => 'PVC',
            'short_description' => 'Фигурка форварда с диким стилем игры.',
            'full_description' => 'Фигурка Бачио с мячом, отличная детализация волос и формы.',
            'release_date' => '15.03.2024',
        ]);

        Figure::create([
            'name' => 'Чигири Хёма',
            'type' => 'Стандартное издание',
            'height_cm' => 19,
            'material' => 'PVC',
            'short_description' => 'Фигурка быстрейшего игрока Blue Lock.',
            'full_description' => 'Чигири в динамичной позе бега, с развивающимися волосами.',
            'release_date' => '10.04.2024',
        ]);

        Figure::create([
            'name' => 'Куон Ватару',
            'type' => 'Коллекционное издание',
            'height_cm' => 17,
            'material' => 'PVC',
            'short_description' => 'Фигурка полузащитника из Blue Lock.',
            'full_description' => 'Фигурка Куона в спокойной позе, подходит для коллекции команды.',
            'release_date' => '05.05.2024',
        ]);

        Figure::create([
            'name' => 'Баро Сёэй',
            'type' => 'Эксклюзив',
            'height_cm' => 21,
            'material' => 'PVC',
            'short_description' => 'Фигурка «короля поля» Баро.',
            'full_description' => 'Баро в агрессивной позе, подчёркивающей его характер.',
            'release_date' => '20.06.2024',
        ]);
    }
}
