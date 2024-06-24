<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        // バリデーションの実行
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
        ]);

        $product = Product::find($request->product_id);

        if ($product->stock <= 0) {
            return response()->json(['error' => '在庫が足りません'], 400);
        }

        try {
            DB::transaction(function () use ($product) {
                Sale::create(['product_id' => $product->id]);
                $product->decrement('stock');
                Log::info('sale created for product ID: ' . $product->id);
            });
            return response()->json(['message' => 'Purchase successful'], 200);
        } catch (\Exception $e) {
            Log::error('transaction failed: ' . $e->getMessage());
            return response()->json(['error' => 'purchase failed']);
        }
    }
}
