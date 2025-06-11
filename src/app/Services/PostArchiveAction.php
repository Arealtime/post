<?php

namespace Arealtime\Post\App\Services;

use Arealtime\Post\App\Models\Post;
use Illuminate\Support\Facades\Auth;

trait PostArchiveAction
{

    /**
     * Get all archived posts for the currently authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection The collection of archived posts
     */
    public function allArchived()
    {
        return Post::currentUser()->archived()->get();
    }

    /**
     * Toggle the is_archived status of a post.
     *
     * @param int $id
     * @return Post
     *
     * @throws ModelNotFoundException
     */
    public function toggleArchive(Post $post): Post
    {
        $post->is_pinned = !$post->is_pinned;
        $post->save();

        return $post;
    }
}
