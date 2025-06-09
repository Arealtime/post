<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Http\Requests\PostRequest;
use Arealtime\Post\App\Http\Resources\PostResource;
use Arealtime\Post\App\Models\Post;
use Arealtime\Post\App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(private readonly PostService $postService) {}

    public function index(Request $request)
    {
        return PostResource::collection($this->postService->all());
    }

    public function store(PostRequest $request): Post
    {
        return $this->postService
            ->setData([
                'caption' => $request->input('caption'),
                'location' => $request->input('location'),
                'posted_at' => $request->input('posted_at'),
                'attachments' => $request->file('attachments'),
                'user_id'   => Auth::id()
            ])->create();
    }

    public function update(PostRequest $request, Post $post): Post
    {
        return $this->postService
            ->setData([
                'caption' => $request->input('caption'),
                'location' => $request->input('location'),
                'posted_at' => $request->input('posted_at'),
                'attachments' => $request->file('attachments')
            ])
            ->update($post);
    }

    public function destroy(Post $post)
    {
        $this->postService->delete($post);
    }
}
