<?php

namespace Database\Seeders;

use Database\Seeders\Fake\AdminSeeder;
use Database\Seeders\Fake\BlogSeeder;
use Illuminate\Database\Seeder;

class FakeSeeder extends Seeder
{
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(BaseSeeder::class);
        $this->call(BlogSeeder::class);
    }
}
