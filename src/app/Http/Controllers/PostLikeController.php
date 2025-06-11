<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Models\Post;
use Arealtime\Post\App\Services\PostService;
use Illuminate\Routing\Controller;

class PostLikeController extends Controller
{

    public function __construct(private readonly PostService $postService) {}
    /**
     * Display all likes for the specified post.
     *
     * @param int $id The ID of the post
     * @return \Illuminate\Database\Eloquent\Collection The collection of likes for the post
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the post is not found
     */
    public function index(int $id)
    {
        return $this->postService->setPost(Post::findOrFail($id))->allLikes();
    }

    /**
     * Toggle the like status for the specified post by the current user.
     *
     * If the post is liked by the user, it will be unliked, and vice versa.
     *
     * @param int $id The ID of the post
     * @return \Arealtime\Post\App\Models\Post The updated Post instance
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the post is not found
     * @throws \Throwable If any error occurs during the toggle operation
     */
    public function toggleLike(int $id)
    {
        return $this->postService->setPost(Post::findOrFail($id))->toggleLike();
    }
}
