<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * En este controlador irán los procesos relacinados con el
 * proceso de compra
 */
class ShoppingController extends Controller
{
    /**
     * Añade el producto a la cesta de la compra
     */
    public function addToCart(Request $request) {

        $request->validate([
            'product_id' => 'required'
        ]);

        DB::beginTransaction();

        //Significa que hay usuario registrado, nos basamos en su id
        if (Auth::check()) {
            $cart = Cart::where('user_id', auth()->user()->id)->first();
            if ($cart == null) {
                $cart = new Cart();
                $cart->user_id = auth()->user()->id;
                $cart->save();
            }
        //Nos basamos en la sesión para crear un carrito de la compra
        }else {
            $cart = Cart::where('session_id', session()->getId())->first();
            if ($cart == null) {
                $cart = new Cart();
                $cart->session_id = session()->getId();
                $cart->save();
            }
        }

        //Solo puede haber un producto de cada tipo por lo que, si ya se ha añadido no lo dejamos añadir más
        $productId = $request->product_id;

        $alreadyAdded = Cart::whereHas('products', function($query) use ($productId) {
            $query->where('product_id', $productId);})->first();
        //Si no es nulo significa que el producto ya está en el carrito
        if ($alreadyAdded != null) {
            return back()->with('message', 'The product is already in your cart');
        }

        //Introducimos el producto en la tabla del Carrito
        $product_id = $request->product_id;
        Log::channel('custom')->debug($cart);
        Log::channel('custom')->debug("Id de producto añadido: " . $product_id);
        $cart->products()->attach($product_id); //Sería la tabla cart_product

        DB::commit();

        return back()->with('message', 'Product added to cart');

    }

    public function cartView() {

        $locale = app()->getLocale();

        //Significa que hay usuario registrado, nos basamos en su id
        if (Auth::check()) {
            $cart = Cart::where('user_id', auth()->user()->id)->first();
            if ($cart == null) {
                $cart = new Cart();
                $cart->user_id = auth()->user()->id;
                $cart->save();
            }
        //Nos basamos en la sesión para crear un carrito de la compra
        }else {
            $cart = Cart::where('session_id', session()->getId())->first();
            if ($cart == null) {
                $cart = new Cart();
                $cart->session_id = session()->getId();
                $cart->save();
            }
        }

        $totalPrice = 0;

        //Aquí calculamos el precio total
        foreach ($cart->products as $product) {
            if($locale == "no") {
                $totalPrice += $product->price_nok;
            }else {
                $totalPrice += $product->price_eur;
            }
            
        }

        return view('shopping.cart', compact('cart', 'totalPrice', 'locale'));
    }

    public function deleteProductP(Request $request) {
        $request->validate([
            'product_id' => 'required'
        ]);

        if (Auth::check()) {
            $cart = Cart::where('user_id', auth()->user()->id)->first();
        }
        else {
            $cart = Cart::where('session_id', session()->getId())->first();
        }

        $cart->products()->detach($request->product_id);

        return back();

    }


    public function shippingDataP() {
        return view('shopping.shipping-data');
    }
}
