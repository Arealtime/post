<?php

namespace Arealtime\Post\App\Services;

use Arealtime\Post\App\Enums\PostTypeEnum;
use Arealtime\Post\App\Models\Post;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Str;
use Throwable;

class PostService
{
    use PostLikeAction, PostCommentAction, PostAttachmentAction;

    private Post $post;

    /**
     * Set the current post instance.
     *
     * @param Post $post
     * @return void
     */
    public function setPost(Post $post): self
    {
        $this->post = $post;
        return $this;
    }

    /**
     * Check if post has been set, throw exception if not.
     *
     * @return void
     * @throws LogicException
     */
    private function checkPostSet(): void
    {
        if (!$this->post) {
            throw new Exception("Post instance is not set. Make sure to call setPost() on the postService object before invoking this method.");
        }
    }
    /**
     * Get all posts.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Post::with('attachments')->latest()->get();
    }

    /**
     * Create a new post.
     *
     * @param array $data
     * @return Post
     */
    public function create(array $data)
    {
        $data['type'] = $this->getType(collect($data['attachments']));

        DB::beginTransaction();
        try {
            $post = Post::create($data);

            $this->setPost($post);

            $this->createAttachment($data['attachments']);
            DB::commit();
            return $this->post;
        } catch (Throwable $throwable) {
            DB::rollBack();
            return $throwable;
        }
    }

    /**
     * Find a post by ID.
     *
     * @param int $id
     * @return Post
     *
     * @throws ModelNotFoundException
     */
    public function find(int $id): Post
    {
        return Post::findOrFail($id);
    }

    /**
     * Update a post by ID.
     *
     * @param int $id
     * @param array $data
     * @return Post
     *
     * @throws ModelNotFoundException
     */
    public function update(int $id, array $data)
    {
        $data['type'] = $this->getType(collect($data['attachments']));

        DB::beginTransaction();
        try {
            $post = $this->find($id);
            $post->update($data);

            $this->setPost($post);

            $this->deleteAttachment();
            $this->createAttachment($data['attachments']);

            DB::commit();
            return $this->post;
        } catch (Throwable $throwable) {
            DB::rollBack();
            return $throwable;
        }
    }

    /**
     * Delete a post by ID.
     *
     * @param int $id
     * @return bool
     *
     * @throws ModelNotFoundException
     */
    public function delete(int $id): bool
    {
        $post = $this->find($id);
        return $post->delete();
    }

    /**
     * Permanently delete a post by ID.
     *
     * @param int $id
     * @return bool
     *
     * @throws ModelNotFoundException
     */
    public function forceDelete(int $id): bool
    {
        $post = $this->find($id);
        return $post->forceDelete();
    }


    /**
     * Toggle the is_pinned status of a post.
     *
     * @param int $id
     * @return Post
     *
     * @throws ModelNotFoundException
     */
    public function togglePinned(int $id): Post
    {
        $post = $this->find($id);
        $post->is_pinned = !$post->is_pinned;
        $post->save();

        return $post;
    }

    /**
     * Toggle the is_archived status of a post.
     *
     * @param int $id
     * @return Post
     *
     * @throws ModelNotFoundException
     */
    public function toggleArchived(int $id): Post
    {
        $post = $this->find($id);
        $post->is_pinned = !$post->is_pinned;
        $post->save();

        return $post;
    }

    private function getType($attachments): PostTypeEnum
    {
        if ($attachments->count() == 1) {
            $attachment = $attachments->first();

            if (Str::startsWith($attachment->getMimeType(), 'video/')) {
                return PostTypeEnum::Video;
            }
        }

        if ($attachments->count() > 1) {
            return PostTypeEnum::Gallery;
        }

        return PostTypeEnum::Photo;
    }
}
