<?php

namespace Arealtime\Post\App\Services;

use Arealtime\Post\App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
 
trait PostArchiveAction
{
    /**
     * @return Collection<Post>
     */
    public function allArchived(): Collection
    {
        return Post::currentUser()->archived()->get();
    }

    /**
     * @return Post
     */
    public function toggleArchive(): Post
    {
        $this->checkPostSet();

        $this->post->is_archived = !$this->post->is_archived;
        $this->post->save();

        return $this->post;
    }
}
