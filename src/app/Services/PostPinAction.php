<?php

namespace Arealtime\Post\App\Services;

use Arealtime\Post\App\Models\Post;
use Illuminate\Container\Attributes\Auth;

trait PostPinAction
{

    /**
     * Get all pinned posts for the currently authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection The collection of pinned posts
     */
    public function allPinned()
    {
        return Post::where('user_id', Auth::id())->pinned()->get();
    }
    /**
     * Toggle the is_pinned status of a post.
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
