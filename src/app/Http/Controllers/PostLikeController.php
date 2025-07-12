<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Http\Resources\PostLikeResource;
use Arealtime\Post\App\Models\Post;
use Arealtime\Post\App\Services\PostService;
use Illuminate\Routing\Controller;

class PostLikeController extends Controller
{

    public function __construct(private readonly PostService $postService) {}

    /**
     * @param Post $post
     * @return AnonymousResourceCollection<PostLikeResource>
     */
    public function likes(Post $post)
    {
        return PostLikeResource::collection($this->postService->setPost($post)->allLikes());
    }
}
