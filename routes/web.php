<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FigureController;

Route::get('/', function () {
    return redirect()->route('figures.index');
});

Route::resource('figures', FigureController::class);
