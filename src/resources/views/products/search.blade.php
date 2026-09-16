@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products/search.css') }}">
@endsection

@section('content')
    <div class="search-result">
        <div class="search-result__inner">

        <!-- タイトル -->
         <h2 class="search-result__title">
            "{{ request('keyword') }}"の商品一覧</h2>

            <div class="search-result__body">

            <!-- 検索フォーム -->
            <aside class="search">
                <form action="{{ route('products.search') }}" method="get">

                <!-- 商品名検索 -->
                <div class="search__name">
                    <input type="text"
                    name="keyword"
                    value="{{ request('keyword') }}"
                    placeholder="商品名で検索">

                    <button type="submit">検索</button>
                </div>

                <!-- 価格順 -->
                <div class="search_price">
                    <label for="price">価格順で表示</label>
                    <select name="price"
                    id="price"
                    onchange="this.form.submit()">

                    <option value="">価格で並べ替え</option>
                    
                    <option value="asc" {{ request('price') == 'asc' ? 'selected' : '' }}>
                        安い順</option>
                    
                    <option value="asc" {{ request('price') == 'asc' ? 'selected' : '' }}>
                        高い順</option>
                    </select>
                </div>
                </form>
            </aside>

            <!-- 検索結果 -->
            <div class="search-result__right">
                <div class="products__list">
                    @foreach ($products as product)
                    <a href="{{ route('products.show', $product->id) }}"
                    class="product-card">

                    <!-- 商品画像 -->
                    <div class="product-card__image">
                        <img src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}">
                    </div>

                    <!-- 商品名・価格 -->
                    <div class="product-card__info">
                        <span class="product-card__name">
                            {{ $product->name }}</span>
                    </div>
                    </a>
                    @endforeach         
                </div>

                <!-- 検索結果がない場合 -->
                @if ($products->isEmpty())
                    <p class="no-result">
                        該当する商品がありません</p>
                @endif

                <!-- ページネーション -->
                <div class="pagination">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection