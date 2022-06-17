<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\TestDbController;
use App\Http\Controllers\UserCPController;
use App\Mail\RequestPaintingMail;
use App\Mail\ShippingMail;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
//Página de inicio
Route::get('/', function () {
    return view('start');
})->name('start');

// //Exposiciones
// Route::get('exhibitions', function () {
//     return view('start');
// })->name('exhibitions');

// //Contacto
// Route::get('contact', function () {
//     return view('contact');
// })->name('contact');

//Estas rutas se generan al poner los comandos para que esté la autenticación
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Aquí hemos cambiado middleware para que el idioma aparezca automáticamente
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('translation');

Route::get('translation2', function () {
    return view('translation-2');
});

//Ruta para realizar pruebas de las bases de datos

//Vista de portfolio
Route::get('portfolio/{type?}/{parameter?}', [PagesController::class, 'vistaPortfolio'])->name('portfolio');

//Búsqueda en portfolio
Route::post('portfolio/search', [PagesController::class, 'vistaPortfolio'])->name('portfolioP');

//Detalle de la obra
Route::get('details/{id?}', [PagesController::class, 'vistaDetalles'])->name('product-details');

//Tienda
Route::get('shop', [PagesController::class, 'vistaTienda'])->name('shop');



// //Procesos
// Route::post('add-to-cart', [TestDbController::class, 'addToCart'])->name('cart.add');
// Route::post('checkout', [TestDbController::class, 'checkout'])->name('test.checkout');
// Route::post('shipping', [TestDbController::class, 'shipping'])->name('testing.shipping');
// Route::post('paynow', [TestDbController::class, 'paynow'])->name('testing.paynow');



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

//Modificar la sección especial
Route::get('admin/modify-special', [AdminController::class, 'modifySpecial'])->name('modify-special');
Route::post('admin/modify-special-p', [AdminController::class, 'modifySpecialP'])->name('modify-special-p');

//Marcar pedido como enviado
Route::get('admin/order-sent', [AdminController::class, 'orderSent'])->name('order-sent');
Route::post('admin/order-sent-p', [AdminController::class, 'orderSentP'])->name('order-sent-p');

