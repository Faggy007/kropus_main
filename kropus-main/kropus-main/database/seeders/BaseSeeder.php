<?php

namespace Database\Seeders;

use Database\Seeders\Base\BlogSeeder;
use Database\Seeders\Base\ShopSeeder;
use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(BlogSeeder::class);
        $this->call(ShopSeeder::class);
    }
}
