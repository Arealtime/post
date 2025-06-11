<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Http\Requests\PostCommentRequest;
use Arealtime\Post\App\Models\Post;
use Arealtime\Post\App\Services\PostService;
use Illuminate\Routing\Controller;

class PostCommentController extends Controller
{
    public function __construct(private readonly PostService $postService) {}

    /**
     * Display all comments for the specified post.
     *
     * @param int $id The ID of the post
     * @return \Illuminate\Database\Eloquent\Collection The collection of comments for the post
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the post is not found
     */
    public function index(int $id)
    {
        return $this->postService->setPost(Post::findOrFail($id))->allComments();
    }

    /**
     * Store a newly created comment for the specified post.
     *
     * @param PostCommentRequest $request The validated request containing comment content
     * @param int $id The ID of the post
     * @return void
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the post is not found
     */
    public function store(PostCommentRequest $request, int $id): void
    {
        $this->postService->setPost(Post::findOrFail($id))
            ->setData(['content' => $request->input('content')])
            ->createComment();
    }

    /**
     * Remove a specific comment of the specified post.
     *
     * @param int $id The ID of the post
     * @param int $commentId The ID of the comment to delete
     * @return void
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the post is not found
     * @throws \Throwable If any error occurs during deletion
     */
    public function destroy(Post $post, int $commentId): void
    {
        $this->postService->setPost($post)
            ->setData(['comment_id' => $commentId])
            ->deleteComment();
    }
}
