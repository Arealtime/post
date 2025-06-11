<?php

namespace Arealtime\Post\App\Services;

use Arealtime\Post\App\Models\Post;
use Illuminate\Support\Facades\Auth;

trait PostPublishAction
{

    /**
     * Get all published posts for the currently authenticated user.
     *
     * A published post is one whose 'posted_at' date/time is in the past or now.
     *
     * @return \Illuminate\Database\Eloquent\Collection The collection of published posts
     */
    public function allPublished()
    {
        return Post::currentUser()->published()->get();
    }

    /**
     * Get all unpublished posts for the currently authenticated user.
     *
     * An unpublished post is one whose 'posted_at' date/time is in the future.
     *
     * @return \Illuminate\Database\Eloquent\Collection The collection of unpublished posts
     */
    public function allUnPublished()
    {
        return Post::currentUser()->unPublished()->get();
    }
}
