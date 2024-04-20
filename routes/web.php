<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchFormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 初期ログイン画面
Route::get('/', function() {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'show'])->name('home');

// 商品一覧画面
Route::get('product_list', [ProductController::class, 'index'])->name('product.list');

// 商品詳細画面
Route::get('product_detail/{product}', [ProductController::class, 'detail'])->name('product.detail');

// 商品削除
Route::delete('delete_form/{product}',[ProductController::class, 'delete'])->name('product.destroy');

// 商品編集画面
Route::get('/product_edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
Route::patch('/product_edit/{product}/edit',[ProductController::class, 'update'])->name('product.update');

// 商品新規登録画面
Route::get('/product_register', [ProductController::class, 'show'])->name('product.register');
Route::post('store', [ProductController::class, 'store'])->name('store');

// 商品検索
Route::get('/search_form', [ProductController::class, 'search'])->name('search.form');
Route::post('/search_form', [ProductController::class, 'search'])->name('search');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();
