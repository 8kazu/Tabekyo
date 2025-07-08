<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Shop;

class RegisterController extends Controller
{
    /**
     * POST /api/register
     * 料理を登録（写真・値段・店情報）
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'image' => 'nullable|image|max:5120',
            'shop_name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // 店舗が存在しなければ新規作成（名前と位置が一致するものを基準に）
        $shop = Shop::firstOrCreate(
            [
                'name' => $request->shop_name,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]
        );

        // 画像保存処理
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/items');
            $imagePath = Storage::url($imagePath); // アクセス用URLに変換
        }

        // アイテム作成
        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->image_path = $imagePath;
        $item->shop_id = $shop->id;
        $item->save();

        return response()->json([
            'message' => '料理が登録されました',
            'item_id' => $item->id,
            'shop_id' => $shop->id,
        ], 201);
    }
}
