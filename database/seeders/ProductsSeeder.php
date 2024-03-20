<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;




class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'id' => "",
            'company_id' => "",
            'product_name' => "ダミー商品",
            'price' => "150",
            'stock' => "3",
            'comment' => "特になし",
            'img_path' => ""
        ]);
    }
}
