<?php

namespace Arealtime\Post\App\Observers;

use Arealtime\Post\App\Models\PostComment;

class PostCommentObserver
{
    public function creating(PostComment $postComment)
    {
        $postComment->user_id = auth()->id() ?? 1;
    }
}
