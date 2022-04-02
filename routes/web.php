<?php

use App\Http\Controllers\TestDbController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('shop', [TestDbController::class, 'shop'])->name('test.shop');
Route::get('cart', [TestDbController::class, 'cart'])->name('cart.shop');

//Procesos
Route::post('add-to-cart', [TestDbController::class, 'addToCart'])->name('cart.add');
Route::post('checkout', [TestDbController::class, 'checkout'])->name('test.checkout');
Route::post('shipping', [TestDbController::class, 'shipping'])->name('testing.shipping');
Route::post('paynow', [TestDbController::class, 'paynow'])->name('testing.paynow');