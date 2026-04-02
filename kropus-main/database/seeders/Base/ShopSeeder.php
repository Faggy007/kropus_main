<?php

namespace Database\Seeders\Base;

use Illuminate\Database\Seeder;
use Modules\Shop\Models\Category;
use Modules\Shop\Models\Unit;

class ShopSeeder extends Seeder
{
    const CATEGORIES = [
        [
            'title' => ['ru' => 'Корпуса'],
            'slug' => 'cases',
        ]
    ];

    const UNITS = [
        [
            'title' => ['ru' => 'Миллиметры'],
            'short_title' => ['ru' => 'мм'],
            'slug' => 'mm',
        ],
        [
            'title' => ['ru' => 'Сантиметры'],
            'short_title' => ['ru' => 'см'],
            'slug' => 'cm',
        ],
        [
            'title' => ['ru' => 'Килограммы'],
            'short_title' => ['ru' => 'кг'],
            'slug' => 'kg',
        ]
    ];

    public function run()
    {
        foreach (self::CATEGORIES as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                [
                    'title' => $category['title'],
                    'description' => null,
                ]
            );
        }

        foreach (self::UNITS as $unit) {
            Unit::firstOrCreate(
                ['slug' => $unit['slug']],
                [
                    'title' => $unit['title'],
                    'short_title' => $unit['short_title'],
                ]
            );
        }
    }
}
