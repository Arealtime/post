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
     * @return Post
     *
     * @throws ModelNotFoundException
     */
    public function togglePin(): Post
    {
        $this->checkPostSet();

        $this->post->is_pinned = !$this->post->is_pinned;
        $this->post->save();

        return $this->post;
    }
}
