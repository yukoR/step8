@extends('layouts.app')

@section('content')

<div class="container product-detail-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="title product-detail-title">商品情報詳細</h1>
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-5">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">ID:</th>
                                        <td>{{ $product->id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">商品画像: </th>
                                        @if(!$product->img_path)
                                            <td>No Image</td>
                                        @else
                                            <td><img src="{{ asset('storage/' . $product->img_path) }}" class="img-thumbnail detail-image" alt="Product Image"></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th scope="row">商品名:</th>
                                        <td>{{ $product->product_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">メーカー名:</th>
                                        <td>{{ $product->company->company_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">価格:</th>
                                        <td>{{ $product->price }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">在庫数:</th>
                                        <td>{{ $product->stock }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">商品説明:</th>
                                        <td>{{ $product->comment }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="product-detail__button col-mt-6">
                                <button type="button" class="btn btn-primary btn-sm" onclick="location.href='{{ route($edit, $product) }}'">編集</button>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="location.href='{{ route($list) }}'">商品一覧へ戻る</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
