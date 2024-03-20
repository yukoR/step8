@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h1 class="title">商品一覧</h1>
            @include('search_form')
            <div class="card">
                <div class="card-body">
                    <div class="products">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <div class="">
                                        <th>ID</th>
                                        <th>商品画像</th>
                                        <th>商品名</th>
                                        <th>メーカー名</th>
                                        <th>価格</th>
                                        <th>在庫数</th>
                                        <th>
                                            <button type="button" class="btn btn-primary text-nowrap" onclick="location.href='{{ route($register) }}'">新規登録</button>
                                        </th>
                                    </div>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}. </td>
                                        <td>
                                            @if($product->img_path)
                                                <img src="{{ asset('storage/' . $product->img_path) }}" alt="Product Image" class="img">
                                            @else
                                                <p>画像はありません</p>
                                            @endif
                                        </td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->company->company_name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-info btn-sm text-nowrap" onclick="location.href='{{ route($detail, $product) }}'">詳細</button>
                                                @include('delete_form')
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
