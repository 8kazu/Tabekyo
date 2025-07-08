<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;

class MenuItemController extends Controller
{
    /**
     * GET /api/shops/{shop}/menu-items
     * 指定店舗のOCR抽出メニューを一覧で取得
     */
    public function indexByShop($shopId)
    {
        $menuItems = MenuItem::where('shop_id', $shopId)->get();

        return response()->json([
            'shop_id' => $shopId,
            'menu_items' => $menuItems,
        ]);
    }

    /**
     * PUT /api/menu-items/{id}
     * OCR結果の修正（名前や価格の編集）
     */
    public function update(Request $request, $id)
    {
        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return response()->json(['error' => 'メニューが見つかりません'], 404);
        }

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|nullable|integer|min:0',
        ]);

        $menuItem->update($request->only(['name', 'price']));

        return response()->json([
            'message' => 'メニューを更新しました',
            'menu_item' => $menuItem,
        ]);
    }

    /**
     * DELETE /api/menu-items/{id}
     * OCR抽出メニューの削除
     */
    public function destroy($id)
    {
        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return response()->json(['error' => 'メニューが見つかりません'], 404);
        }

        $menuItem->delete();

        return response()->json(['message' => 'メニューを削除しました']);
    }
}
