<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New "Tsundock"</title>
    <!-- フォント -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <style>
        .image-container {
            position: relative;
            width: 80%; /* 背景画像をさらに広げる */
            max-width: 1600px; /* 必要に応じて最大幅を設定 */
            margin: 0 auto;
        }

        .image-container img {
            width: 100%; /* 画像をコンテナの横幅いっぱいに広げる */
            height: auto;
        }


        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            color: black;
            max-width: 90%;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center; /* コンテンツを中央に配置 */
        }

        input[type="text"],
        select,
        textarea {
            width: 55vw; /* 画面幅の80%に設定 */
            max-width: 1400px; /* 最大幅を設定 */
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 2px solid #ccc;
            font-size: 18px;
            box-sizing: border-box;
        }


        input[type="submit"] {
            position: absolute;
            background-color: #00008B;
            color: white;
            padding: 1vw 2vw;
            border: none;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            font-size: 1vw;
            transition: background-color 0.3s ease;
            left: 80%; /* ボタンの位置を調整 (画像の右下付近) */
            top: 80%;  /* ボタンの位置を調整 (画像の下付近) */
            transform: translate(-50%, -50%); /* 中央揃え調整 */
        }

        input[type="submit"]:hover {
            background-color: #000066;
        }

        .back a {
            color: blue;
            text-decoration: none;
        }
    </style>
    <script>
        window.addEventListener('resize', adjustButtonPosition);
        window.addEventListener('load', adjustButtonPosition);

        function adjustButtonPosition() {
            const imageContainer = document.querySelector('.image-container');
            const submitButton = document.querySelector('input[type="submit"]');

            if (imageContainer && submitButton) {
                const rect = imageContainer.getBoundingClientRect();
                const buttonWidth = submitButton.offsetWidth;
                const buttonHeight = submitButton.offsetHeight;

                // モニターサイズに関係なく、画像の特定の位置にボタンを配置
                const leftPosition = rect.width * 0.7; // 画像の幅の85%の位置に配置
                const topPosition = rect.height * 0.45; // 画像の高さの85%の位置に配置

                submitButton.style.left = `${leftPosition}px`;
                submitButton.style.top = `${topPosition}px`;
            }
        }
    </script>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New "Tsundock"') }}
            </h2>
        </x-slot>

        <div class="image-container">
            <img src="{{ asset('images/detail.png') }}" alt="Detail Image">
            <div class="content">
                <form action="/posts" method="POST">
                    @csrf
                    <div class="title">
                        <h2>Title</h2>
                        <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                        <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
                    </div>
                    <div class="category">
                        <h2>Category</h2>
                        <select name="post[category_id]">
                            <option value="">（必須）カテゴリーを選択</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <p class="category__error" style="color:red">{{ $errors->first('post.category_id') }}</p>
                    </div>
                    <div class="body">
                        <h2>About</h2>
                        <textarea name="post[body]" placeholder="ex.)表示のイラストがとても魅力的。">{{ old('post.body') }}</textarea>
                        <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
                        <input type="submit" value="Tsundock"/>
                    </div>
                </form>
                <div class="back">[<a href="/">戻る</a>]</div>
                <form action="/posts" method="POST">

                </form>
            </div>
        </div>

    </x-app-layout>
</body>
</html>
