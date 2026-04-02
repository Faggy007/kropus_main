<?php

namespace Database\Seeders\Fake;

use Illuminate\Database\Seeder;
use Modules\Blog\Database\Factories\PostFactory;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Post;

class BlogSeeder extends Seeder
{
    const SERVICES = [
        [
            'slug' => 'mounting-of-typical-electronic-components',
            'title' => 'Mонтаж типовых электронных компонентов/отверстий',
        ],
        [
            'slug' => 'powder-coating',
            'title' => 'Порошковая покраска',
        ],
        [
            'slug' => 'anodizing',
            'title' => 'Анодирование',
        ],
        [
            'slug' => 'metal-bending',
            'title' => 'Гибка металла',
        ],
        [
            'slug' => 'engraving',
            'title' => 'Гравировка',
        ],
        [
            'slug' => 'milling',
            'title' => 'Фрезеровка',
        ],
        [
            'slug' => 'details',
            'title' => 'Изготовление деталей из различных материалов',
        ],
    ];

    public function run()
    {
        PostFactory::new()
            ->state(function () {
                return [
                    'category_id' => Category::query()->whereNotIn('slug', ['news', 'services'])->inRandomOrder()->first()->id,
                ];
            })
            ->count(10)->create();

        $services = Category::where('slug', 'services')->first();

        foreach (self::SERVICES as $service) {
            Post::firstOrCreate(
                ['slug' => $service['slug']],
                [
                    'title' => [
                        'en' => $service['title'],
                        'ru' => $service['title'],
                    ],
                    'category_id' => $services->id,
                ]
            );
        }
    }
}
