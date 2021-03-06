<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tag/{id?}', [ApiController::class, 'tag']); //Obtenemos un tag dado el id
Route::get('/colour/{id?}', [ApiController::class, 'colour']); //Obtenemos los nombres de un color dado el id
Route::get('/location/{id?}', [ApiController::class, 'location']); //Obtenemos los nombres de una localización dado el id
Route::get('/shipping/{id}', [ApiController::class, 'shipping']); //Obtenemos el precio del envío dada la id del Pais

Route::get('/products', [ApiController::class, 'products']); //Obtenemos el precio del envío dada la id del Pais