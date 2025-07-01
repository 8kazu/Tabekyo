<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>編集画面</title>
    <!-- フォント -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <style>
        .image-container {
            position: relative;
            width: 80vw;
            max-width: 1200px;
            margin: 0 auto;
        }

        .image-container img {
            width: 100%;
            height: auto;
        }

        .content {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 2vw;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            color: black;
            max-width: 90vw;
            text-align: center;
        }

        .title-header {
    position: absolute; 
    top: 80px; /* 少し下に配置して調整 */
    left: 50%;
    transform: translateX(-50%);
    font-size: 20px; 
    margin-bottom: 10px; 
    text-align: center;
}

.about-header {
    position: absolute;
    left: 50%; 
    transform: translateX(-50%);
    font-size: 18px;
    text-align: center;
}


textarea {
    width: 60vw;
    max-width: 1000px;
    padding: 1.5vw;
    margin-bottom: 2vw;
    border-radius: 8px;
    border: 2px solid #ccc;
    font-size: 1.8vw;
    word-wrap: break-word;
    height: 200px;
    overflow-y: auto;
    resize: vertical;
}

input[type="text1"] {
    width: 60vw;
    max-width: 1000px;
    padding: 1.5vw;
    margin-bottom: 2vw;
    border-radius: 8px;
    border: 2px solid #ccc;
    font-size: 1.8vw;
    word-wrap: break-word;
}


        .save-button {
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
        }

        .save-button:hover {
            background-color: #000066;
        }

    </style>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit') }}
            </h2>
        </x-slot>

        <div class="image-container">
            <img src="{{ asset('images/detail.png') }}" alt="Detail Image">
            <div class="content">
                <form id="postForm" action="/posts/{{ $post->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class='content__title'>
                        <h2 class="title-header">About the Book</h2>
                        <input type='text1' name='post[title]' value="{{ $post->title }}">
                    </div>
                    <div class='content__body'>
                        <h2 class="about-header"></h2>
                        <textarea name='post[body]'>{{ $post->body }}</textarea>
                    </div>
                </form>
            </div>
            <input type="submit" form="postForm" value="保存" class="save-button">
        </div>



    </x-app-layout>

    <script>
    function adjustEditElements() {
        const imageContainer = document.querySelector('.image-container');
        const titleInput = document.querySelector('input[type="text1"]');
        const bodyTextarea = document.querySelector('textarea');
        const submitButton = document.querySelector('.save-button');

        const imageWidth = imageContainer.offsetWidth;

        // 個別にタイトルと説明文の位置を調整
        const titleHeader = document.querySelector('.title-header');
        const aboutHeader = document.querySelector('.about-header');

        // Title のフォントサイズと位置
        titleHeader.style.fontSize = `${Math.min(imageWidth * 0.04, 20)}px`;

        // 入力欄の幅を画像のサイズに合わせて調整
        const adjustedWidth = Math.min(imageWidth * 0.6, 1000);
        titleInput.style.width = `${adjustedWidth}px`;
        bodyTextarea.style.width = `${adjustedWidth}px`;

        // タイトルの入力欄と本文の入力欄の位置からAboutの位置を動的に計算
        const titleRect = titleInput.getBoundingClientRect();
        const bodyRect = bodyTextarea.getBoundingClientRect();
        const containerRect = imageContainer.getBoundingClientRect();

        // タイトルの入力欄と本文の入力欄の間の中央に「About」を配置
        const aboutTop = (titleRect.bottom + bodyRect.top) / 2.4 - containerRect.top;

        aboutHeader.style.position = 'absolute';
        aboutHeader.style.top = `${aboutTop}px`;

        // 入力欄の位置調整（少し下に配置）
        titleInput.style.position = 'relative';
        titleInput.style.top = '80px'; 
        bodyTextarea.style.position = 'relative';
        bodyTextarea.style.top = '80px';

        // 保存ボタンの位置を画像に基づいて調整
        submitButton.style.top = `${imageContainer.offsetHeight * 0.8}px`;
        submitButton.style.left = `${imageContainer.offsetWidth * 0.8}px`;
    }

    window.addEventListener('load', adjustEditElements);
    window.addEventListener('resize', adjustEditElements);
</script>


</body>
</html>
