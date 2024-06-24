@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h1 class="title">商品一覧</h1>
            
            <div class="row mt-4 mb-4">
                <form id="search-form" class="row">
                    @csrf
                    <div class="col">
                        <input type="text" class="form-control" id="search-keyword" name="search" placeholder="検索キーワード" value="{{ request('search') }}">
                    </div>
                    <div class="col">
                        <select name="companyId" id="company-select" class="form-control">
                            <option value="0">企業を選択してください</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{$company->id}}, {{ $company->company_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select name="priceSearch" id="priceSearch" class="form-control">
                            <option value="0">価格</option>
                            @foreach ($sortedPrices as $price)
                                <option value="{{ $price }}">{{ $price }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col">
                        <select name="stockSearch" id="stockSearch" class="form-control">
                            <option value="0">在庫数</option>
                            @foreach ($sortedStocks as $stock)
                                <option value="{{ $stock }}">{{ $stock }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-secondary">検索</button>
                    </div>
                </form>
            </div>

            <div id="message"></div>
            <div class="card">
                <div class="card-body">
                    <div class="products" id="product-list">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <div class="">
                                        <th>@sortablelink('id', 'ID')</th>
                                        <th>@sortablelink('img_path', '商品画像')</th>
                                        <th>@sortablelink('product_name', '商品名')</th>
                                        <th>@sortablelink('company.company_name', 'メーカー名')</th>
                                        <th>@sortablelink('price', '価格')</th>
                                        <th>@sortablelink('stock', '在庫数')</th>
                                        <th>
                                            <button type="button" class="btn btn-primary text-nowrap" onclick="location.href='{{ route($register) }}'">新規登録</button>
                                        </th>
                                    </div>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr id="product-{{ $product->id }}">
                                        <td>{{ $product->id }}. </td>
                                        <td>
                                            @if($product->img_path)
                                                <img src="{{ asset($product->img_path) }}" alt="Product Image" class="img">
                                            @else
                                                <p>画像はありません</p>
                                            @endif
                                        </td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->company->company_name ?? 'N/A' }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-info btn-sm text-nowrap" onclick="location.href='{{ route($detail, $product) }}'">詳細</button>
                                                <button class="btn btn-danger delete-button btn-sm text-nowrap" id="btnDeleteButton" data-id="{{ $product->id }}"  >削除</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @if($products->isEmpty())
                                    <p>該当する商品がありませんyo。</p>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //検索機能
        $('#search-form').on('submit', function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            
            console.log('フォームが送信されました');
            $.ajax({
                url: "{{ route('search.products') }}",
                method: 'GET',
                data: formData,
                success: function(response) {
                    console.log('検索結果', response);
                    if (response.products && response.products.length > 0) {
                        updateProductList(response.products);
                    } else {
                        $('#product-table tbody').empty();
                        $('#product-table tbody').append('<tr><td colspan="">該当する商品がありません</td></tr>');
                    }
                    
                },
                error: function(xhr) {
                    console.log('エラー', xhr.responseText);
                }
            })
        })

        //削除機能
        $(document).on('click', '.delete-button', function() {
            var productId = $(this).data('id');

            if (confirm('本当に削除しますか？')) {
                $.ajax({
                    url: '/product/' + productId,
                    type: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                            alert('商品情報を削除しました。');
                            $('#product-' + productId).remove();
                            checkNoProducts();
                        } else {
                            alert('商品情報が削除できませんでした。');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#message').html('<div class="alert alert-danger">An error occurred: ' + error + '</div>');
                        // alert('An error occurred: エラー' + error);
                    }
                });
            }
        });

        // 商品リストの更新
        function updateProductList(products) {
            var tableBody = $('#product-list table tbody');
            tableBody.empty();
            if (products.length === 0) {
                tableBody.append('<tr><td colspan="7">該当する商品がありません。</td></tr>');
                return;
            }
            products.forEach(function(product) {
                var row = '<tr id="product-' + product.id +'">' +
                        '<td>' + product.id + '</td>' +
                        '<td>' + (product.img_path ? '<img src="' + product.img_path + '" alt="Product Image" class="img">' : '画像はありません') + '</td>' +
                        '<td>' + product.product_name + '</td>' +
                        '<td>' + (product.company ? product.company.company_name : 'N/A') + '</td>' +
                        '<td>' + product.price + '</td>' +
                        '<td>' + product.stock + '</td>' +
                        '<td><div class="d-flex justify-content-between">' +
                        '<button type="button" class="btn btn-info btn-sm text-nowrap" onclick="location.href=\'{{ url("/product_detail") }}/' + product.id + '\'">詳細</button>' +
                        '<button class="btn btn-danger delete-button btn-sm text-nowrap" data-id="' + product.id + '">削除</button>' +
                        '</div></td>' +
                        '</tr>';
                tableBody.append(row);
            });
        }

        // 商品がない場合
        function checkNoProducts() {
            if ($('#product-table tbody tr').length == 0) {
                $('#product-table tbody').append('<tr><td colspan="6">該当する商品がありません。</td></tr>');
            }
        }
        checkNoProducts();
    });
</script>
@endsection
