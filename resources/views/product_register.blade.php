@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <h1 class="title">商品新規登録画面</h1>
            <div class="card">
                <div class="">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <p><span id="idAsterisk">*</span>は必須入力項目です。</p>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="txtProductName" class="required">商品名</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="txtProductName" name="productName" value="{{ old('productName') }}">
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
                                            <input type="text" class="form-control" id="txtCompanyName" name="companyName" value="{{ old('companyName') }}">
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
                                            <input type="text" class="form-control" id="txtPrice" name="price" value="{{ old('price') }}">
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
                                            <input type="text" class="form-control" id="txtStock" name="stock" value="{{ old('stock') }}">
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
                                            <textarea class="form-control" id="areaComment" name="comment">{{ old('comment') }}</textarea>
                                            @error('comment')
                                                <div class="text-red-500">{{ $message }}</div>
                                            @enderror
                                        </div>
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
                                            <input type="file" class="form-control-file" id="fileImage" name="image" accept="image/png, image/jpeg" value="">
                                            @error('image')
                                                <div class="text-red-500">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-6 mt-3">
                                <button type="submit" class="btn btn-primary btn-sm">新規登録</button>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="location.href='{{ route($list) }}'">商品一覧へ戻る</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
