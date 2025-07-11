<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function create()
    {
        return view('shops.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'map_url' => 'required|url',
        ]);

        $url = $validated['map_url'];

        // 緯度と経度を !3d35.7118617!4d139.7590836 形式から抽出
        if (preg_match('/!3d([-0-9.]+)!4d([-0-9.]+)/', $url, $matches)) {
            $latitude = $matches[1];
            $longitude = $matches[2];
        } else {
            return back()->withErrors(['map_url' => 'GoogleマップのURLから緯度・経度を抽出できませんでした'])->withInput();
        }

        \App\Models\Shop::create([
            'name' => $validated['name'],
            'latitude' => (float)$latitude,
            'longitude' => (float)$longitude,
        ]);

        return redirect()->route('items.create')->with('success', '店舗を登録しました。');
    }



    public function showView($shopId)
    {
        $shop = \App\Models\Shop::with(['items', 'menuItems'])->findOrFail($shopId);
        return view('shops.show', compact('shop'));
    }
    /**
     * GET /api/items/{shop}
     * 指定店舗の商品一覧を表示
     */
    public function showItems($shopId)
    {
        $shop = Shop::with('items')->find($shopId);

        if (!$shop) {
            return response()->json(['error' => '店舗が見つかりません'], 404);
        }

        return response()->json([
            'shop_name' => $shop->name,
            'location' => [
                'latitude' => $shop->latitude,
                'longitude' => $shop->longitude,
            ],
            'items' => $shop->items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'image_path' => $item->image_path,
                ];
            }),
        ]);
    }

    /**
     * GET /api/shops/{shop}
     * 店舗の詳細（OCRメニュー含む）を表示（必要であれば）
     */
    public function show($shopId)
    {
        $shop = Shop::with(['items', 'menuItems'])->find($shopId);

        if (!$shop) {
            return response()->json(['error' => '店舗が見つかりません'], 404);
        }

        return response()->json([
            'shop_name' => $shop->name,
            'location' => [
                'latitude' => $shop->latitude,
                'longitude' => $shop->longitude,
            ],
            'items' => $shop->items,
            'menu_items' => $shop->menuItems,
        ]);
    }
}
