<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\TestDbController;
use App\Http\Controllers\UserCPController;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//Estas rutas se generan al poner los comandos para que esté la autenticación
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Ruta de prueba para ver si funciona la traducción
//Route::view('translation', 'translation');

//Si no se define ningún idioma la página estará en inglés
Route::get('{lang?}/translation', function ($lang = 'en') {
    App::setlocale($lang);
    return view('translation');
});

// //Segunda prueba de traducción con los archivos json
// Route::get('{locale?}/translation2', function($locale = 'en') {
//     if(isset($locale) && in_array($locale, 
//     config('app.available_locales'))) {
//         App::setlocale($locale);
//     }
//     return view('translation-2');
// });

//Aquí hemos cambiado middleware para que el idioma aparezca automáticamente
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::get('translation2', function () {
    return view('translation-2');
});

//Ruta para realizar pruebas de las bases de datos

//Vistas
Route::get('dbtest', [TestDbController::class, 'index'])->name('test.db');
Route::get('shop-test', [TestDbController::class, 'shop'])->name('test.shop');
Route::get('cart', [TestDbController::class, 'cart'])->name('cart.shop');

//Vista de portfolio
Route::get('portfolio/{type?}/{parameter?}', [PagesController::class, 'vistaPortfolio'])->name('portfolio');

//Búsqueda en portfolio
Route::post('portfolio/search', [PagesController::class, 'vistaPortfolio'])->name('portfolioP');

//Detalle de la obra
Route::get('details/{id?}', [PagesController::class, 'vistaDetalles'])->name('product-details');

//Tienda
Route::get('shop', [PagesController::class, 'vistaTienda'])->name('shop');



//Procesos
Route::post('add-to-cart', [TestDbController::class, 'addToCart'])->name('cart.add');
Route::post('checkout', [TestDbController::class, 'checkout'])->name('test.checkout');
Route::post('shipping', [TestDbController::class, 'shipping'])->name('testing.shipping');
Route::post('paynow', [TestDbController::class, 'paynow'])->name('testing.paynow');



Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Panel de Control del Administrador
Route::get('admin/admin-cp', [AdminController::class, 'index'])->name('admin-cp');

//Creación de etiquetas
Route::get('admin/create-tag', [AdminController::class, 'createTag'])->name('create-tag');
Route::post('admin/create-tag-p', [AdminController::class, 'createTagP'])->name('create-tag-p');

//Edición de etiquetas
Route::get('admin/edit-tag', [AdminController::class, 'editTag'])->name('edit-tag');
    Route::post('admin/edit-tag-p', [AdminController::class, 'editTagP'])->name('edit-tag-p');

//Creación de colores
Route::get('admin/create-colour', [AdminController::class, 'createColour'])->name('create-colour');
Route::post('admin/create-colour-p', [AdminController::class, 'createColourP'])->name('create-colour-p');

//Edición de colores
Route::get('admin/edit-colour', [AdminController::class, 'editColour'])->name('edit-colour');
Route::post('admin/edit-colour-p', [AdminController::class, 'editColourP'])->name('edit-colour-p');

//Creación de productos
Route::get('admin/create-product', [AdminController::class, 'createProduct'])->name('create-product');
Route::post('admin/create-product-p', [AdminController::class, 'createProductP'])->name('create-product-p');


//Vista de todos los productos para su edición
Route::get('admin/product-list', [AdminController::class, 'productList'])->name('product-list');

//Se elimina el producto seleccionado pasando su identificador como parámetro
Route::delete('admin/remove-product/{id}', [AdminController::class, 'deleteProduct'])->name('delete-product');

//Edición de productos
Route::get('admin/edit-product/{id}', [AdminController::class, 'editProduct'])->name('edit-product');
Route::put('admin/edit-product-p/{id}', [AdminController::class, 'editProductP'])->name('edit-product-p');

//Creación de localizaciones
Route::get('admin/create-location', [AdminController::class, 'createLocation'])->name('create-location');
Route::post('admin/create-location-p', [AdminController::class, 'createLocationP'])->name('create-location-p');

//Edición de localizaciones
Route::get('admin/edit-location', [AdminController::class, 'editLocation'])->name('edit-location');
Route::put('admin/edit-location-p', [AdminController::class, 'editLocationP'])->name('edit-location-p');


//Test checkout
Route::get('checkout-test', function () {
    return view('testing.stripe');
});

//Escuchar los eventos de Stripe. Si el pago ha sido realizdo con éxito lo añadimos a la tabla

