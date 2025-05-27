<?php

namespace Arealtime\Post\App\Traits\Post;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;

trait PostVirtualAttribute
{
    public function isLikedByCurrentUser(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->postLikes()->where('user_id', Auth::id())->exists()
        );
    }
}