//Ruta a la sección espeical
Route::get('admin/special-section', [PagesController::class, 'specialSection'])->name('special-section');

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
        // Log::channel('custom')->debug("El pago ha sido completado con éxito");
        // Log::channel('custom')->debug("Subtotal " . $request->data['object']['metadata']['subtotal'] );
        // Log::channel('custom')->debug("id de la dirección " . $request->data['object']['metadata']['address_id'] );

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

            //Recogemos los productos que había en el carrito
            if (isset($request->data['object']['metadata']['user_id'])) {
                $cart = Cart::where('user_id', $request->data['object']['metadata']['user_id'])->first(); 
            }else {
                $cart = Cart::where('session_id', $request->data['object']['metadata']['session_id'])->first();
            }

            $order = new Order();
            $order->subtotal_price = $request->data['object']['metadata']['subtotal'];
            $order->address_id = $request->data['object']['metadata']['address_id'];
            $order->address_f_id = $request->data['object']['metadata']['addressB_id'];
            $order->payment_id = $payment->id;
            $order->shipping_price = $request->data['object']['metadata']['shipping_price'];
            $order->sent = false;
            $order->taxes = null; //De momento no tenemos en cuenta los impuestos, genraremos una factura a petición del cliente
            $order->save();
            Log::channel('custom')->debug("Order " . $order);
            //Mediante la tabla address podemos saber el id del usuario
            //TODO: Hay que poner los productos como que ya no están disponibles

            //Recorremos los productos del carrito para rellenar las tablas pivote de order
            foreach ($cart->products as $product) {

                //Filtramos la descripción del producto
                $description = $product->product_translation->where('language_code', app()->getLocale())->first()->description;
                if ($description == null) {
                    $description =$product->product_translation->where('language_code', config('app.default_locale'))->first()->description;
                }

                if ($request->data['object']['currency'] == "eur") {
                    $price = $product->price_eur;
                }else {
                    $price = $product->price_nok;
                }

                //Modificamos el stock del producto
                $product->stock -=$product->pivot->units;
                $product->save();

                //FIXME: Como está en una transacción no es posible acceder a un valor que ha sido editado, se debe marcar manualmente como vendido
                // //Si el stock del producto es de 0 lo marcamos como vendido
                // if ($product->stock == 0) {
                //     $product->sold = true;
                //     $product->save();
                // }


                //Insertamos en la orden los pedidos
                $order->products()->attach($product->id, ['units' => $product->pivot->units, 'price' => $price, 
                'sku' => $product->sku, 'description' => $description ]);               
            }

            
            
            // Log::channel('custom')->debug("Cart " . $cart );
            // Log::channel('custom')->debug("Cart products" . $cart->products()->allRelatedIds());
            // //Los insertamos en order
            // //$order->products()->attach($cart->products()->allRelatedIds());
            // Log::channel('custom')->debug("Order products " . $order->products );

            //Guardamos los productos para mostrarlos en el email antes de borrar el carrito
            $proudctsEmail = $cart->products;

            //Eliminamos el carrito y sus relaciones
            $cart->products()->detach();
            $cart->delete();

            DB::commit();
            Log::channel('custom')->debug("Todo correcto :')" );

            

            //Aquí enviamos el correo electrónico al usuario con su pedido y una copia al administrador
            //(Se supone que Stripe envía un correo al usuario pero en la versión de desarrollo parece que no)
            //Obtenemos el email que ha puesto en Stripe
                $clientEmail = $request->data['object']['billing_details']['email'];

                $correo = new ShippingMail;
                $correo->address = Address::find($request->data['object']['metadata']['address_id']);
                $correo->billingAddress = Address::find($request->data['object']['metadata']['addressB_id']);
                $correo->country = Shipping::find($correo->address->shipping_id)->country;
                $correo->billingCountry = Shipping::find($correo->billingAddress->shipping_id)->country;
                $correo->products = $proudctsEmail;
                $correo->currency = $request->data['object']['currency'];
                $correo->shipping_price = $order->shipping_price;
                $correo->totalPrice = floatval($request->data['object']['amount'])/100;

                //Copia para el administrador y el cliente
                Mail::to(config('services.email.request'))->send($correo);
                Mail::to($clientEmail)->send($correo);


        } catch (\Exception $e) {
            return $e->getMessage();
            Log::channel('custom')->critical($e->getMessage());

        }
    }

    //TODO Habría que realizar los cambios correspondientes de los productos, que ya no estén disponibles...
});

//Redirecciones cuando el proceso de compra ha sido exitoso
Route::get('payment-successful', [ShoppingController::class, 'paymentSuccessful'])->name('payment-successful');
Route::get('payment-failed', [ShoppingController::class , 'paymentFailed'])->name('payment-failed');

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

//Vista acerca del autor
Route::get('about-heden', [PagesController::class, 'aboutHeden'])->name('about-heden');

//Vista de exposiciones
Route::get('exhibitions', [PagesController::class, 'exhibitions'])->name('exhibitions');

//Email
Route::post('request-email-p', [MailController::class, 'requestEmailP'])->name('request-email-p');
Route::post('contact-email-p', [MailController::class, 'contactEmailP'])->name('contact-email-p');

//Políticas de privacidad
Route::get('privacy/{lang?}', [PagesController::class, 'privacyView'])->name('privacy-view');
Route::get('shipping-policy/{lang?}', [PagesController::class, 'shippingPrivacyView'])->name('shipping-policy-view');
Route::get('cookies', [PagesController::class, 'cookiesView'])->name('cookies');
Route::get('support', [PagesController::class, 'supportView'])->name('support');


//Lienzo para realizar pruebas
Route::get('testing', [AdminController::class, 'testing'])->name('testing');