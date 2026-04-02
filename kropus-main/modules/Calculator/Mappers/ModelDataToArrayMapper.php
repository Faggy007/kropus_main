<?php

namespace Modules\Calculator\Mappers;

use Modules\Calculator\Data\Model;

class ModelDataToArrayMapper
{
    public function map(Model $model): array
    {
        $data = [
            'width' => $model->width,
            'height' => $model->height,
            'depth' => $model->depth,
            'elements' => $model->elements->toArray(),
        ];

        return $data;
    }
}
