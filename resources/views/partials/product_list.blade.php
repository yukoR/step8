
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
            <tr id="product-{{ $product->id }}s">
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
