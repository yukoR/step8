@extends('layouts.app')

@section('content')
    <h1>商品新規登録画面</h1>

    <form method="POST" action="{{ route('products.store', $product) }}">
        @csrf
        <label for="name">商品名:</label>
        <input type="text" id="name" name="name" value="{{ $product->name }}">
        <label for="company_name">メーカー名</label>
        <input type="text" id="company_name" name="company_name" value="{{ $Product->company->company_name}}">
        <label for="price">価格:</label>
        <input type="number" id="price" name="price" value="{{ $product->price }}">
        <label for="stock">在庫数:</label>
        <input type="number" id="stock" name="stock" value="{{ $product->stock }}">
        <label for="comment">説明:</label>
        <textarea id="comment" name="comment">{{ $product->comment }}</textarea>
        <button type="submit">登録</button>
    </form>
@endsection
