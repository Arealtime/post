<?php

namespace Arealtime\Post\App\Http\Controllers;

use Arealtime\Post\App\Services\PostService;
use Illuminate\Routing\Controller;

class PostArchiveController extends Controller
{
    public function __construct(private readonly PostService $postService) {}

    /**
     * Get all archived posts for the currently authenticated user.
     *
     * @return \Illuminate\Database\Eloquent\Collection The collection of archived posts
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If any required data is missing
     */
    public function archive()
    {
        return $this->postService->allArchived();
    }

    /**
     * Toggle the archived status of a specified post for the currently authenticated user.
     *
     * @param int $id The ID of the post to toggle the archived status
     * @return \Arealtime\Post\App\Models\Post The updated Post instance after toggling pin status
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the post is not found
     * @throws \Throwable If any error occurs during the toggle operation
     */
    public function toggleArchive(int $id)
    {
        return $this->postService->toggleArchive($id);
    }
}
