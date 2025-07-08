<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        Shop::insert([
            ['name' => 'ラーメン一郎', 'latitude' => 35.6895, 'longitude' => 139.6917],
            ['name' => 'カフェ花子', 'latitude' => 34.6937, 'longitude' => 135.5023],
            ['name' => 'すし太郎', 'latitude' => 43.0642, 'longitude' => 141.3469],
        ]);
    }
}
