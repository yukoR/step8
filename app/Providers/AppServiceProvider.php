<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view::share('list','product.list');
        view::share('detail','product.detail');
        view::share('id','$product->id');

        view::share('register','product.register');
        view::share('edit','product.edit');
        view::share('delete','delete');
        

    }
}
