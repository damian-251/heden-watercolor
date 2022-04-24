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

        Log::channel('custom')->debug("Tipo "  . $type . " -- Parámetro " . $parameter );

        //Si hay algún parámetro los filtramos
        if ($type !=null) {
            if ($type == "tag") {
                $tagId = Tag_tr::where('name', $parameter)->first()->tag_id;
                $tag = Tag::find($tagId);
                $products = Product::whereHas('tags', function($query) use ($tagId) {
                $query->where('tag_id', $tagId);})->get();
            }else if ($type == "location") {
                Log::channel('custom')->debug("DATOS DE LA LOCALIZACIÓN");
                $locationId = Location_tr::where('name', $parameter)->first()->location_id;
                Log::channel('custom')->debug("locationid "  . $locationId);
                $location = Location::find($locationId);
                Log::channel('custom')->debug("location "  . $location);
                $products = Product::whereHas('location', function($query) use ($locationId) {
                $query->where('location_id', $locationId);})->get();
                Log::channel('custom')->debug("products "  . $products);
            }

        }else if (isset($request->search)) {
            $search = $request->search;
            //Hemos introducido término para buscar por título
            $products = Product::whereHas('product_translation', function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');})->get();

        }else {
            $products = Product::all();

        }

        
        Log::channel('custom')->debug("Productos con las etiquetas correspondientes");
        Log::channel('custom')->debug($products);




        return view('portfolio', compact('products', 'tagNames', 'locationNames'));
    }

    /**
     * Mostramos los detalles de cada producto
     */
    public function vistaDetalles($id=1) {
        $product = Product::find($id);
        $productTr = Product_tr::where('product_id', $id)->where('language_code', app()->getLocale())->first();
        return view('product-details', compact('product', 'productTr'));
    }

    /**
     * Muestra la vista de los productos que están disponibles
     */
    public function vistaTienda() {

        $products = Product::where('available', true)->get();

        return view('shop', compact('products'));

    }
}
