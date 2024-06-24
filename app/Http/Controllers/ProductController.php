<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Company;
use Exception;

class ProductController extends Controller
{
    // 商品編集画面
    public function edit(Product $product) {
        $company = Company::all();
        return view('product_edit',compact('product','company'));
    }

    // 商品詳細画面
    public function detail(Product $product) {
        $data = ['product' => $product];
        return view("product_detail", $data);
    }

    // 商品登録画面
    public function show() {
        $company = Company::all();
        return view('product_register',compact('company'));
    }

    // 商品の登録
    public function store(StoreProductRequest $request) {
        try {
            DB::beginTransaction();
            $validatedData = $request->validated();
            $company = Company::firstOrCreate(['company_name' => $validatedData['companyName']]);
            $product = new Product();
            $product->product_name = $validatedData['productName'];
            $product->price = $validatedData['price'];
            $product->stock = $validatedData['stock'];
            $product->comment = $validatedData['comment'];

            // error
            // if($product->price) {
            //     throw new Exception('Error message');
            // }

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $file_name = time() . '_' . $file->getClientOriginalName();
                $file->move(storage_path('app/public'), $file_name);
                $product->img_path = 'storage/' . $file_name;
            }
            $product->company()->associate($company);
            $product->save();
            DB::commit();
            return redirect()->route('product.register')->with('success', '登録できました');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Transaction failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to store product'], 500);
        }
    }

    // 商品の読み取り
    public function read($id) {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    // 商品情報の更新
    public function update(StoreProductRequest $request, Product $product) {
        try {
            DB::beginTransaction();
            $validatedData = $request->validated();
            $company = Company::firstOrCreate(['company_name' => $validatedData['companyName']]);
            $product->product_name = $validatedData['productName'];
            $product->price = $validatedData['price'];
            $product->stock = $validatedData['stock'];
            $product->comment = $validatedData['comment'];

            if ($request->has('companyName')) {
                $product->company()->associate($company);
            }

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $file_name = time() . '_' . $file->getClientOriginalName();
                $file->move(storage_path('app/public'), $file_name);
                $product->img_path = 'storage/' . $file_name;
            }

            // error
            // if ($product->price) {
            //     throw new Exception('Error message');
            // }

            $product->save();
            DB::commit();
            return redirect()->route('product.edit', $product)->with('success', '商品情報を更新しました');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Transaction failed: ' . $e->getMessage());
            return response()->json(['Error' => 'Failed to update product'], 500);
        }
    }

    // 商品の削除
    public function delete(Product $product) {
        try {
            DB::beginTransaction();
            $product -> delete();

            // error
            // if(!$product->is_Deleted) {
            //     throw new Exception('Error message');
            // }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Product deleted successfully.']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('ProductDeleteTransaction failed: ' . $e->getMessage());
            return response()->json(['error' => true, 'message' => 'Failed to delete product']); 
        }
    }

    // 商品の一覧
    public function index(Request $request) {
        $companies = Company::all();
        $query = Product::with('company')->sortable();
        // $products = Product::with('company')->sortable()->get();
        if ($request->has('company_name')) {
            $query->where('company_name', $request->input('company_name'));
        }
        
        $products = $query->get();
        $sortedPrices = Product::orderBy('price', 'desc')->pluck('price')->unique();
        $sortedStocks = Product::orderBy('stock', 'desc')->pluck('stock')->unique();
        return view(('product_list'), compact('products', 'companies', 'sortedPrices', 'sortedStocks'));
    }

    //商品の検索
    public function search(Request $request) {
        $companies = Company::all();
        $keyword = $request->input('search');
        $companyId = $request->input('companyId');
        $query = Product::with('company');

        Log::info('検索リクエスト', ['search' => $keyword, 'companyId' => $companyId]);

        // 検索キーワードがある場合
        if (!empty($keyword)) {
            $query->where('product_name', 'like', '%' . $keyword . '%')
                ->orWhereHas('company', function ($query) use ($keyword) {
                    $query->where('company_name', 'like', '%' . $keyword . '%');
            });
        }
        // 企業名セレクトで検索
        if (!empty($companyId) && $companyId != 0) {
            $query->where('company_id', $companyId);
        }

        // 価格で検索
        if ($request->has('priceSearch') && $request->priceSearch != 0) {
            $query->where('price', $request->priceSearch);
        }

        // 在庫数で検索
        if ($request->has('stockSearch') && $request->stockSearch != 0) {
            $query->where('stock', $request->stockSearch);
        }

        $products = $query->get();
        
        if ($request->ajax()) {
            return response()->json(['products' => $products]);
        }

        $sortedPrices = Product::orderBy('price', 'desc')->pluck('price')->unique();
        $sortedStocks = Product::orderBy('stock', 'desc')->pluck('stock')->unique();

        return view('product_list', compact('products', 'companies', 'sortedPrices', 'sortedStocks'));
    }
}
