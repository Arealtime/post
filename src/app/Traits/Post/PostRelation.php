<?php

namespace Arealtime\Post\App\Traits\Post;

use Arealtime\Post\App\Helpers\ConfigHelper;
use Arealtime\Post\App\Models\PostComment;
use Arealtime\Post\App\Models\PostLike;
use Arealtime\Post\App\Models\PostShare;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait PostRelation
{
    public function likes(): HasMany
    {
        return $this->hasMany(PostLike::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(PostComment::class);
    }

    public function shares(): HasMany
    {
        return $this->hasMany(PostShare::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(ConfigHelper::getUserModel());
    }
}
