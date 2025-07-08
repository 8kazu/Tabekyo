<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::insert([
            ['name' => 'しょうゆラーメン', 'price' => 800, 'image_path' => 'images/items/ramen.jpg', 'shop_id' => 1],
            ['name' => 'カフェラテ', 'price' => 450, 'image_path' => 'images/items/ramen.jpg', 'shop_id' => 2],
            ['name' => 'まぐろ寿司', 'price' => 1200, 'image_path' => 'images/items/ramen.jpg', 'shop_id' => 3],
        ]);
    }
}
