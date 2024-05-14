<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    use Sortable;
    protected $table = "products";
    protected $fillable = [
        'product_name',
        'company_name',
        'price',
        'stock',
        'comment',
        'img_path',
    ];
    public function company() {
        return $this->belongsTo(Company::class);
    }
    public function getList() {
    $products = Product::with('company')->get();
    return $products;
    }
}
