@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h1 class="title">商品一覧</h1>
            
            <div class="row mt-4 mb-4">
                <form action="{{ route('search') }}" method="post" class="row">
                    @csrf
                    <div class="col">
                        <input type="text" class="form-control" name="search" placeholder="検索キーワード" value="{{ request('search') }}">
                    </div>
                    <div class="col">
                        <select name="companyId" class="form-control">
                            <option value="0">企業を選択してください</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-secondary">検索</button>
                    </div>
                </form>
            </div>

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
                                                <img src="{{ asset($product->img_path) }}" alt="Product Image" class="img">
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
                                                <form action="{{ route('product.destroy', $product) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm text-nowrap" id="btnDeleteButton" onclick="return confirm('本当に削除しますか')">削除</button>
                                                </form>
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
