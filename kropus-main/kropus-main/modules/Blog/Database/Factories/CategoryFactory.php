<?php

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Blog\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'title' => [
                'en' => $this->faker->sentence(3),
                'ru' => $this->faker->sentence(3),
            ],
            'description' => [
                'en' => $this->faker->paragraph(),
                'ru' => $this->faker->paragraph(),
            ],
            'slug' => $this->faker->slug(),
        ];
    }
}