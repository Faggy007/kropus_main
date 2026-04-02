<?php

namespace App\Filament\Modules\Blog\Resources\CategoryResource\Pages;

use App\Filament\Modules\Blog\Resources\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
