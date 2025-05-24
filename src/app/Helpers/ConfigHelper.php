<?php

namespace Arealtime\Post\App\Helpers;

class ConfigHelper
{
    public static function getUserModel(): string
    {
        return config('arealtime-post.user_model');
    }
}
