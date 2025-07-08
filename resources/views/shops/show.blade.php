@extends('layouts.app')

@section('title', $shop->name)

@section('content')
    <h2>{{ $shop->name }}</h2>
    <p>位置情報: 緯度 {{ $shop->latitude }}, 経度 {{ $shop->longitude }}</p>

    <h3>登録された料理一覧</h3>
    <ul>
        @forelse($shop->items as $item)
            <li>
                <strong>{{ $item->name }}</strong> - ¥{{ $item->price }}
                @if($item->image_path)
                    <br><img src="{{ $item->image_path }}" width="150">
                @endif
            </li>
        @empty
            <p>料理が登録されていません。</p>
        @endforelse
    </ul>

    <h3>OCRで抽出されたメニュー</h3>
    <ul>
        @forelse($shop->menuItems as $menu)
            <li>{{ $menu->name }} - ¥{{ $menu->price ?? '価格不明' }}</li>
        @empty
            <p>OCRメニューが登録されていません。</p>
        @endforelse
    </ul>
@endsection
