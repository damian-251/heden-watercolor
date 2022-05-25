<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Shipping;
use App\Rules\ReCaptcha;
use Carbon\Carbon;
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
     * Añade el producto a la cesta de la compra, aunque la base de datos está preparada
     * el carrito aún no opera con unidades de productos, se haría si en el futuro se vendiesen
     * productos que tengan más de una unidad
     */
    public function addToCart(Request $request)
    {

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
        } else {
            $cart = Cart::where('session_id', session()->getId())->first();
            if ($cart == null) {
                $cart = new Cart();
                $cart->session_id = session()->getId();
                $cart->save();
            }
        }



        //Comparamos la fecha actual con la fecha de reserva

        $product = Product::find($request->product_id);
        $currentTime = Carbon::now();
        //Usamos la misma zona horaria que la base de datos
        $currentTime->setTimezone('UTC');

        //El sistema de reserva solo lo vamos a hacer si hay únicamente una unidad disponible

        $reserved = false;
        if ($product->stock == 1) {
            $reserved = true;
            if ($product->reserved == null) {
                //Le añadimos el tiempo de reserva (media hora)
                $reservationTime = Carbon::now()->setTimezone('UTC');
                $reservationTime->addMinutes(env('RESERVATION_TIME'));
                $product->reserved = $reservationTime->format('Y-m-d H:i:s');
                $product->save();
                $reserved = false;
            } elseif (Carbon::parse($product->reserved)->lt($currentTime)) {


                //Borramos el producto de todos los carritos que lo tenga ya que solo queda
                //una unidad y esta ha sido reservada
                $productId = $product->id;
                $cartProducts = Cart::whereHas('products', function ($q) use ($productId) {
                    $q->where('products.id', $productId);
                })->orderBy('updated_at', 'asc')->get();

                if ($cartProducts->count() > 0) {
                    foreach ($cartProducts as $cartProduct) {
                        $cartProduct->products()->detach($productId);
                    }
                }

                //Ya podemos seguir el proceso normal
                $reservationTime = Carbon::now()->setTimezone('UTC');
                $reservationTime->addMinutes(env('RESERVATION_TIME'));
                $product->reserved = $reservationTime->format('Y-m-d H:i:s');
                $product->save();

                $reserved = false;
            } elseif (Carbon::parse($product->reserved)->gt($currentTime)) {
                //Significa que no ha pasado el tiempo de reserva
                return back()->with('message', 'The product is reserved');
            } else {
                return back();
            }
        }


        // Log::channel('custom')->debug("Current time: " . $currentTime . " Reservation time: " . $reservationTime);


        if ($reserved == false) {

            $pivot = $cart->products()->where('product_id', $request->product_id)->first();

            if ($pivot != null) {
                //Obtenemos las unidades actuales del producto que tenemos
                $currentUnits = $cart->products()->where('product_id', $request->product_id)->firstOrFail()->pivot->units;
                //Si las unidades que tenemos es igual al stock del producto no podemos añadir más unidades
                if ($currentUnits == Product::find($request->product_id)->stock) {
                    return back()->with('message', 'There is not more units availabe');
                } else {
                    //Si todo ok incrementamos en una unidad la cantidad del producto
                    $cart->products()->sync([$request->product_id => ['units' => $currentUnits + 1]], false);
                }
            } else {
                //Si aún no está el producto en la cesta insertamos el registro
                $cart->products()->attach($request->product_id, ['units' => 1]);
            }
        }


        DB::commit();

        return back()->with('message', 'Product added to cart');
    }

    public function cartView()
    {


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
        } else {
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
            if ($locale == "no") {
                $totalPrice += $product->price_nok;
            } else {
                $totalPrice += $product->price_eur;
            }
        }

        $currentTime = Carbon::now();
            //Usamos la misma zona horaria que la base de datos
            $currentTime->setTimezone('UTC');


        return view('shopping.cart', compact('cart', 'totalPrice', 'locale', 'currentTime'));
    }

    public function deleteProductP(Request $request)
    {
        $request->validate([
            'product_id' => 'required'
        ]);

        if (Auth::check()) {
            $cart = Cart::where('user_id', auth()->user()->id)->first();
        } else {
            $cart = Cart::where('session_id', session()->getId())->first();
        }

        $cart->products()->detach($request->product_id);

        return back();
    }


    public function shippingDataP(Request $request)
    {

        $request->validate([
            'g-recaptcha-response' => ['required', new ReCaptcha],
        ]);

        $locale = app()->getLocale();

        $countries = Shipping::all();

        if ($locale == "no") {
            $currency = "kr";
        } else {
            $currency = "€";
        }

        if (Auth::check()) {
            $adresses = Address::where('user_id', Auth::user()->id)->get();
            $cart = Cart::where('user_id', auth()->user()->id)->with('products')->first();
        } else {
            $adresses = null;
            $cart = Cart::where('session_id', session()->getId())->with('products')->first();
        }

        $totalPrice = 0;

        foreach ($cart->products as $product) {

            if ($locale == "no") {
                $totalPrice += $product->price_nok;
            } else {
                $totalPrice += $product->price_eur;
            }
        }

        return view('shopping.shipping-data', compact('adresses', 'cart', 'totalPrice', 'currency', 'countries'));
    }

    public function orderReviewP(Request $request)
    {
        $locale = app()->getLocale();
        //TODO: Hay que realizar un flitrado de datos, según se seleccione la dirección o se rellenen los campos
        // Log::channel('custom')->debug($request);

        //Tenemos que v 

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
            } else {
                $address->session_id = session()->getId();
                $address->identification = $request->identificationNumber;
            }

            $address->save();



            Log::channel('custom')->debug($address);
            Log::channel('custom')->debug($address->id);

            $addressId = $address->id;
            $country = Shipping::findOrFail($request->country);
        } else {

            $addressId = $request->existing_address;
            $address = Address::find($addressId);
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
            } else {
                $addressB->session_id = session()->getId();
                $addressB->identification = $request->identificationNumberB;
            }

            $addressB->save();

            $addressIdB = $addressB->id;
            $countryB = Shipping::findOrFail($request->countryB);
        } else {
            //Si no está marcada la dirección de facturación será la de envío
            $addressB = $address;
            $addressIdB = $address->id;
        }

        DB::commit();

        if (Auth::check()) {
            $cart = Cart::where('user_id', auth()->user()->id)->with('products')->first();
        } else {
            $cart = Cart::where('session_id', session()->getId())->with('products')->first();
        }

        //Por si acaso antes de llegar a este último paso comprobamos que los productos tengan stock
        //Si alguno de ellos no tiene stock lo volvemos a la página del carrito
        foreach ($cart->products as $product) {
            Log::channel('custom')->debug("Stock:" . $product->stock);
            if ($product->stock < 1) {

                return view('start')->with('message', __('Some products of your cart are out of stock, please check your cart'));
            }
        }

        Log::channel('custom')->debug('Carrito de la compra' . $cart);

        if ($locale == "no") {
            $shippingPrice = $country->price_nok;
            $currencyStripe = 'nok';
            $currency = "kr";
        } else {
            $shippingPrice = $country->price_eur;
            $currencyStripe = 'eur';
            $currency = "€";
        }

        $totalPrice = 0;

        foreach ($cart->products as $product) {
            if ($locale == "no") {
                $totalPrice += $product->price_nok;
            } else {
                $totalPrice += $product->price_eur;
            }

            $finalPrice = $totalPrice + $shippingPrice;
        }

        return view('shopping.review-order', compact('locale', 'address', 'addressB', 'shippingPrice', 'currency', 'totalPrice', 'finalPrice', 'currencyStripe', 'addressId', 'currency', 'addressIdB'));
    }

    public function paymentSuccessful()
    {

        return view('payment.successful');
    }

    public function paymentFailed()
    {
        return view('payment.failed');
    }
}
