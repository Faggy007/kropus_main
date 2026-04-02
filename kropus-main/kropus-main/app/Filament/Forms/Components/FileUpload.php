<?php

namespace App\Filament\Forms\Components;

use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class FileUpload extends \Filament\Forms\Components\FileUpload
{
    public static function make(string $name): static
    {
        $component = parent::make($name);

        return $component->directory(sprintf(
            'attachments/%s/%s/%s',
            date('Y'),
            date('m'),
            date('d')
        ))
            ->downloadable()
            ->openable()
            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                $ext = $file->getClientOriginalExtension();
                $name = str($file->getClientOriginalName())->beforeLast('.') ?: $file->getClientOriginalName();

                return str($name.'-'.Str::random(3))->slug().'.'.$ext;
            });
    }

    public function subDirectory(string $subDirectory): static
    {
        return $this->directory(sprintf(
            'attachments/%s/%s/%s/%s',
            $subDirectory,
            date('Y'),
            date('m'),
            date('d')
        ));
    }
}
