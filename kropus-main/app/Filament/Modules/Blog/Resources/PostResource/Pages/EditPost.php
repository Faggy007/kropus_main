<?php

namespace App\Filament\Modules\Blog\Resources\PostResource\Pages;

use App\Filament\Modules\Blog\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    public function getSubheading(): string|Htmlable|null
    {
        return $this->record->getTranslatedField('title');
    }
    
    protected function getHeaderActions(): array
    {
        return [
            $this->getSaveFormAction()->submit(null)->action('save'),
            Actions\ActionGroup::make([
                Actions\DeleteAction::make(),
                Actions\ForceDeleteAction::make(),
                Actions\RestoreAction::make(),
            ])
                ->icon('heroicon-o-trash')
                ->button()
                ->label('Удаление')
                ->color('danger'),
        ];
    }
}
