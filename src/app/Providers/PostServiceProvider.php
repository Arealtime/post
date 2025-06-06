<?php

namespace Arealtime\Post\App\Providers;

use Arealtime\Post\App\Console\Commands\PostCommand;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([PostCommand::class]);

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
