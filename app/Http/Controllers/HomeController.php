<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function show(){
        return view('home');
    }

    // public function variable(){
    //     $product_detail = 'product_detail';
    //     return view('product_list',compact(
    //         'product_detail'));
    // } 
}