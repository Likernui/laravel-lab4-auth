<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FigureController;

// Главная (оставь свою, если она другая)
Route::get('/', function () {
    return view('welcome');
});

// Маршрут /dashboard (после логина ведём на список фигурок)
Route::middleware(['auth'])->get('/dashboard', function () {
    return redirect()->route('figures.index');
})->name('dashboard');

// Маршруты фигурок (ТОЛЬКО для авторизованных)
Route::middleware(['auth'])->group(function () {
    Route::resource('figures', FigureController::class);
});

// Маршруты Breeze (login/register/logout и т.д.)
require __DIR__.'/auth.php';
