<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Models\Post;
use Arealtime\Post\App\Services\PostService;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class PostArchiveController extends Controller
{
    public function __construct(private readonly PostService $postService) {}

    /**
     * @return Collection<Post>
     *
     * @throws ModelNotFoundException
     */
    public function archived(): Collection
    {
        return $this->postService->allArchived();
    }

    /**
     * @param Post $post
     * 
     * @return Post
     *
     * @throws ModelNotFoundException
     * @throws Throwable
     */
    public function toggleArchive(Post $post): Post
    {
        return $this->postService->setPost($post)->toggleArchive();
    }
}
