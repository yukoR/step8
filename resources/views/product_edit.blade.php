@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h1 class="title">商品情報編集</h1>
            <div class="card">
                <div class="">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('product.update', $product) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <p><span id="idAsterisk">*</span>は必須入力項目です。</p>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>ID:</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p class="" id="idProductId" name="productId" value="">{{ old('id', $product->id) }}</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="txtProductName" class="required">商品名</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="txtProductName" name="productName" value="{{ old('productName', $product->product_name) }}">
                                            @error('productName')
                                                <div class="text-red-500">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="txtCompanyName" class="required">メーカー名</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="txtCompanyName" name="companyName" value="{{ old('companyName', $product->company->company_name )}}">
                                            @error('companyName')
                                                <div class="text-red-500">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="txtPrice" class="required">価格</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="txtPrice" name="price" value="{{ old('price', $product->price) }}">
                                            @error('price')
                                                <div class="text-red-500">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="txtStock" class="required">在庫数</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="txtStock" name="stock" value="{{ old('stock', $product->stock) }}">    
                                            @error('stock')
                                                <div class="text-red-500">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="form-group mt-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="areaComment">説明:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea class="form-control" id="areaComment" name="comment">{{ old('comment', $product->comment) }}</textarea>
                                            @error('comment')
                                                <div class="text-red-500">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 mt-2">
                                <div class="form-group mt-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="fileImage">商品画像:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="col-md-8">
                                                <input type="file" id="fileImage" name="image" accept="image/png, image/jpeg">
                                                @error('image')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>             
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-6 mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">更新</button>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="location.href='{{ route($detail, $product) }}'">商品情報へ戻る</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
