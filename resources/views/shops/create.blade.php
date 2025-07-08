@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">店舗を登録</h2>

    <form action="{{ route('shops.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium">店舗名</label>
            <input type="text" name="name" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">GoogleマップのURL</label>
            <input type="text" name="map_url" class="w-full border rounded p-2" placeholder="https://www.google.com/maps?q=35.6895,139.6917" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            登録する
        </button>
    </form>

    <a href="{{ route('index') }}" class="inline-block mt-4 text-blue-600 hover:underline">← 一覧に戻る</a>
</div>
@endsection
