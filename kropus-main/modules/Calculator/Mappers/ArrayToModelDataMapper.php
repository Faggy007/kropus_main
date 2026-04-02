<?php

namespace Modules\Calculator\Mappers;

use Modules\Calculator\Data\Elements\As207;
use Modules\Calculator\Data\Elements\As208;
use Modules\Calculator\Data\Elements\Aux;
use Modules\Calculator\Data\Elements\Db15;
use Modules\Calculator\Data\Elements\Db25;
use Modules\Calculator\Data\Elements\Db9;
use Modules\Calculator\Data\Elements\Hdmi;
use Modules\Calculator\Data\Elements\Hole;
use Modules\Calculator\Data\Elements\Rj45;
use Modules\Calculator\Data\Elements\Rmdt2;
use Modules\Calculator\Data\Elements\UsbA;
use Modules\Calculator\Data\Elements\UsbC;
use Modules\Calculator\Data\Model;

class ArrayToModelDataMapper
{
    const ELEMENT_TYPE_TO_CLASS = [
        'hole' => Hole::class,
        'hdmi' => Hdmi::class,
        'usb_a' => UsbA::class,
        'usb_c' => UsbC::class,
        'aux' => Aux::class,
        'db9' => Db9::class,
        'db15' => Db15::class,
        'db25' => Db25::class,
        'rj45' => Rj45::class,
        '2rmdt' => Rmdt2::class,
        'as207' => As207::class,
        'as208' => As208::class,
    ];

    public function map(array $array): Model
    {
        $model = Model::from([
            'width' => $array['width'],
            'height' => $array['height'],
            'depth' => $array['depth'],
        ]);

        foreach ($array['elements'] as $arrayElement) {
            $class = self::ELEMENT_TYPE_TO_CLASS[$arrayElement['type']];
            $model->elements->push(
                $class::from($arrayElement)
            );
        }

        return $model;
    }
}
