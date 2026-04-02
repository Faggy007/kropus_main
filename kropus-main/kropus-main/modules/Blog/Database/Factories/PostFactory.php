<?php

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Blog\Models\Category;
use Modules\Blog\Models\Post;
use Modules\Common\Enums\PublicStatus;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => [
                'en' => $this->faker->sentence(5),
                'ru' => $this->faker->sentence(5),
            ],
            'excerpt' => [
                'en' => $this->faker->sentence(10),
                'ru' => $this->faker->sentence(10),
            ],
            'content' => [
                'en' => $this->faker->paragraphs(3, true),
                'ru' => $this->faker->paragraphs(3, true),
            ],
            /*
            'content_schema' => [
                'blocks' => [
                    [
                        'type' => 'paragraph',
                        'data' => [
                            'text' => $this->faker->paragraph(),
                        ],
                    ],
                ],
            ],
            */
            'category_id' => Category::query()->inRandomOrder()->first()->id,
            'image' => $this->faker->imageUrl(800, 600, 'blog'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {

            $post->publicStatus()->create([
                'status' => fake()->boolean(70) ? PublicStatus::PUBLISHED : PublicStatus::DRAFT,
            ]);

            $post->seo()->create([
                'title' => [
                    'en' => $post->getTranslatedField('title', null, 'ru'),
                    'ru' => $post->getTranslatedField('title', null, 'en'),
                ],
                'description' => [
                    'en' => $post->getTranslatedField('excerpt', null, 'ru'),
                    'ru' => $post->getTranslatedField('excerpt', null, 'en'),
                ],
                'robots' => [
                    'en' => 'index, follow',
                    'ru' => 'index, follow',
                ]
            ]);

            $post->save();
        });
    }
}
