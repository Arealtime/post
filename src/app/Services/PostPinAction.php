<?php

namespace Arealtime\Post\App\Services;

use Arealtime\Post\App\Models\Post;
use Illuminate\Support\Collection;

trait PostPinAction
{
    
    /**
     * @return Collection<Post>
     */
    public function allPinned(): Collection
    {
        return Post::currentUser()->pinned()->get();
    }

    /**
     * @return Post
     */
    public function togglePin(): Post
    {
        $this->checkPostSet();

        $this->post->is_pinned = !$this->post->is_pinned;
        $this->post->save();

        return $this->post;
    }
}
