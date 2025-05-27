<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Http\Requests\PostRequest;
use Arealtime\Post\App\Http\Resources\PostResource;
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

    public function update(PostRequest $request, int $id)
    {
        $this->postService->update($id, [
            'caption' => $request->input('caption'),
            'location' => $request->input('location'),
            'posted_at' => $request->input('posted_at'),
            'attachments' => $request->file('attachments')
        ]);
    }

    public function destroy(int $id)
    {
        $this->postService->delete($id);
    }
}
