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
    use PostLikeAction, PostCommentAction, PostAttachmentAction, PostPinAction, PostPublishAction, PostPublishAction, PostArchiveAction;

    private Post $post;
    private array $data;

    /**
     * Set the current post instance by post ID.
     *
     * @param int $id The ID of the post to set
     * @return self Returns the current instance for method chaining
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the post with the given ID is not found
     */
    public function setPost(Post $post): self
    {
        $this->post = $post;
        return $this;
    }

    public function setData(array $data): self
    {
        $this->data = data;
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
        return Post::with('attachments')->currentUser()->latest()->get();
    }

    /**
     * Create a new post.
     *
     * @param array $data
     * @return Post
     */
    public function create()
    {
        $this->data['type'] = $this->getType(collect($this->data['attachments']));

        DB::beginTransaction();
        try {
            $post = Post::create($this->data);

            $this->setPost($post);

            $this->createAttachment($this->data['attachments']);
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
     * @param Post $post
     * @param array $data
     * @return Post
     *
     * @throws ModelNotFoundException
     */
    public function update(Post $post, array $data)
    {
        $data['type'] = $this->getType(collect($data['attachments']));

        DB::beginTransaction();
        try {
            $this->setPost($post);

            $this->post->update($data);

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
    public function delete(Post $post): bool
    {
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
    public function forceDelete(Post $post): bool
    {
        return $post->forceDelete();
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
