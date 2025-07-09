<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Http\Requests\PostRequest;
use Arealtime\Post\App\Http\Resources\PostResource;
use Arealtime\Post\App\Models\Post;
use Arealtime\Post\App\Services\PostService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class PostController extends Controller
{
    public function __construct(private readonly PostService $postService) {}

    /**
     * @return AnonymousResourceCollection<PostResource>
     */
    public function index(): AnonymousResourceCollection
    {
        return PostResource::collection($this->postService->all());
    }

    /**
     * @param Post $post
     * @return PostResource
     */
    public function get(Post $post): PostResource
    {
        return new PostResource($post);
    }

    /**
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request): JsonResponse
    {
        $this->postService->setData([
            'caption' => $request->input('caption'),
            'location' => $request->input('location'),
            'posted_at' => $request->input('posted_at', Carbon::now()),
            'attachments' => $request->file('attachments')
        ])->create();

        return response()->json([
            'message' => __('post::messages.operation.success.create')
        ]);
    }

    /**
     * @param Request $request
     * @param Post $post
     * @return Post
     */
    public function update(Request $request, Post $post): Post
    {
        return $this->postService->setData([
            'caption' => $request->input('caption'),
            'location' => $request->input('location'),
            'posted_at' => $request->input('posted_at'),
            'attachments' => $request->file('attachments')
        ])->update($post);
    }

    /**
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        $this->postService->delete($post);

        return response()->json([
            'message' => __('post::messages.operation.success.delete'),
        ]);
    }
}
