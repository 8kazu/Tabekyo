@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">商品一覧</h1>
        <a href="{{ route('items.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            ＋ 商品を登録する
        </a>
    </div>

    @foreach ($items as $item)
        <div class="mb-4 p-4 border rounded bg-white">
            <a href="{{ route('items.detail', ['item' => $item->id]) }}" class="block">
                <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}" class="w-full h-40 object-cover rounded">
                <h2 class="text-lg font-semibold mt-2">{{ $item->name }}</h2>
            </a>
            <p>価格: {{ $item->price }}円</p>
        </div>
    @endforeach
@endsection
