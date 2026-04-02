<?php

namespace Modules\Common\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Image;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class ResizeImage implements ShouldBeUnique, ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public function __construct(
        private string $oldPath,
        private string $newPath,
        private string $disk = 'public',
        private ?int $width = null,
        private ?int $height = null,
    ) {
    }

    public function handle(): void
    {
        $disk = Storage::disk($this->disk);

        $baseName = basename($this->newPath);
        $disk->makeDirectory(str_replace($baseName, '', $this->newPath));

        $image = Image::load($disk->path($this->oldPath));

        if ($this->width && $this->height) {
            $image->fit(Fit::Crop, $this->width, $this->height);
        } else {
            if ($this->width) {
                $image->width($this->width);
            }
            if ($this->height) {
                $image->height($this->height);
            }
        }

        $image->save($disk->path($this->newPath));

        $optimizer = OptimizerChainFactory::create([
            'quality' => 95,
        ]);
        $optimizer->optimize($disk->path($this->newPath));
    }

    public function uniqueId(): string
    {
        return $this->newPath;
    }
}
