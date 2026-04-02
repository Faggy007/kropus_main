<?php

namespace App\Filament\Modules\Blog\Resources\PostResource\Pages;

use App\Filament\Modules\Blog\Resources\PostResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;
}
