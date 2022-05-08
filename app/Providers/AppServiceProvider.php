<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
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
        view()->composer('partials.language_switcher', function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });

        // //Cargamos el carrito para que parpadee si tiene algún producto
        // if (Auth::check()) {
        //     $cart = Cart::where('user_id', auth()->user()->id)->with('products')->first(); 
        // }else {
        //     $cart = Cart::where('session_id', session()->getId())->with('products')->first();
        // }

        // $cartProducts = false;
        // //Comprobamos si hay productos
        // if ($cart != null) {
        //     if ($cart->products->count() != 0 ) {
        //         $cartProducts = true;   
        //     }
        // }

        // View::share('cartProducts', $cartProducts);

    }
}
