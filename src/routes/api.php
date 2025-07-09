<?php

use Arealtime\Post\App\Http\Controllers\PostArchiveController;
use Arealtime\Post\App\Http\Controllers\PostCommentController;
use Arealtime\Post\App\Http\Controllers\PostController;
use Arealtime\Post\App\Http\Controllers\PostLikeController;
use Arealtime\Post\App\Http\Controllers\PostPinController;
use Arealtime\Post\App\Http\Controllers\PostPublishController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->prefix('api/arealtime/posts')
    ->name('arealtime.posts.')
    ->group(function () {
        Route::controller(PostController::class)->group(function () {
            Route::get('', 'index');
            Route::get('{ownedPost}', 'get');
            Route::post('', 'store');
            Route::put('{ownedPost}', 'update');
            Route::delete('{ownedPost}', 'destroy');
        });

        Route::controller(PostPinController::class)
            ->name('pin.')
            ->group(function () {
                Route::get('pinned', 'pinned');
                Route::post('{ownedPost}/pin', 'togglePin');
            });

        Route::controller(PostArchiveController::class)
            ->name('archive.')
            ->group(function () {
                Route::get('archived', 'archived');
                Route::post('{ownedPost}/archive', 'toggleArchive');
            });

        Route::controller(PostPublishController::class)
            ->name('published.')
            ->group(function () {
                Route::get('published', 'published');
                Route::get('unpublished', 'unpublished');
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
            ->prefix('{post}/comments')
            ->group(function () {
                Route::get('', 'index');
                Route::post('', 'store');
                Route::delete('{id}', 'destroy');
            });
    });
