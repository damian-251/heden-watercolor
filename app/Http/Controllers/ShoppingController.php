<?php

namespace App\Http\Controllers;

use App\Models\Address;
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


    public function shippingDataP(Request $request) {

        $locale = app()->getLocale();

        $countries = Shipping::all();

        if ($locale == "no") {
            $currency = "kr";
        }else {
            $currency = "€";
        }

        if (Auth::check()) {
            $adresses = Address::where('user_id', Auth::user()->id)->get();
            $cart = Cart::where('user_id', auth()->user()->id)->with('products')->first();
        }else {
            $adresses = null;
            $cart = Cart::where('session_id', session()->getId())->with('products')->first();
        }

        $totalPrice = 0;

        foreach ($cart->products as $product) {

            if ($locale == "no") {
                $totalPrice += $product->price_nok;
            }else {
                $totalPrice += $product->price_eur;
            }
            
        }

        return view('shopping.shipping-data' , compact('adresses', 'cart', 'totalPrice', 'currency', 'countries'));
    }

    public function orderReviewP(Request $request) {
        $locale = app()->getLocale();
        //TODO: Hay que realizar un flitrado de datos, según se seleccione la dirección o se rellenen los campos
        Log::channel('custom')->debug($request);

        //Estos casos indican que el usuario registrado ha introducido una nueva dirección o un usuario no registrado
        //ha introducido su dirección
        if (!isset($request->existing_address) || $request->existing_address == null) {

            //Validamos los campos que sean requeridos y una vez hecho los insertamos en la base de datos
            Log::channel('custom')->debug("El usuario ha puesto su propia dirección");
            $request->validate([
                'fullName' => 'required',
                'telephone' => 'required',
                'address1' => 'required',
                'address2' => 'required',
                'postalCode' => 'required',
                'province' => 'required',
                'city' => 'required',
                'country' => 'required',
            ]);

            //Esta nueva dirección se añade a la base de datos

            DB::beginTransaction();

            $address = new Address();
            $address->full_name = $request->fullName;
            $address->phone = $request->telephone;
            $address->line1 = $request->address1;
            $address->line2 = $request->address2;
            $address->postal_code = $request->postalCode;
            $address->province = $request->province;
            $address->shipping_id = $request->country;
            $address->city = $request->city;

            if (Auth::check()) {
                $address->user_id = auth()->user()->id;
            }else {
                $address->session_id = session()->getId();
            }

            $address->save();

            DB::commit();

            Log::channel('custom')->debug($address);
            Log::channel('custom')->debug($address->id);

            $addressId = $address->id;
            $country = Shipping::findOrFail($request->country);

        }else {

            $addressId = $request->existing_address;
            $country = Shipping::findOrFail($request->existing_address->shipping_id);

        }

        if (Auth::check()) {
            $cart = Cart::where('user_id', auth()->user()->id)->with('products')->first();
        }else {
            $cart = Cart::where('session_id', session()->getId())->with('products')->first();
        }

        Log::channel('custom')->debug('Carrito de la compra' . $cart);

        if ($locale == "no") {
            $shippingPrice = $country->price_nok;
            $currencyStripe = 'nok';
            $currency = "kr";
        }else {
            $shippingPrice = $country->price_eur;
            $currencyStripe = 'eur';
            $currency = "€";
        }
        
        $totalPrice = 0;

        foreach ($cart->products as $product) {
            if ($locale == "no") {
                $totalPrice += $product->price_nok;
            }else {
                $totalPrice += $product->price_eur;
            }

            $finalPrice = $totalPrice + $shippingPrice;     
        }

        //TODO: Comprobar disponibilidad el producto antes de retornar esta lista

        return view('shopping.review-order', compact('locale', 'shippingPrice', 'currency', 'totalPrice', 'finalPrice', 'currencyStripe', 'addressId'));
        
    }

}
