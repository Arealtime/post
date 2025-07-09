<?php

namespace Arealtime\Post\App\Services;

use Arealtime\Post\App\Models\Post;
use Illuminate\Support\Collection;

trait PostPublishAction
{

    /**
     * @return Collection<Post>
     */
    public function allPublished(): Collection
    {
        return Post::currentUser()->published()->get();
    }

    /**
     * @return Collection<Post>
     */
    public function allUnPublished(): Collection
    {
        return Post::currentUser()->unPublished()->get();
    }
}
