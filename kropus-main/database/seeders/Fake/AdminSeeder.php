<?php

namespace Database\Seeders\Fake;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::query()->updateOrCreate(
            [
                'email' => 'admin@test.ru'
            ],
            [
                'name' => 'Админ',
                'password' => bcrypt('admin'),
            ]
        );
    }
}
