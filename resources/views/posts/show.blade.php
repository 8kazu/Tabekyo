<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posts</title>
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
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 2vw;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            color: black;
            max-width: 90vw;
            text-align: center;
        }

        .title {
            font-size: 35px;
            font-weight: bold;
            margin-top: -30px;
        }

        .category {
            margin-bottom: ;
            display: inline-block;
            font-size: 18px;
            color: #00008B;
        }

        .content__post {
            margin-top: ;
            text-align: left;
            width: 48vw;
            max-width: 1000px;
            padding: 1.5vw;
            margin-bottom: 2vw;
            margin-left: auto;
            margin-right: auto;
        }

        .edit a {
            background-color: #00008B;
            color: white;
            padding: 1vw 2vw;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .edit a:hover {
            text-decoration: underline;
        }

        .footer {
            background-color: #00008B;
            color: white;
            padding: 1vw 2vw;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .footer:hover {
            background-color: #000066;
        }
    </style>
</head>
<script>
    function adjustEditElements() {
        const imageContainer = document.querySelector('.image-container');
        const editButton = document.querySelector('.edit');
        const backButton = document.querySelector('.footer');

        const imageWidth = imageContainer.offsetWidth;
        const imageHeight = imageContainer.offsetHeight;

        // Adjust the position of the Edit button dynamically
        editButton.style.position = 'absolute';
        editButton.style.top = `${imageHeight * 0.8}px`;
        editButton.style.left = `${imageWidth * 0.9}px`;

        // Adjust the Back button position similarly to the Save button on the edit screen
        backButton.style.position = 'absolute';
        backButton.style.top = `${imageHeight * 0.95}px`;
        backButton.style.left = `${imageWidth * 0.9}px`;
    }

    window.addEventListener('load', adjustEditElements);
    window.addEventListener('resize', adjustEditElements);
</script>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Book') }}
            </h2>
        </x-slot>

        <div class="image-container">
            <img src="{{ asset('images/detail.png') }}" alt="Detail Image">
            <div class="content">
                <h1 class="title">
                    {{ $post->title }}
                </h1>
                <a href="/categories/{{ $post->category->id }}" class="category">{{ $post->category->name }}</a>
                <div class="content__post">
                    <p>{{ $post->body }}</p>
                </div>

                
            </div>
        </div>
        <div class="edit">
            <a href="/posts/{{ $post->id }}/edit">Edit</a>
        </div>

        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </x-app-layout>
</body>
</html>
