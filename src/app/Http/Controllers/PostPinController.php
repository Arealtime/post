<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Http\Resources\PostResource;
use Arealtime\Post\App\Models\Post;
use Arealtime\Post\App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class PostPinController extends Controller
{
    public function __construct(private readonly PostService $postService) {}

    /**
     * @return AnonymousResourceCollection<PostResource>
     */
    public function pinned(): AnonymousResourceCollection
    {
        return PostResource::collection($this->postService->allPinned());
    }

    /**
     * @param Post $post
     * @return JsonResponse
     */
    public function togglePin(Post $post): JsonResponse
    {
        $this->postService->setPost($post)->togglePin();

        return response()->json([
            'message' => __('post::messages.operation.complete')
        ]);
    }
}
