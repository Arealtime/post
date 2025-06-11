<?php

namespace Arealtime\Post\App\Providers;

use Arealtime\Post\App\Console\Commands\PostCommand;
use Arealtime\Post\App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
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
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');

        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'post');
    }
}
