<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;

Route::get('/', [BlogController::class, 'page'])->name('home');
Route::get('/{slug1?}/{slug2?}', [BlogController::class, 'resolve']);
