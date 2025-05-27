<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Http\Requests\PostRequest;
use Arealtime\Post\App\Http\Resources\PostResource;
use Arealtime\Post\App\Models\Post;
use Arealtime\Post\App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PostController extends Controller
{

    public function __construct(private readonly PostService $postService) {}

    public function index(Request $request)
    {
        return PostResource::collection($this->postService->all());
    }

    public function store(PostRequest $request)
    {
        $this->postService->create([
            'caption' => $request->input('caption'),
            'location' => $request->input('location'),
            'posted_at' => $request->input('posted_at'),
            'attachments' => $request->file('attachments')
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $this->postService->update($post->id, [
            'caption' => $request->input('caption'),
            'location' => $request->input('location'),
            'posted_at' => $request->input('posted_at'),
            'attachments' => $request->file('attachments')
        ]);
    }

    public function destroy(Post $post)
    {
        $this->postService->delete($post->id);
    }
}
