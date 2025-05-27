<?php

use Arealtime\Post\App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/arealtime/posts')
    ->name('arealtime.posts')
    ->controller(PostController::class)
    ->group(function () {
        Route::get('', 'index');
        Route::post('', 'store');
        Route::put('{id}', 'update');
        Route::delete('{id}', 'destroy');
    });
