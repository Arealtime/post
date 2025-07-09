<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Http\Resources\PostResource;
use Arealtime\Post\App\Services\PostService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class PostPublishController extends Controller
{
    public function __construct(private readonly PostService $postService) {}

    /**
     * @return AnonymousResourceCollection<PostResource>
     */
    public function published(): AnonymousResourceCollection
    {
        return PostResource::collection($this->postService->allPublished());
    }

    /**
     * @return AnonymousResourceCollection<PostResource>
     */
    public function unpublished(): AnonymousResourceCollection
    {
        return PostResource::collection($this->postService->allUnPublished());
    }
}
