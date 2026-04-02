<?php

use Illuminate\Support\Facades\Route;

Route::middleware('frontend')->group(function () {
    require __DIR__.'/auth.php';
    require __DIR__.'/shop.php';
    require __DIR__.'/blog.php';
    //  require __DIR__.'/account.php';
});
