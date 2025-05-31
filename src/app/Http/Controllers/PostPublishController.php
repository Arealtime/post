<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Services\PostService;
use Illuminate\Routing\Controller;

class PostPublishController extends Controller
{
    public function __construct(private readonly PostService $postService) {}

    /**
     * Get all published posts for the currently authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection The collection of published posts
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If any required data is missing
     */
    public function published()
    {
        return $this->postService->allPublished();
    }

    /**
     * Get all unpublished posts for the currently authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection The collection of unpublished posts
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If any required data is missing
     */
    public function unpublished()
    {
        return $this->postService->allUnPublished();
    }
}
