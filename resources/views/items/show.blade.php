@extends('layouts.app')

@section('title', $item->name)

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    {{-- 商品情報 --}}
    <h2 class="text-2xl font-bold mb-4">{{ $item->name }}</h2>

    @if ($item->image_path)
        <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}" class="w-full h-64 object-cover rounded mb-4">
    @endif

    <p class="text-lg mb-6">価格：<span class="font-semibold">¥{{ $item->price }}</span></p>

    {{-- 店舗情報 --}}
    <div class="mb-6">
        <h3 class="text-xl font-semibold mb-2">店舗情報</h3>

        @if ($item->shop)
            <p class="mb-1">店名：{{ $item->shop->name }}</p>

            {{-- Google Mapリンク --}}
            <a
                href="https://www.google.com/maps?q={{ $item->shop->latitude }},{{ $item->shop->longitude }}"
                class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                target="_blank"
            >
                📍 Googleマップで店舗を見る
            </a>
        @else
            <p class="text-red-500">店舗情報が見つかりません。</p>
        @endif
    </div>

    <a href="{{ route('index') }}" class="inline-block mt-4 text-blue-600 hover:underline">← 一覧に戻る</a>
</div>
@endsection
