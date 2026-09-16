@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products/index.css') }}">
@endsection

@section('content')
    <div class="products">
        <div class="products__inner">

            <div class="products__header">
                <h2 class="products__title">商品一覧</h2>
                <a href="{{ route('products.create') }}" class="add-button">+ 商品を追加</a>
            </div>

            <div class="products__body">

                <!-- 検索 -->
                <aside class="search">
                    <form action="{{ route('products.search') }}" method="get">

                        <!-- 商品名検索 -->
                        <div class="search__name">
                            <input type="text" name="keyword" value="{{ request('keyword') }}"
                            placeholder="商品名で検索">
                            
                            <button type="submit">検索</button>
                        </div>

                        <!-- 価格順 -->
                        <div class="search__price">
                            <label for="price">価格順で表示</label>

                            <select name="price" id="price" onchange="this.form.submit()">
                                <option value="asc"
                                {{request('price') == 'asc' ? 'selected' : '' }}>安い順</option>

                                <option value="desc"
                                {{ request('price') == 'desc' ? 'selected' : '' }}>高い順</option>
                            </select>
                        </div>
                    </form>
                </aside>
                        <!-- 商品一覧 -->
                        <div class="products__right">

                            <div class="products__list">
                                @foreach ($products as $product)
                                    <a href="{{ route('products.show', $product->id) }}"
                                    class="product-card">

                                    <!-- 商品画像 -->
                                    <div class="product-card__image">
                                        <img src="{{ asset('images/' . $product->image) }}"
                                             alt="{{ $product->name }}">
                                    </div>
                                
                                    <!-- 商品情報 -->
                                    <div class="product-card__info">
                                        <span class="product-card__name">
                                            {{ $product->name }}</span>

                                        <span class="product-card__price">
                                            ¥{{number_format($product->price) }}</span>
                                    </div>
                                    </a>
                                @endforeach
                            </div>

                            <!-- ページネーション -->
                            <div class="pagination">
                                {{ $products->links() }}
                            </div>
                        </div>
@endsection