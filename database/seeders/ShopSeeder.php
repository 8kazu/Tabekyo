<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        Shop::insert([
            ['name' => '一番餃子', 'latitude' => 35.709000, 'longitude' => 139.759200],
            ['name' => 'やよい軒 本郷店', 'latitude' => 35.712300, 'longitude' => 139.759800],
            ['name' => '中央食堂（Chuo dining hall）', 'latitude' => 35.705500, 'longitude' => 139.760000]
        ]);
    }
}
