@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h1 class="title">商品一覧</h1>
            
            <div class="row mt-4 mb-4">
                <form action="{{ route('search') }}" id="search-form" class="row">
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
                    <div class="col-auto">
                        <button type="submit" class="btn btn-secondary">検索</button>
                    </div>
                </form>
            </div>

            <div id="message"></div>
            <div class="card">
                <div class="card-body">
                    <div class="products" id="product-list">
                        @include('partials.product_list', ['products' => $products])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        //検索機能
        $('#search-form').on('submit', function(event) {
            event.preventDefault();
            console.log('フォームが送信されました');
            $.ajax({
                url: "{{ route('search.products') }}",
                method: 'GET',
                data: {
                    search: $('#search-keyword').val(),
                    companyId: $('#company-select').val()
                },
                success: function(response) {
                    console.log('検索結果', response);
                    $('#product-list').html(response);
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
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('商品情報を削除しました。');
                            refreshProductList();

                        } else {
                            alert('Failed to delete product.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: エラーなの？' + error);
                    }
                });
            }
        });

        //Refresh Product_list
        function refreshProductList() {
            $.ajax({
                url: "{{ route('partials.product_list') }}",
                type: 'GET',
                success: function(response) {
                    $('#product-list').html(response);
                    if ($('#product-table tr').length == 0) {
                        $('#no-products-message').show();
                    } else {
                        $('#no-products-message').hide();
                    }
                },
                error: function(xhr, status, error) {
                    $('#message').html('<div class="alert alert-danger">An error occurred: エラなの？' + error + '</div>');
                }
            });
        }
        if ($('#product-table tr').length == 0) {
            $('#no-products-message').show();
        }
    });
</script>
@endsection