Route::post('webhook', function(Request $request) {
    //Log::channel('custom')->debug("Logger stripe --> " . $request);
    if ($request->type == 'charge.succeeded') {
        Log::channel('custom')->debug("El pago ha sido completado con éxito");
        Log::channel('custom')->debug("Subtotal " . $request->data['object']['metadata']['subtotal'] );
        Log::channel('custom')->debug("id de la dirección " . $request->data['object']['metadata']['address_id'] );

        try {
            DB::beginTransaction();

            $payment = new Payment();
            $payment->stripe_id = $request->data['object']['id'];
            $payment->amount = $request->data['object']['amount'];
            $payment->email = $request->data['object']['billing_details']['email'];
            $payment->name = $request->data['object']['billing_details']['name'];
            $payment->currency = $request->data['object']['currency'];
            $payment->save();

            Log::channel('custom')->debug("Payment " . $payment );

            $order = new Order();
            $order->subtotal_price = $request->data['object']['metadata']['subtotal'];
            $order->address_id = $request->data['object']['metadata']['address_id'];
            $order->payment_id = $payment->id;
            $order->shipping_price = $request->data['object']['metadata']['shipping_price'];
            $order->sent = false;
            $order->save();
            Log::channel('custom')->debug("Order " . $order);
            //Mediante la tabla address podemos saber el id del usuario
            //TODO: Hay que poner los productos como que ya no están disponibles

            //Recogemos los productos que había en el carrito
            if (Auth::check()) {
                $cart = Cart::where('user_id', $request->data['object']['metadata']['user_id'])->first(); 
            }else {
                $cart = Cart::where('session_id', $request->data['object']['metadata']['session_id'])->first();
            }
            
            Log::channel('custom')->debug("Cart " . $cart );
            Log::channel('custom')->debug("Cart products" . $cart->products()->allRelatedIds());
            //Los insertamos en order
            $order->products()->attach($cart->products()->allRelatedIds());
            Log::channel('custom')->debug("Order products " . $order->products );

            //Ponemos que ya no están disponibles para que aparezcan el el portfolio pero no en la tienda
            foreach ($cart->products as $product) {
                $product->available = false;
                $product->save();
                Log::channel('custom')->debug("Product " . $product );
            }

            //Eliminamos el carrito y sus relaciones
            $cart->products()->detach();
            $cart->delete();

            DB::commit();
            Log::channel('custom')->debug("Todo correcto :)" );


        } catch (\Exception $e) {
            return $e->getMessage();
            Log::channel('custom')->critical($e->getMessage());

        }
    }

    //TODO Habría que realizar los cambios correspondientes de los productos, que ya no estén disponibles...
});

// -- PROCESO DE COMPRA --
//Rutas y procesos relacionados con el proceso de compra

//Añadir al carrito
Route::post('add-to-cart', [ShoppingController::class, 'addToCart'])->name('add-to-cart');

//Vista del carrito
Route::get('shopping-cart', [ShoppingController::class, 'cartView'])->name('shopping-cart');
//Eliminar productos del carrito
Route::post('delete-product-p', [ShoppingController::class, 'deleteProductP'])->name('delete-product-p');

//Introducir datos de dirección y precio de gastos de envío
Route::post('shipping-data-p', [ShoppingController::class, 'shippingDataP'])->name('shipping-data-p');

//Confirmación de los datos y pago
Route::post('order-review-p', [ShoppingController::class, 'orderReviewP'])->name('order-review-p');


// ----- PANEL DE CONTROL DEL USUARIO ------ //
//Panel de control del usuario
Route::get('user/control-panel', [UserCPController::class, 'controlPanel'])->name('user-control-panel');

//Ver los datos del usuario
Route::get('user/data', [UserCPController::class, 'myData'])->name('user-data');
Route::get('user/addresses', [UserCPController::class, 'myAddresses'])->name('user-addresses');
Route::get('user/orders', [UserCPController::class, 'myOrders'])->name('user-orders');

//Editar y eliminar direcciones
Route::post('user/address/edit', [UserCPController::class, 'editAddress'])->name('user-address-edit');
Route::delete('user/address/delete', [UserCPController::class, 'deleteAddress'])->name('user-address-delete');
Route::put('user/address/edit-p', [UserCPController::class, 'editAddressP'])->name('user-address-edit-p');

//Vista solucitud de obra
Route::get('request-painting', [PagesController::class, 'requestPaintingView'])->name('request-painting');
