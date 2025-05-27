<?php

namespace Arealtime\Post\App\Services;

use Arealtime\Post\App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

trait PostLikeAction
{
    /**
     * Toggle the like status for a given post by the current user.
     * If already liked, it will be unliked. Otherwise, it will be liked.
     *
     * @param int $id Post ID
     * @return Post Updated Post instance with refreshed data
     *
     * @throws Throwable If any database operation fails
     */
    public function toggleLike(): Post
    {
        $this->checkPostSet();

        DB::beginTransaction();

        try {
            if ($this->post->is_liked_by_current_user) {
                $this->unlike();
            } else {
                $this->like();
            }

            DB::commit();
        } catch (Throwable $throwable) {
            DB::rollBack();
            throw $throwable;
        }

        return $this->post->refresh();
    }

    /**
     * Like the currently set post for the authenticated user.
     *
     * @return Post Updated Post instance
     */
    private function like(): Post
    {
        $this->post->increment('like_count');

        $this->post->postLikes()->create([
            'user_id' => Auth::id(),
        ]);

        return $this->post;
    }

    /**
     * Unlike the currently set post for the authenticated user.
     *
     * @return Post Updated Post instance
     */
    private function unlike(): Post
    {
        $this->post->decrement('like_count');

        $this->post->postLikes()
            ->where('user_id', Auth::id())
            ->delete();

        return $this->post;
    }
}
