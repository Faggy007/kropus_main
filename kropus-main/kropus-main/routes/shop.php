<?php

use Illuminate\Support\Facades\Route;
use Modules\Shop\Http\Controllers\ShopController;

Route::get('/catalog/{slug1}/{slug2?}', [ShopController::class, 'resolve']);
