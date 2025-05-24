<?php

namespace Arealtime\Post\App\Providers;

use Arealtime\Post\App\Console\Commands\Post;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([Post::class]);

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/arealtime-post.php',
            'arealtime-post'
        );
    }

    public function boot()
    {
        // Bootstrapping
    }
}
