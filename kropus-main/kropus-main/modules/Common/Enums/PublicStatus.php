<?php

namespace Modules\Common\Enums;

enum PublicStatus: string
{
    case DRAFT = 'draft';
    case PRIVATE = 'private';
    case PUBLISHED = 'published';
}
