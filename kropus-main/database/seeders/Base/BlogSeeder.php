<?php

namespace Database\Seeders\Base;

use Illuminate\Database\Seeder;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Post;

class BlogSeeder extends Seeder
{
    public function run()
    {
        Post::firstOrCreate(
            ['slug' => 'home'],
            [
                'title' => [
                    'en' => 'Homepage',
                    'ru' => 'Главная страница'
                ],
                'category_id' => null
            ]
        );

        Post::firstOrCreate(
            ['slug' => 'about'],
            [
                'title' => [
                    'en' => 'About',
                    'ru' => 'О нас'
                ],
                'category_id' => null
            ]
        );

        Post::firstOrCreate(
            ['slug' => 'catalog'],
            [
                'title' => [
                    'en' => 'Catalog',
                    'ru' => 'Каталог'
                ],
                'category_id' => null
            ]
        );

        Post::firstOrCreate(
            ['slug' => 'contact'],
            [
                'title' => [
                    'en' => 'Contacts',
                    'ru' => 'Контакты'
                ],
                'category_id' => null
            ]
        );

        Post::firstOrCreate(
            ['slug' => 'custom'],
            [
                'title' => [
                    'en' => 'Custom solution',
                    'ru' => 'Корпуса по вашему ТЗ'
                ],
                'category_id' => null
            ]
        );

        Post::firstOrCreate(
            ['slug' => 'privacy'],
            [
                'title' => [
                    'en' => 'Privacy Policy',
                    'ru' => 'Политика конфиденциальности'
                ],
                'category_id' => null
            ]
        );

        Post::firstOrCreate(
            ['slug' => 'cookies'],
            [
                'title' => [
                    'en' => 'Cookies Policy',
                    'ru' => 'Политика использования файлов cookie'
                ],
                'category_id' => null
            ]
        );

        Category::firstOrCreate(
            ['slug' => 'news'],
            [
                'title' => [
                    'en' => 'News',
                    'ru' => 'Новости',
                ],
            ]
        );

        $services = Category::firstOrCreate(
            ['slug' => 'services'],
            [
                'title' => [
                    'en' => 'Services',
                    'ru' => 'Услуги',
                ],
            ]
        );

        Category::firstOrCreate(
            ['slug' => 'projects'],
            [
                'title' => [
                    'en' => 'Projects',
                    'ru' => 'Проекты',
                ],
            ]
        );
    }
}
