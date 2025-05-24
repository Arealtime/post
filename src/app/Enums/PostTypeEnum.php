<?php

namespace Arealtime\Post\App\Enums;

enum PostTypeEnum: string
{
    case Photo = 'PHOTO';
    case Gallery = 'GALLERY';
    case Video = 'VIDEO';
}
