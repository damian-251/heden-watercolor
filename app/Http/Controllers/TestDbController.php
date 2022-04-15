<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TestDbController extends Controller
{
    public function index() {
        //Seleccionamos todos los productos para ver si funcionan las relaciones
        //También vamos a ver que según seleccionemos un idioma u otro cambie la descripción
        $products = Product::all();
        $language = Config::get('app.locale'); //El idioma que tenemos en este momento


        return view('testing.database', compact('products', 'language'));
    }


    public function shop() {
        //Parecida a la vista anterior solo que aquí solo se mostrarán los que tengan el atributo de sold en false
        //Podríamos cambiar el sold por disponible, así sería más adecuado

        $products = Product::where('available' , 1)->get(); //Aparacerán los que no estén vendidos, o no estén en venta
        $language = Config::get('app.locale'); //El idioma que tenemos en este momento para mostrar solo los datos en ese idioma

        return view('testing.shop', compact('products', 'language'));
    }

    public function addToCart(Request $request) { //Al añadir un producto al carrito pasamos por esta función
        //Como request recibimos el id del artículo que queremos añadir al carrito

        $request->validate([
            'product_id' => 'required'
        ]);

        $cart = Cart::where('session_id', session()->getId())->first(); //TODO: Cuando haya usuarios habría que cambiar esto

        if ($cart == null) {
            $cart = new Cart();
            //FIXME: Aquí que si no hay usuario activo use la session_id, si no usará el id de usuario
            $cart->session_id = session()->getId();
            $cart->save();
        }

        //Introducimos el producto en la tabla del Carrito
        $product_id = $request->product_id;
        Log::channel('custom')->debug($cart);
        Log::channel('custom')->debug("Id de producto añadido: " . $product_id);
        $cart->products()->attach($product_id); //Sería la tabla cart_product

        return back();


    }

    public function cart() {

        //Si el carrito está vacío lo creamos
        $cart = Cart::where('session_id', session()->getId())->first();
        //Si no existe el carrito con el session id lo creamos
        if ($cart == null) {
            $cart = new Cart();
            //FIXME: Aquí que si no hay usuario activo use la session_id, si no usará el id de usuario
            $cart->session_id = session()->getId();
            $cart->save();
        }

        //Este es el controlador de prueba para el carrito de la compra.
        //Se necesita--> Productos que se hayan añadido a la cesta
        //FIXME: Vamos a poner aquí los precios de los gastos de envío en un array asociativo pero tal vez debería ir en la base de datos
        //Botón comprar
        //PRECIO ORIENTATIVO SOLO PARA TEST, SE DEBE DE PREGUNTAR AL CLIENTE PARA ACTUALIZAR LOS DATOS
        // $shippingEur = ["no" => 6, "other" => 15]; //Mejor en base de datos por si el cliente quiere cambiar los precios
        // $shippingNok = ["no" => 60, "other"=> 150 ];

        //Accedemos al carrito del cliente y mostramos los productos que ha añadido

        //Productos del carrito
        //TODO: Una vez el usuario ha realizado el pedido debería borrarse el carrito (mirar borrar con soft-delete)
        //$products = Cart::where('user_id', 1)->get(); //Habría que poner la id del usuario actual
        //TODO: Estaría bien añadir en la base de datos el precio en € y en NOK por separado.
        //TODO: Paquete que podría ser útil https://www.educative.io/edpresso/how-to-convert-one-currency-to-another-using-laravel-currency
        //Podríamos obtener el tipo de moneda en función del país en el que está en estos momentos https://www.positronx.io/how-to-get-location-information-with-ip-address-in-laravel/
        //https://www.w3adda.com/blog/laravel-8-get-country-city-name-address-from-ip-address-example
        //Añadir a la tabla una session id para que los usuarios no registrados puedan gestionar su carrito

        $totalPrice = 0;

        //Aquí calculamos el precio total
        foreach ($cart->products as $product) {
            $totalPrice += $product->price;
        }

        return view('testing.cart', compact('cart', 'totalPrice'));


    }

    public function checkout() {

        //Recuperamos el carrito del usuario
        $cart = Cart::where('session_id', session()->getId())->first();

        $totalPrice = 0;
        foreach ($cart->products as $product) {
            $totalPrice += $product->price;
        }

        return view('testing.checkout', compact('cart', 'totalPrice'));

    }

    public function shipping(Request $request) {
        /* Guardamos la dirección en la tabla dirección 
            A partir del país deberíamos obtener los gastos de envío 
            Aquí ya se pondría el botón pagar*/

        $request->validate([
            'fullName' => 'required',
            'address_line1' => 'required',
            'phone' => 'required',
            'postal_code' => 'required',
            'city'=> 'required',
            'province' => 'required',
            'country' => 'required'
        ]);
        //Metemos los datos en la tabla de direcciones
        $address= new Address();
        $address->line1 = $request->address_line1;
        if (isset( $request->address_line2)) {
            $address->line2 = $request->address_line2;
        }
        $address->full_name = $request->fullName;
        $address->phone = $request->phone;
        $address->postal_code = $request->postal_code;
        $address->city = $request->city;
        $address->province = $request->province;
        $address->country = $request->country;
        $address->session_id = session()->getId();
        $address->save();
        
        $shippingEur = 5;
        $cart = Cart::where('session_id', session()->getId())->first();

        $totalPrice = 0;
        foreach ($cart->products as $product) {
            $totalPrice += $product->price;
        }

        $finalPrice = $totalPrice + $shippingEur;
        return view('testing.shipping', compact('cart', 'shippingEur', 'finalPrice', 'totalPrice'));
    }

    public function paynow(Request $request) {

        /*
        Se realiza la lógica de pago y se pone en orders
        */
        //Iniciamos una transacción, ponemos los datos en orders y
        //borramos el carrito
        DB::transaction(function () {
            $address = Address::where('session_id', session()->getId())->latest()->first();
            $cart = Cart::where('session_id', session()->getId())->first();
            $order = new Order();
            $shippingEur = 5;
            $totalPrice = 0;
            foreach ($cart->products as $product) {
                $totalPrice += $product->price;
            }
            $finalPrice = $totalPrice + $shippingEur;
            $order->sub_total = $totalPrice;
            $order->total_price = $finalPrice;
            $order->shipping_price = $shippingEur;
            $order->payment_method = "stripe";  
            $order->status = "paid";
            $order->address()->associate($address);
            $order->save(); //Guardamos para que pueda generar el id
            $order->products()->attach($cart->products);
            $order->finshed = true;
            //Borramos el carrito
            $order->save();
            $cart->delete();  //TODO: Estaría bien mirar softdeletes

            //Probando el log
            Log::channel('custom')->debug("Usuario " . $order->address->session_id . " ha realizado el pedido con id" . $order->id);

        });


        return view('home');
    }
}
