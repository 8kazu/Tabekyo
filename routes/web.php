<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\MenuUploadController;
use App\Http\Controllers\MenuItemController;

/**
 * フロント画面
 */

Route::get('/', [ItemController::class, 'index'])->name('index'); // 新着一覧
// Route::get('/register', fn() => view('register.create'));    // 登録フォーム
Route::get('/menu/upload', fn() => view('menu.upload'));     // メニューアップロード
Route::get('/shops/{shop}', [ShopController::class, 'showView']);


/**
 * 商品（Item）
 */
Route::get('/items', [ItemController::class, 'index']);                          // 全商品表示（新着順）
Route::get('/items/create', [ItemController::class, 'createView'])->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');                 // 写真・値段・店を登録して料理を登録
Route::get('/items/{id}', [ItemController::class, 'showView']);
Route::get('/items/{distance}', [ItemController::class, 'indexByDistance']);    // 距離指定商品一覧
Route::get('/items/{item}/detail', [ItemController::class, 'show'])->name('items.detail');            // 商品詳細（IDまたは名前）
Route::put('/items/{item}', [ItemController::class, 'update']);                 // 商品編集
Route::delete('/items/{item}', [ItemController::class, 'destroy']);             // 商品削除

/**
 * 料理登録（Register）
 */


/**
 * 店舗（Shop）
 */
Route::get('/items/shop/{shop}', [ShopController::class, 'showItems']);         // 指定店舗の商品一覧
Route::get('/shops/{shop}', [ShopController::class, 'show']);                   // 店舗詳細（OCRメニュー含む）

/**
 * メニュー画像アップロード & OCR
 */
Route::post('/menu/upload', [MenuUploadController::class, 'upload']);           // メニュー画像アップロード & OCR実行

/**
 * OCRで抽出されたメニュー（MenuItem）
 */
Route::get('/shops/{shop}/menu-items', [MenuItemController::class, 'indexByShop']); // 店舗のメニュー一覧（OCR）
Route::put('/menu-items/{id}', [MenuItemController::class, 'update']);              // メニュー編集
Route::delete('/menu-items/{id}', [MenuItemController::class, 'destroy']);          // メニュー削除

/*
|--------------------------------------------------------------------------
| 認証関連
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// PostController関連の旧ルーティングは削除

Route::get('/categories/{category}', [CategoryController::class, 'index'])->middleware("auth");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
