<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Http\Resources\PostResource;
use Arealtime\Post\App\Models\Post;
use Arealtime\Post\App\Services\PostService;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PostArchiveController extends Controller
{
    public function __construct(private readonly PostService $postService) {}

    /**
     * @return AnonymousResourceCollection<PostResource>
     */
    public function archived(): AnonymousResourceCollection
    {
        return PostResource::collection($this->postService->allArchived());
    }

    /**
     * @param Post $post
     * @return JsonResponse
     */
    public function toggleArchive(Post $post): JsonResponse
    {
        $this->postService->setPost($post)->toggleArchive();

        return response()->json([
            'message' => __('post::messages.operation.complete')
        ]);
    }
}
