<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NewsController::class, 'home'])->name('home');
Route::get('/bao-cao', [NewsController::class, 'report'])->name('report');
Route::resource('tin-tuc', NewsController::class)->parameters([
    'tin-tuc' => 'tin_tuc',
]);
