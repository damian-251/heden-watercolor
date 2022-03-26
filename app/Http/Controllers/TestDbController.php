<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class TestDbController extends Controller
{
    public function index() {
        //Seleccionamos todos los productos para ver si funcionan las relaciones
        //También vamos a ver que según seleccionemos un idioma u otro cambie la descripción
        $products = Product::all();
        $language = Config::get('app.locale'); //El idioma que tenemos en este momento


        return view('testing.database', compact('products', 'language'));
    }
}
