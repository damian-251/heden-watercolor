<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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

//Edición de productos
Route::get('admin/edit-product', [AdminController::class, 'editProduct'])->name('edit-product');
Route::post('admin/edit-product-p', [AdminController::class, 'editProductP'])->name('edit-product-p');