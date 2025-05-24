<?php

namespace Arealtime\Post\App\Services;

use Arealtime\Post\App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class PostService
{
    /**
     * Get all posts.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Post::all();
    }

    /**
     * Create a new post.
     *
     * @param array $data
     * @return Post
     */
    public function create(array $data): Post
    {
        return Post::create($data);
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
    public function update(int $id, array $data): Post
    {
        $post = $this->find($id);
        $post->update($data);
        return $post;
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
}
