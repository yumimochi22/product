@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products/edit.css') }}">
@endsection

@section('content')
<div class="product-edit">
  <div class="product-edit__inner">

    <div class="breadcrumb">
        <a href="{{ route('products.index') }}">商品一覧</a>
        <span>></span>
        <span>{{ $product->name }}</span>
    </div>

    <form action="{{ route('products.update', $product->id) }}"
    method="post"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="product-edit__content">

    <!-- 商品画像 -->
     <div class="product-image">
        <img src="{{ asset('storage/' . $product->image) }}"
        alt="{{ $product->name }}">
        <input type="file"
        name="image"
        accept="image/*">
    </div>

    <!-- 商品詳細 -->
    <div class="product-info">

    <!-- 商品名 -->
    <div class="form-group">
        <label for="name">商品名</label>
        <input type="text"
        name="name"
        id="name"
        value="{{ old('name', $product->name) }}">
    </div>

    <!-- 価格 -->
    <div class="form-group">
        <label for="price">価格</label>
        <input type="number"
        name="price"
        id="price"
        value="{{ old('price', $product->price) }}">
    </div>

    <!-- 季節 -->
    <div class="form-group">
        <label>季節</label>
        <div class="season">
            @foreach ($seasons as $season)

            <label>
                <input type="checkbox"
                name="season[]"
                value="{{ $season->id }}"
                {{ $product->seasons->contains($season->id) ? 'checked' : '' }}>
                {{ $season->name }}</label>
            @endforeach
        </div>
    </div>
  </div>
</div>

<!-- 商品説明 -->
    <div class="form-group description">
        <label for="description">商品説明</label>

        <textarea name="description"
        id="description">{{ old('description', $product->description) }}</textarea>
    </div>

<!-- ボタン -->
    <div class="form-buttons">
        <a href="{{ route('products.index') }}"
        class="back-button">戻る</a>

        <button type="submit" class="save-button">変更を保存</button>
    </div>
    </form>

<!-- 削除ボタン -->
    <form action="{{ route('products.destroy', $product->id) }}"
    method="post"
    class="delete-form">
    @csrf
    @method('DELETE')
        <button type="submit" class="delete-button">🗑️</button>
    </form>
  </div>
</div>
@endsection