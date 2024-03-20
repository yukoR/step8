<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent;
use App\Models\Product;
use App\Models\Company;

class SearchFormController extends Controller
{
    public function search(Request $request) {
        $companies = Company::all();
        $keyword = $request->input('search');
        $companyId = $request->input('companyId');
        $query = Product::query();

        // 検索キーワードがある場合
        if (!empty($keyword)) {
            $query->where('product_name', 'like', '%' . $keyword . '%');
        }
        if (!empty($keyword)) {
            $query->orWhereHas('company', function ($query) use ($keyword) {
                $query->where('company_name', 'like', '%' . $keyword . '%');
            });
        }
        // 企業名セレクトで検索
        if (!empty($companyId)) {
            $query->where('company_id', $companyId);
        }
        $products = $query->get();
        return view('product_list', compact('products', 'companies'));
    }
}
