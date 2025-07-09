<?php

namespace Arealtime\Post\App\Providers;

use Arealtime\Post\App\Models\Post;
use Arealtime\Post\App\Models\PostComment;
use Arealtime\Post\App\Observers\PostCommentObserver;
use Arealtime\Post\App\Observers\PostObserver;
use Illuminate\Support\ServiceProvider;

class PostObserverServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Post::observe(PostObserver::class);
        PostComment::observe(PostCommentObserver::class);
    }
}
