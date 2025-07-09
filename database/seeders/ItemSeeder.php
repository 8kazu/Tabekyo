<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        Item::insert([
            ['name' => '大人のお子様ランチ', 'price' => 450, 'image_path' => 'images/items/hamburg.jpg', 'shop_id' => 2],
            ['name' => '麻婆豆腐', 'price' => 900, 'image_path' => 'images/items/ma-bo.jpg', 'shop_id' => 1],
            ['name' => '赤門ラーメン', 'price' => 600, 'image_path' => 'images/items/ramen.jpg', 'shop_id' => 3],
        ]);
    }
}
