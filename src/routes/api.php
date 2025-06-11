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
            Route::put('{post}', 'update');
            Route::delete('{post}', 'destroy');
        });

        Route::controller(PostPinController::class)
            ->name('pin.')
            ->prefix('pin')
            ->group(function () {
                Route::get('{post}', 'pinned');
                Route::post('{post}/toggle', 'togglePin');
            });

        Route::controller(PostArchiveController::class)
            ->name('archive.')
            ->group(function () {
                Route::get('archived', 'archived');
                Route::post('{post}/archive', 'toggleArchive');
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
