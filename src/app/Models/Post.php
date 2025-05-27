<?php

namespace Arealtime\Post\App\Models;

use Arealtime\Post\App\Traits\Post\PostRelation;
use Arealtime\Post\App\Traits\Post\PostScope;
use Arealtime\Post\App\Traits\Post\PostVirtualAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes, PostScope, PostRelation, PostVirtualAttribute;

    protected $fillable = ['caption', 'location', 'posted_at'];
}
