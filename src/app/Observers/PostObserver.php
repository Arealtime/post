<?php

namespace Arealtime\Post\App\Observers;

use Arealtime\Post\App\Models\Post;

class PostObserver
{
    public function creating(Post $post)
    {
        $post->user_id = auth()->id();
    }
}
