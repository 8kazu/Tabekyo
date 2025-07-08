@extends('layouts.app')

@section('title', 'メニューアップロード')

@section('content')
    <h2>メニュー表をアップロード（OCR処理）</h2>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <form action="{{ url('/api/menu/upload') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="shop_id">店舗ID：</label>
            <input type="number" name="shop_id" required>
        </div>

        <div>
            <label for="image">メニュー画像：</label>
            <input type="file" name="image" accept="image/*" required>
        </div>

        <div style="margin-top: 15px;">
            <button type="submit">アップロード</button>
        </div>
    </form>
@endsection
