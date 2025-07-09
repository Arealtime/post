<?php

namespace Arealtime\Post\App\Providers;

use Arealtime\Post\App\Models\Post;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class PostRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::bind('ownedPost', function ($id) {
            return Post::where('id', $id)->currentUser()->firstOrFail();
        });

        Route::bind('post', function ($id) {
            return Post::where('id', $id)->firstOrFail();
        });
    }
}
