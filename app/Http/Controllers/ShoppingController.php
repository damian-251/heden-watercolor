<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
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



        //TODO: Sistema de reserva pendiente

        // $alreadyAdded = Cart::whereHas('products', function($query) use ($productId) {
        //     $query->where('product_id', $productId);})->first();
        // //Si no es nulo significa que el producto ya está en el carrito
        // if ($alreadyAdded != null) {
        //     return back()->with('message', 'The product is already in your cart');
        // }

        //Comprobamos si el mismo tipo de producto ya existe en la cesta

        $pivot = $cart->products()->where('product_id', $request->product_id)->first();

        if ($pivot != null) {
            //Obtenemos las unidades actuales del producto que tenemos
            $currentUnits = $cart->products()->where('product_id', $request->product_id)->firstOrFail()->pivot->units;
            //Si las unidades que tenemos es igual al stock del producto no podemos añadir más unidades
            if ($currentUnits == Product::find($request->product_id)->stock) {
                return back()->with('message', 'There is not more units availabe');
            }else {
                //Si todo ok incrementamos en una unidad la cantidad del producto
                $cart->products()->sync([$request->product_id => [ 'units' => $currentUnits +1] ], false);
            }
        }else {
            //Si aún no está el producto en la cesta insertamos el registro
            $cart->products()->attach($request->product_id, ['units' => 1]);
        }


        
        // //Introducimos el producto en la tabla del Carrito
        // $product_id = $request->product_id;
        // Log::channel('custom')->debug($cart);
        // Log::channel('custom')->debug("Id de producto añadido: " . $product_id);
        // $cart->products()->attach($product_id); //Sería la tabla cart_product

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

            if (!Auth::check()) {
                $request->validate([
                    'identificationNumber' => 'required',
                ]);
            }

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
                $address->identification = $request->identificationNumber;
            }

            $address->save();

            

            Log::channel('custom')->debug($address);
            Log::channel('custom')->debug($address->id);

            $addressId = $address->id;
            $country = Shipping::findOrFail($request->country);

        }else {

            $addressId = $request->existing_address;
            $country = Shipping::findOrFail(Address::findOrFail($request->existing_address)->shipping_id);

        }


        //Filtramos la dirección de facturación si la hemos marcado como distinta

        if ($request->billingCheck == "on") {

            $request->validate([
                'fullNameB' => 'required',
                'telephoneB' => 'required',
                'address1B' => 'required',
                'address2B' => 'required',
                'postalCodeB' => 'required',
                'provinceB' => 'required',
                'cityB' => 'required',
                'countryB' => 'required',
            ]);

            //Si no estamos registrados deberemos meter un documento de identificación
            if (!Auth::check()) {
                $request->validate([
                    'identificationNumberB' => 'required',
                ]);
            }

            //Añadimos la dirección de facturación a la base de datos
            $addressB = new Address();
            $addressB->full_name = $request->fullNameB;
            $addressB->phone = $request->telephoneB;
            $addressB->line1 = $request->address1B;
            $addressB->line2 = $request->address2B;
            $addressB->postal_code = $request->postalCodeB;
            $addressB->province = $request->provinceB;
            $addressB->shipping_id = $request->countryB;
            $addressB->city = $request->cityB;

            if (Auth::check()) {
                $addressB->user_id = auth()->user()->id;
            }else {
                $addressB->session_id = session()->getId();
                $addressB->identification = $request->identificationNumberB;
            }

            $addressB->save();

            $addressIdB = $addressB->id;
            $countryB = Shipping::findOrFail($request->countryB);

        }else {
            //Si no está marcada la dirección de facturación será la de envío
            $addressB = $address;
            $addressIdB = $address->id;
        }

        DB::commit();

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

        return view('shopping.review-order', compact('locale', 'address', 'addressB','shippingPrice', 'currency', 'totalPrice', 'finalPrice', 'currencyStripe', 'addressId', 'currency', 'addressIdB'));
        
    }

}
