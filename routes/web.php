<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\SearchController::class, 'index'])->name('home');
Route::post('/', [App\Http\Controllers\SearchController::class, 'search']);
