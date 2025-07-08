<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuSource;

class MenuSourceSeeder extends Seeder
{
    public function run(): void
    {
        MenuSource::insert([
            ['image_path' => 'menus/ramen_ichiro.jpg', 'shop_id' => 1, 'processed' => true],
            ['image_path' => 'menus/cafe_hanako.jpg', 'shop_id' => 2, 'processed' => false],
        ]);
    }
}
