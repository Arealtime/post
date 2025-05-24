<?php

namespace Arealtime\Post\App\Enums;

enum PostCommandEnum: string
{
    case Help = 'help';
    case Migrate = 'migrate';
    case Config = 'config';
    case RunUI = 'run-ui';
}
