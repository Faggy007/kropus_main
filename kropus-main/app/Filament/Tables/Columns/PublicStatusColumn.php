<?php

namespace App\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;
use Modules\Common\Enums\PublicStatus;

class PublicStatusColumn extends TextColumn
{
    public static function make(string $name = 'publicStatus.status'): static
    {
        return parent::make($name)->badge()
            ->color(fn (PublicStatus $state) => match ($state) {
            PublicStatus::DRAFT => 'warning',
            PublicStatus::PUBLISHED => 'success',
            PublicStatus::PRIVATE => 'info',
        })->formatStateUsing(fn (PublicStatus $state): string => match ($state) {
            PublicStatus::DRAFT => 'Черновик',
            PublicStatus::PUBLISHED => 'Опубликовано',
            PublicStatus::PRIVATE => 'Личное',
            default => 'Неизвестно',
        })->label('Статус публикации');
    }
}
