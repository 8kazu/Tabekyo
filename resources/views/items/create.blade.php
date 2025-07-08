@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">商品を登録</h2>

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-medium">商品名</label>
            <input type="text" name="name" class="w-full border rounded p-2" value="{{ old('name') }}">
        </div>

        <div class="mb-4">
            <label class="block font-medium">価格（円）</label>
            <input type="number" name="price" class="w-full border rounded p-2" value="{{ old('price') }}">
        </div>

        <div class="mb-4">
            <label class="block font-medium">画像</label>
            <input type="file" name="image" class="w-full">
        </div>

        <div class="mb-4">
            <label class="block font-medium">店舗</label>
            <select name="shop_id" class="w-full border rounded p-2">
                @foreach ($shops as $shop)
                    <option value="{{ $shop->id }}">{{ $shop->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            登録する
        </button>
    </form>
</div>
@endsection
