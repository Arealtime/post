<?php

use Arealtime\Post\App\Http\Controllers\PostArchiveController;
use Arealtime\Post\App\Http\Controllers\PostCommentController;
use Arealtime\Post\App\Http\Controllers\PostController;
use Arealtime\Post\App\Http\Controllers\PostLikeController;
use Arealtime\Post\App\Http\Controllers\PostPinController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/arealtime/posts')
    ->name('arealtime.posts.')
    ->group(function () {
        Route::controller(PostController::class)->group(function () {
            Route::get('', 'index');
            Route::post('', 'store');
            Route::put('{id}', 'update');
            Route::delete('{id}', 'destroy');
        });

        Route::controller(PostPinController::class)
            ->name('pin.')
            ->prefix('pin')
            ->group(function () {
                Route::get('{id}', 'pinned');
                Route::post('{id}/toggle', 'togglePin');
            });

        Route::controller(PostArchiveController::class)
            ->name('archive.')
            ->prefix('archive')
            ->group(function () {
                Route::get('{id}', 'archived');
                Route::post('{id}/toggle', 'toggleArchive');
            });

        Route::controller(PostLikeController::class)
            ->name('like.')
            ->prefix('like')
            ->group(function () {
                Route::get('{id}', 'index');
                Route::post('{id}/toggle', 'toggleLike');
            });

        Route::controller(PostCommentController::class)
            ->name('comments.')
            ->prefix('comments')
            ->group(function () {
                Route::get('{id}', 'index');
                Route::post('{id}', 'store');
                Route::delete('{id}', 'destroy');
            });
    });
