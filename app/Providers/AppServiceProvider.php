<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Share cart count to all views
        view()->composer('*', function ($view) {
            if (auth()->check() && auth()->user()->role === 'user') {
                $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('qty');
                $view->with('cartCount', $cartCount);
            }
        });
    }
}
