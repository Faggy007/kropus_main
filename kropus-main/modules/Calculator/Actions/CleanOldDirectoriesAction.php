<?php

namespace Modules\Calculator\Actions;

use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class CleanOldDirectoriesAction
{
    use AsAction;

    public $commandSignature = 'app:calculator:clean-old-directories';

    public function handle(string $rootDirectory = 'generated-models', int $hours = 24, string $diskName = 'public'): int
    {
        $disk = Storage::disk($diskName);
        $directories = $disk->directories($rootDirectory);
        $threshold = now()->subHours($hours)->getTimestamp();
        $deletedCount = 0;

        foreach ($directories as $directory) {
            if ($disk->lastModified($directory) > $threshold) {
                continue;
            }

            if ($disk->deleteDirectory($directory)) {
                $deletedCount++;
            }
        }

        return $deletedCount;
    }
}
