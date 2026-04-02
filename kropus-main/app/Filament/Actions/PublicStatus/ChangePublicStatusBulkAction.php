<?php

namespace App\Filament\Actions\PublicStatus;

use App\Filament\Forms\Components\PublicStatus\PublicStatusGroup;
use App\Filament\Forms\Components\PublicStatus\PublicStatusInput;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ChangePublicStatusBulkAction extends BulkAction
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'change-public-status';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Изменить статус публикации');

        $this->form([
            PublicStatusInput::make()
        ]);

        $this->action(function (array $data): void {
            $this->process(static fn (Collection $records) => $records->each(function (Model $record) use ($data) {
                $record->publicStatus()->updateOrCreate([], [
                    'status' => $data['status']
                ]);
            }));
            $this->success();
        });
    }
}
