<?php

namespace App\Http\Controllers;
use App\Models\Post; 
//use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use Inertia\Inertia;

//class PostController extends Controller
//{
    //
//}

//use宣言は外部にあるクラスをPostController内にインポートできる。 //この場合、App\Models内のPostクラスをインポートしている。
//use App\Models\Post;
/**
* Post一覧を表示する
*
* @param Post Postモデル
* @return array Postモデルリスト */
//public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
//{
//	return $post->get();//$postの中身を戻り値にする。
//}


class PostController extends Controller
{
    public function index(Post $post)
    {
	    //APIを使うとき
	// クライアントインスタンス生成
        //$client = new \GuzzleHttp\Client();
        // タグ一覧を取得するURL
        //$url = 'https://teratail.com/api/v1/tags';
        // リクエスト送信と返却データの取得
        //$response = $client->request(
        //    'GET',
        //    $url,
        //    [
        //        'headers' => [
        //            'Authorization' => 'Bearer ' . config('services.teratail.token')
        //        ]
        //    ]
        //);
        // API通信で取得したデータはjson形式なので
        // PHPファイルに対応した連想配列にデコードする
        //$tags = json_decode($response->getBody(), true);

        // index bladeに取得したデータを渡す
        //return view('posts.index')->with([
        //    'posts' => $post->getPaginateByLimit(),
        //    'tags' => $tags['tags'] ?? [], // 'tags'キーが存在しない場合に備えて
	//]);

	    
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]); //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
	//getPaginateByLimit()はPost.phpで定義したメソッド
    }


    // public function index(Post $post)
    // {
    //     $posts = $post->getPaginateByLimit();
    
    //     return Inertia::render('PostIndex', [
    //         'posts' => $posts,
    //     ]);
    // }
    
    /**
    * 特定IDのpostを表示する
    *
    * @params Object Post // 引数の$postはid=1のPostインスタンス * @return Reposnse post view
    */
    public function show(Post $post)
    {
	return view('posts.show')->with(['post' => $post]); //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }
    // ブログ投稿作成画面表示用の部分
    public function create(Category $category)
    {
	return view('posts.create')->with(['categories' => $category->get()]);
    }

    // ブログ投稿作成処理用の部分
    //public function store(Request $request, Post $post)
    //{
    //	$input = $request['post'];
    //	$post->fill($input)->save();
    //	return redirect('/posts/' . $post->id);
    //}
    public function store(Post $post, PostRequest $request) // 引数をRequestからPostRequestにする {
    {    
	    $input = $request['post'];

	    //（未完成）カテゴリーIDが空でも保存できるようにしたい、そのうち
	    //カテゴリーIDが空の場合はnullを設定
    	    if (empty($input['category_id'])) {
        	$input['category_id'] = null;
    	    }

	    // fillメソッドを使用して入力値をセット
	    $post->fill($input);
	    $post->save();
	   
	    return redirect('/posts/' . $post->id);
    }

    //ブログの編集画面表示用の部分
    public function edit(Post $post)
    {
	    return view('posts.edit')->with(['post' => $post]);
    }
    
    //編集されたものをアップデート
    public function update(PostRequest $request, Post $post)
    {
	    $input_post = $request['post'];
	    $post->fill($input_post)->save();
	    return redirect('/posts/' . $post->id);
    }
    //投稿削除実行用
    public function delete(Post $post)
    {
	    $post->delete();
	    return redirect('/');
    }
}
?>
