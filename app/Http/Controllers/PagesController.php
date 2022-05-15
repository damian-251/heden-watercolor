<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Location_tr;
use App\Models\Product;
use App\Models\Product_tr;
use App\Models\Tag;
use App\Models\Tag_tr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PagesController extends Controller
{
    public function vistaPortfolio(Request $request, $type = null, $parameter = null) {
        
        Log::channel('custom')->debug("Request "  . $request );

        //Valores para poner en el menú de filtrado de obras 
        $tagNames = Tag_tr::select('name')->where('language_code', app()->getLocale())->get();
        $locationNames = Location_tr::select('name')->where('language_code', app()->getLocale())->get();

        //Si hay algún parámetro los filtramos
        if ($type !=null) {
            if ($type == "tag") {
                $tagId = Tag_tr::where('name', $parameter)->first()->tag_id;
                $tag = Tag::find($tagId);
                $products = Product::whereHas('tags', function($query) use ($tagId) {
                $query->where('tag_id', $tagId);})->get();
            }else if ($type == "location") {

                $locationId = Location_tr::where('name', $parameter)->first()->location_id;
                $location = Location::find($locationId);

                $products = Product::whereHas('location', function($query) use ($locationId) {
                $query->where('location_id', $locationId);})->get();

            }

        }else if (isset($request->search)) {
            $search = $request->search;
            //Hemos introducido término para buscar por título
            $products = Product::whereHas('product_translation', function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');})->orderBy('creation_date', 'desc')->get();

        }else {
            //Más recientes primeros
            $products = Product::orderBy('creation_date', 'desc')->get();

        }

        return view('portfolio', compact('products', 'tagNames', 'locationNames'));
    }

    /**
     * Mostramos los detalles de cada producto
     */
    public function vistaDetalles($id=1) {
        $product = Product::find($id);
        $productTr = Product_tr::where('product_id', $id)->where('language_code', app()->getLocale())->first();

        //Si no está lo ponemos en el idioma por defecto
        if ($productTr == null) {
            $productTr = Product_tr::where('product_id', $id)->where('language_code', config('app.default_locale'))->first();
        }
        return view('product-details', compact('product', 'productTr'));
    }

    /**
     * Muestra la vista de los productos que están disponibles
     */
    public function vistaTienda() {

        $products = Product::where('stock', '>', 0)->orderBy('creation_date', 'desc')->get();

        return view('shop', compact('products'));
    }

    public function requestPaintingView() {
        return view ('request-painting');
    }

    /**
     * Vista de la página About Heden
     */
    public function aboutHeden() {
        return view('about-heden');
    }

    /**
     * Vista de exposiciones
     */
    public function exhibitions() {
        return view('exhibitions');
    }
}
