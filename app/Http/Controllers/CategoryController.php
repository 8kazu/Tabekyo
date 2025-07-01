<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post; // 追加

class CategoryController extends Controller
{
    public function index(Category $category = null)
    {
        if ($category === null) {
            $posts = Post::all();
        } else {
            $posts = $category->getByCategory();
        }

        return view('categories.index')->with(['posts' => $posts]);
    }
}
?>
