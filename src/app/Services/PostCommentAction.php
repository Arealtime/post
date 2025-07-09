<?php

namespace Arealtime\Post\App\Services;

use Arealtime\Post\App\Models\PostComment;
use Illuminate\Database\Eloquent\Collection;

trait PostCommentAction
{

    /**
     * @return Collection<PostComment>
     */
    public function allComments(): Collection
    {
        $this->checkPostSet();

        return $this->post->comments()->get();
    }

    /**
     * @return PostComment
     */
    public function createComment(): PostComment
    {
        $this->checkPostSet();

        return $this->post->comments()->create([
            'content' => $this->data['content']
        ]);
    }

    /**
     * @return int Number of deleted comments (0 or 1)
     */
    public function deleteComment(): int
    {
        $this->checkPostSet();

        $comment =  $this->post->comments()->where('id', $this->data['comment_id'])->firstOrFail();
        return $comment->delete();
    }
}
