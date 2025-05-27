<?php

namespace Arealtime\Post\App\Services;

use Arealtime\Post\App\Models\PostComment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Throwable;

trait PostCommentAction
{
    /**
     * Get all comments for the current post.
     *
     * @return Collection<int, PostComment> Collection of PostComment models
     */
    public function all(): Collection
    {
        $this->checkPostSet();

        return $this->post->postComments()->get();
    }

    /**
     * Create a new comment for the current post by the authenticated user.
     *
     * @param array{content: string} $data Comment data, must include 'content'
     * @return PostComment Newly created PostComment model
     */
    public function create(array $data): PostComment
    {
        $this->checkPostSet();

        return $this->post->postComments()->create([
            'user_id' => Auth::id(),
            'content' => $data['content'],
        ]);
    }

    /**
     * Delete all comments made by the current authenticated user for the current post.
     *
     * @return int Number of deleted comments
     *
     * @throws Throwable If a database error occurs
     */
    public function delete(): int
    {
        $this->checkPostSet();

        return $this->post->postComments()->where('user_id', Auth::id())->delete();
    }
}
