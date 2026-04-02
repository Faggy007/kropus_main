<?php

namespace App\Filament\Forms\Components\Seo;

use App\Filament\Forms\Components\FileUpload;
use App\Filament\Forms\Components\MultilingualFieldWrap;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Illuminate\Database\Eloquent\Model;

class SeoGroup extends Group
{
    public static function make(array|Closure $schema = []): static
    {
        return parent::make([
            MultilingualFieldWrap::make(Forms\Components\TextInput::make('title')->label('Title'))->columnSpanFull(),
            MultilingualFieldWrap::make(Forms\Components\Textarea::make('description')->label('Description'))->columnSpanFull(),
            MultilingualFieldWrap::make(Forms\Components\Select::make('robots')
                ->label('Robots')
                ->options([
                    'index, follow' => 'Index, Follow',
                    'noindex, follow' => 'No Index, Follow',
                    'index, nofollow' => 'Index, No Follow',
                    'noindex, nofollow' => 'No Index, No Follow',
                ]))->columnSpanFull(),
            //MultilingualFieldWrap::make(Forms\Components\TextInput::make('og_title')->label('OG Title'))->columnSpanFull(),
            //MultilingualFieldWrap::make(Forms\Components\Textarea::make('og_description')->label('OG Description'))->columnSpanFull(),
            FileUpload::make('image')
                ->label('Изображение')
                ->image(),
            //FileUpload::make('og_image')
            //    ->label('OG Изображение')
            //    ->image(),
        ])->relationship('seo')
            ->columns(1);
    }
}
