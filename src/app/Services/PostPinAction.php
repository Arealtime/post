<?php

namespace Arealtime\Post\App\Services;

use Arealtime\Post\App\Models\Post;

trait PostPinAction
{

    /**
     * Get all pinned posts for the currently authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection The collection of pinned posts
     */
    public function allPinned()
    {
        return Post::currentUser()->pinned()->get();
    }
    /**
     * Toggle the is_pinned status of a post.
     *
     * @throws ModelNotFoundException
     */
    public function togglePin(Post $post): Post
    {
        $post->is_pinned = !$post->is_pinned;
        $post->save();

        return $post;
    }
}
