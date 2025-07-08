<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        MenuItem::insert([
            ['name' => '味噌ラーメン', 'price' => 900, 'shop_id' => 1, 'source_id' => 1],
            ['name' => '抹茶ラテ', 'price' => 500, 'shop_id' => 2, 'source_id' => 2],
        ]);
    }
}
