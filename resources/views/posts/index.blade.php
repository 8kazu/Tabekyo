<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <!-- フォント -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- CSSファイルのリンク -->
    <link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">
    
    <!-- インラインCSSで背景画像を設定 -->
    <style>
    .create-button {
        display: inline-block; /* ボタンスタイルを適用するためにブロックに変更 */
        margin-top: 10px; /* ヘッダーからの余白を設定 */
        padding: 10px 20px; /* ボタンのパディングを調整 */
        background-color: #007bff; /* ボタンの背景色 */
        color: #fff; /* テキストの色 */
        text-decoration: none; /* 下線を削除 */
        border-radius: 5px; /* 角を丸くする */
        cursor: pointer; /* ポインタカーソルを表示 */
    }


    .posts {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
    }

    .post {
        position: relative;
        background-image: url('{{ asset('images/background.png') }}');
        background-size: contain; /* 背景画像を画面に合わせる */
        background-position: center;
        background-repeat: no-repeat;
        border-radius: 8px;
        margin-top: -70px;
        margin-bottom: -30px;
        width: 100%; /* JavaScriptでサイズを調整 */
        max-width: 80vw;
        height: auto;
        min-width: 300px;
        overflow: hidden;
    }

    .title {
        position: absolute;
        top: 35%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 2;
        color: #000;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .category {
        position: absolute;
        top: 47%;
        left: 7%;
        z-index: 2;
        color: #fff;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 5px 10px;
        border-radius: 5px;
    }

    .post button {
        position: absolute; /* 背景画像上に絶対配置 */
        top: 55%;  /* ボタンを背景画像の上部に配置 */
        right: 5%; 
        z-index: 2; /* 背景画像より前に表示 */
        background: none; /* 背景色をなしに */
        color: #f00; /* テキストの色を赤に */
        border: none; /* 枠線をなしに */
        cursor: pointer; /* ポインタカーソルを表示 */
        font-size: 14px; /* テキストサイズを調整 */
        padding: 0; /* 余分なスペースを取り除く */
    }



</style>

</head>
<script>
    function adjustElements() {
        const posts = document.querySelectorAll('.post');
        
        posts.forEach(post => {
            const screenWidth = window.screen.width;
            const screenHeight = window.screen.height;

            // 背景画像のサイズを画面サイズに応じて変更
            const width = Math.min(screenWidth * 0.8, 600); // 画面幅の80%または600pxの小さい方
            const height = width * 0.5625; // 縦横比16:9を維持する
            
            post.style.width = `${width}px`;
            post.style.height = `${height}px`;
            
            // フォントサイズを背景画像のサイズに基づいて調整
            const title = post.querySelector('.title');
            const category = post.querySelector('.category');
            const button = post.querySelector('button');
            
            const fontSize = width * 0.04; // 背景画像の幅に基づくフォントサイズ
            title.style.fontSize = `${fontSize}px`;
            category.style.fontSize = `${fontSize * 0.7}px`;

            // ボタンの位置も動的に設定
            button.style.bottom = `${height * 0.05}px`;
            button.style.right = `${width * 0.05}px`;
        });
    }

    // ページ読み込み時とリサイズ時に調整
    window.onload = adjustElements;
    window.onresize = adjustElements;
</script>


<body>
    <x-app-layout>
        <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tsundock') }} 
        </h2>
        <div class="user-info">
            <span>Welcome, {{ Auth::user()->name }}</span>
        </div>
        <!-- ボタンをヘッダーの直下に移動 -->
        <a href='/posts/create' class="create-button">Create "Tsundock"</a>
    </x-slot>


        <div class='posts'>
            @foreach ($posts as $post)
                <div class='post'>
                    <h2 class='title'>
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h2>
                    <div class="post-content">
                        <a class="category" href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                    </div>
                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class='paginate'>
            {{ $posts->links() }}
        </div>

        <script>
            function deletePost(id) {
                'use strict'
                if (confirm('削除すると復元できません。\n本当に削除しますか?')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </x-app-layout>
</body>
</html>
