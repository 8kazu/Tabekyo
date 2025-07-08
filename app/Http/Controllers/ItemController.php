<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Shop;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // /**
    //  * ビュー表示
    //  */
    public function indexView()
    {
        $items = \App\Models\Item::with('shop')->latest()->get();
        return view('items.index', compact('items'));
    }
    public function showView($id)
    {
        $item = \App\Models\Item::with('shop')->findOrFail($id);
        return view('items.show', compact('item'));
    }
    /**
     * GET /api/items/create
     * 商品登録フォーム表示
     */
    public function createView()
    {
        $shops = \App\Models\Shop::all();
        return view('items.create', compact('shops'));
    }



    /**
     * GET /api/items
     * 全商品を新着順に表示
     */
    public function index()
    {
        $items = Item::latest()->get(); // もしくは任意の取得方法
        return view('items.index', compact('items'));
    }

    /**
     * GET /api/items/{item}
     * 商品データの表示
     */
    public function show($item)
    {
        $item = Item::with('shop')->findOrFail($item);
        return view('items.show', compact('item'));
    }


    /**
     * POST /api/items
     * 商品データの表示
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'shop_id' => 'required|exists:shops,id',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images/items', 'public');
            $validated['image_path'] = 'storage/' . $path;
        }

        \App\Models\Item::create($validated);

        return redirect()->route('index')->with('success', '商品を登録しました。');
    }











    /**
     * GET /api/items/{distance}?lat=XXX&lng=YYY
     * 指定距離内の商品を一覧で表示
     */
    public function indexByDistance($distance, Request $request)
    {
        $lat = $request->query('lat');
        $lng = $request->query('lng');

        if (!$lat || !$lng) {
            return response()->json(['error' => 'lat and lng are required'], 400);
        }

        // Haversine式による距離計算
        $items = Item::selectRaw("
                items.*, 
                shops.latitude, 
                shops.longitude,
                (
                    6371000 * acos(
                        cos(radians(?)) *
                        cos(radians(shops.latitude)) *
                        cos(radians(shops.longitude) - radians(?)) +
                        sin(radians(?)) *
                        sin(radians(shops.latitude))
                    )
                ) AS distance
            ", [$lat, $lng, $lat])
            ->join('shops', 'items.shop_id', '=', 'shops.id')
            ->having('distance', '<=', $distance)
            ->orderBy('distance')
            ->get();

        return response()->json($items);
    }




    /**
     * PUT /api/items/{item}
     * 商品データの編集
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->update($request->only(['name', 'price', 'image_path']));
        return response()->json(['message' => 'Item updated', 'item' => $item]);
    }

    /**
     * DELETE /api/items/{item}
     * 商品データの削除
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Item deleted']);
    }
}
