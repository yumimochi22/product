@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products/show.css') }}">
@endsection

@section('content')
    <div class="product-detail">
        <div class="product-detail__inner">

         <div class="breadcrumb">
            <a href="{{ route('products.index') }}">商品一覧</a>
            <span>></span>
            <span>{{ $product->name }}</span>
        </div>
        
        <!-- 商品画像・情報 -->
        <div class="product-detail__content">

        <!-- 商品画像 -->
        <div class="product-image">
            <img src="{{ asset('images/' . $product->image) }}"
            alt="{{ $product->name }}">
        </div>

        <!-- 商品情報 -->
        <div class="product-info">

        <!-- 商品名 -->
        <div class="form-group">
            <label>商品名</label>
            <p>{{ $product->name }}</p>
        </div>

        <!-- 価格 -->
        <div class="form-group">
            <label>価格</label>
            <p>¥{{ number_format($product->price) }}</p>
        </div>

        </div>
    </div>
    
    </div>
</div>
@endsection