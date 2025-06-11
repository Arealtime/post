<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Http\Requests\PostRequest;
use Arealtime\Post\App\Http\Resources\PostResource;
use Arealtime\Post\App\Models\Post;
use Arealtime\Post\App\Services\PostService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(private readonly PostService $postService) {}

    public function index()
    {
        return PostResource::collection($this->postService->all());
    }

    public function store(PostRequest $request)
    {
        $this->postService->setData([
            'caption' => $request->input('caption'),
            'location' => $request->input('location'),
            'posted_at' => $request->input('posted_at', Carbon::now()),
            'attachments' => $request->file('attachments'),
            'user_id'   => Auth::id()
        ])->create();

        return response()->json([
            'message' => __('post::messages.operation.success.create')
        ]);
    }

    public function update(Request $request, Post $post): Post
    {
        dd($post->id);
         return $this->postService->setData([
            'caption' => $request->input('caption'),
            'location' => $request->input('location'),
            'posted_at' => $request->input('posted_at'),
            'attachments' => $request->file('attachments')
        ])->update($post);
    }

    public function destroy(Post $post)
    {
        $this->postService->delete($post);
    }
}
