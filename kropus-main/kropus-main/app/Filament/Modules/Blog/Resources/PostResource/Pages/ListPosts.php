<?php

namespace App\Filament\Modules\Blog\Resources\PostResource\Pages;

use App\Filament\Modules\Blog\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Modules\Blog\Models\Category;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    public function getTabs(): array
    {
        $tabs = [
            null => Tab::make('Все'),
            '0' => Tab::make('Без категории')->query(fn ($query) => $query->whereNull('category_id')),
        ];
        $categories = Category::all();
        foreach ($categories as $category) {
            $tabs[$category->slug] = Tab::make($category->getTranslatedField('title'))->query(fn ($query) => $query->where('category_id', $category->id));
        }

        return $tabs;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
