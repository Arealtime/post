<?php

namespace Arealtime\Post\App\Traits\Post;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait PostScope
{
    public function scopePinned(Builder $builder): Builder
    {
        return $builder->where('is_pinned', true);
    }

    public function scopeNotPinned(Builder $builder): Builder
    {
        return $builder->where('is_pinned', false);
    }

    public function scopeArchived(Builder $builder): Builder
    {
        return $builder->where('is_archived', true);
    }

    public function scopeNotArchived(Builder $builder): Builder
    {
        return $builder->where('is_archived', false);
    }

    public function scopePublished(Builder $builder): Builder
    {
        return $builder->where('posted_at', '<=', Carbon::now());
    }

    public function scopeUnPublished(Builder $builder): Builder
    {
        return $builder->where('posted_at', '>', Carbon::now());
    }

    public function scopeCurrentUser(Builder $builder): Builder
    {
        return $builder->where('user_id', auth()->id());
    }
}
