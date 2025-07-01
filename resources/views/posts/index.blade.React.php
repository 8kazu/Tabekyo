<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.jsx']) <!-- PostIndex.jsxは指定しない -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> <!-- フォントの追加 -->
</head>
<body>
    <div id="app"></div> <!-- Reactのターゲット -->

    @inertia('posts.index', ['posts' => $posts]) <!-- ここでpostsを渡す -->
    
    <script>
        function deletePost(id) {
            'use strict'
            if (confirm('削除すると復元できません。\n本当に削除しますか?')) {
                document.getElementById(`form_${id}`).submit(); // 削除フォームを送信
            }
        }
    </script>
</body>
</html>
