<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Http\Requests\PostCommentRequest;
use Arealtime\Post\App\Http\Resources\PostCommentResource;
use Arealtime\Post\App\Models\Post;
use Arealtime\Post\App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class PostCommentController extends Controller
{
    public function __construct(private readonly PostService $postService) {}

    /**
     * @return AnonymousResourceCollection<PostCommentResource>
     */
    public function index(Post $post): AnonymousResourceCollection
    {
        return PostCommentResource::collection($this->postService->setPost($post)->allComments());
    }

    /**
     * @param PostCommentRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function store(PostCommentRequest $request, Post $post): JsonResponse
    {
        $this->postService->setPost($post)
            ->setData(['content' => $request->input('content')])
            ->createComment();

        return response()->json([
            'message' => __('post::messages.operation.complete')
        ]);
    }

    /**
     * @param Post $post
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Post $post, int $id): JsonResponse
    {
        $this->postService->setPost($post)
            ->setData(['comment_id' => $id])
            ->deleteComment();

        return response()->json([
            'message' => __('post::messages.operation.complete')
        ]);
    }
}
