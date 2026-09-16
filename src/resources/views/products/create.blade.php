@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/products/create.css') }}">
@endsection

@section('content')
    
<div class="product-create">
    <div class="product-create__inner">

    <h2 class="product-create__title">商品登録</h2>

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <div class="form-group">
            <label for="name">商品名
            <span class="required">必須</span>
            </label>
            <input type="text"
            name="name"
            id="name"
            placeholder="商品名を入力"
            value="{{ old('name') }}">

            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!--価格-->
        <div class="form-group">
            <label for="price">価格
                <span class="required">必須</span>
            </label>
            <input type="number"
            name="price"
            id="price"
            placeholder="価格を入力"
            value="{{ old('price') }}">

            @error('price')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!--商品画像-->
        <div class="form-group">
            <label for="image">商品画像
                <span class="required">必須</span>
            </label>
            <input type="file"
            name="image"
            id="image"
            accept=".png,.jpeg">

            @error('image')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!--季節-->
        <div class="form-group">
            <label>季節
                <span class="required">必須</span>
                <span class="multiple">複数選択可</span>
            </label>

            <div class="season-list">
                @foreach ($seasons as $season)
                    <label class="season-item">
                        <input type="checkbox"
                            name="season[]"
                            value="{{ $season->id }}"
                            {{ in_array($season->id, old('season', [])) ? 'checked' : '' }}>
                        <span>{{ $season->name }}</span>
                    </label>
                @endforeach
            </div>

            @error('season')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!--商品説明-->
        <div class="form-group">
            <label for="description">商品説明
                <span class="required">必須</span>
            </label>
            <textarea name="description"
            id="description"
            placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- 登録ボタン -->
         <div class="form-buttons">
            <a href="{{ route('products.index') }}" class="back-button">戻る</a>

            <button type="submit" class="submit-button">登録</button>
        </div>
    </form>
    </div>
</div>


@endsection