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
    public function allComments(): Collection
    {
        $this->checkPostSet();

        return $this->post->comments()->get();
    }

    /**
     * Create a new comment for the current post by the authenticated user.
     *
     * @param array{content: string} $data Comment data, must include 'content'
     * @return PostComment Newly created PostComment model
     */
    public function createComment(array $data): PostComment
    {
        $this->checkPostSet();

        return $this->post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $data['content'],
        ]);
    }

    /**
     * Delete a specific comment made by the currently authenticated user for the current post.
     *
     * @param int $commentId The ID of the comment to delete
     * @return int Number of deleted comments (0 or 1)
     *
     * @throws Throwable If a database error occurs during deletion
     */
    public function deleteComment(int $commentId): int
    {
        $this->checkPostSet();

        return $this->post->comments()->where('id', $commentId)->delete();
    }
}
