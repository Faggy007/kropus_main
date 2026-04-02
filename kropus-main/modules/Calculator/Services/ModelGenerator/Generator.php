<?php

namespace Modules\Calculator\Services\ModelGenerator;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Calculator\Data\Model;
use Modules\Calculator\Mappers\ModelDataToArrayMapper;
use ZipArchive;

class Generator
{
    public function __construct(
        private ModelDataToArrayMapper $mapper,
    )
    {
    }

    public function generate(Model $model): Response
    {
        $data = $this->mapper->map($model);

        $response = Http::post(
            config('services.prokorpus_model_generator.url') . '/generate',
            $data
        );

        $uid = Str::uuid()->toString();
        $folder = 'generated-models/' . $uid;
        $path = $folder . '.zip';

        $disk = Storage::disk('public');
        $disk->makeDirectory($folder);
        $disk->put(
            $path,
            $response->body()
        );

        $zip = new ZipArchive;
        if ($zip->open($disk->path($path)) === true) {
            $zip->extractTo($disk->path($folder));
            $zip->close();
            $disk->delete($path);
        } else {
            throw new Exception('Failed to open zip file');
        }

        return new Response(
            glbPath: $disk->url($folder . '/full.glb'),
            stepPath: $disk->url($folder . '/box.stp')
        );
    }
}
