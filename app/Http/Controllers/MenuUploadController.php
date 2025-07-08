<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\MenuSource;
use App\Models\MenuItem;
use App\Models\Shop;

class MenuUploadController extends Controller
{
    /**
     * POST /api/menu/upload
     * メニュー画像をアップロードしてOCR処理・menu_itemsとして保存
     */
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
            'shop_id' => 'required|exists:shops,id',
        ]);

        // 画像保存
        $imagePath = $request->file('image')->store('public/menus');
        $imageUrl = Storage::url($imagePath);

        // menu_sourcesに保存
        $source = MenuSource::create([
            'image_path' => $imageUrl,
            'shop_id' => $request->shop_id,
            'processed' => false, // OCR未処理フラグ
        ]);

        // ※OCR処理の呼び出し（ここではダミーデータで代用）
        // 実際はAI OCR APIを使って、以下のような結果を得る想定
        $dummyResults = [
            ['name' => 'オムライス', 'price' => 700],
            ['name' => 'とんかつ定食', 'price' => 950],
        ];

        foreach ($dummyResults as $menu) {
            MenuItem::create([
                'name' => $menu['name'],
                'price' => $menu['price'],
                'shop_id' => $request->shop_id,
                'source_id' => $source->id,
            ]);
        }

        // フラグ更新
        $source->processed = true;
        $source->save();

        return response()->json([
            'message' => 'メニュー画像を登録し、OCR結果を保存しました。',
            'menu_source_id' => $source->id,
            'items_registered' => count($dummyResults),
        ]);
    }
}
