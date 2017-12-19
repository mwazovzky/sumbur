<?php

namespace App\Providers;

use App\Order;
use App\Furniture;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('home', function ($view) {
            $orders = Order::all()->take(5);
            $furniture = Furniture::all();
            return $view->with([
                'orders'     => $orders,
                'furniture' => $furniture,
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
