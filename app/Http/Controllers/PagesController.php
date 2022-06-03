<?php

namespace App\Http\Controllers;

use App\Models\Colour_tr;
use App\Models\Location;
use App\Models\Location_tr;
use App\Models\Product;
use App\Models\Product_tr;
use App\Models\Tag;
use App\Models\Tag_tr;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function vistaPortfolio(Request $request, $type = null, $parameter = null)
    {

        //Valores para poner en el menú de filtrado de obras 
        $tagNames = Tag_tr::select('name')->where('language_code', app()->getLocale())->get();
        $locationNames = Location_tr::select('name')->where('language_code', app()->getLocale())->get();
        $colourNames = Colour_tr::select('name')->where('language_code', app()->getLocale())->get();
        $searchQuery = null;

        //Si hay algún parámetro los filtramos
        if ($type != null) {

            switch ($type) {
                case 'tag':
                    $tagId = Tag_tr::where('name', $parameter)->first()->tag_id;
                    $tag = Tag::find($tagId);
                    $products = Product::whereHas('tags', function ($query) use ($tagId) {
                        $query->where('tag_id', $tagId);
                    })->get();
                    break;
                case 'location':
                    $locationId = Location_tr::where('name', $parameter)->first()->location_id;
                    $location = Location::find($locationId);

                    $products = Product::whereHas('location', function ($query) use ($locationId) {
                        $query->where('location_id', $locationId);
                    })->get();
                    break;
                case 'colour':
                    $colourId = Colour_tr::where('name', $parameter)->first()->colour_id;
                    $colour = Tag::find($colourId);
                    $products = Product::whereHas('colours', function ($query) use ($colourId) {
                        $query->where('colour_id', $colourId);
                    })->get();
                    break;
                default:
                    $products = Product::all();
                    break;
            }

        } else if (isset($request->search)) {
            $search = $request->search;
            //Hemos introducido término para buscar por título

            //Filtramos si hemos introducido algún comando de búsqueda
            $searchParameter = strtok($search, " ");
            $searchQuery = trim(strstr($search, " "));

            switch ($searchParameter) {
                case '#title':

                    $products = Product::whereHas('product_translation', function ($query) use ($searchQuery) {
                        $query->where('name', 'like', '%' . $searchQuery . '%');
                    })->orderBy('creation_date', 'desc')->get();
                    break;

                case '#color':

                    $products = Product::whereHas('colours', function ($query) use ($searchQuery) {
                        $query->whereHas('colour_translation', function ($query) use ($searchQuery) {
                            $query->where('name', 'like', '%' . $searchQuery . '%');
                        });
                    })->orderBy('creation_date', 'desc')->get();

                    break;
                case '#width':

                    $products = Product::where('width', '=', $searchQuery)
                        ->orderBy('creation_date', 'desc')->get();
                    break;

                case '#height':
                    $products = Product::where('height', '=', $searchQuery)
                        ->orderBy('creation_date', 'desc')->get();
                    break;
                case '#location':

                    $products = Product::whereHas('location', function ($query) use ($searchQuery) {
                        $query->whereHas('location_translation', function ($query) use ($searchQuery) {
                            $query->where('name', 'like', '%' . $searchQuery . '%');
                        });
                    })->orderBy('creation_date', 'desc')->get();
                    break;
                case '#tag':
                    $tagWords = explode(" ", $searchQuery);
                    $products = Product::whereHas('tags', function ($query) use ($tagWords) {
                        foreach ($tagWords as $tagWord) {
                            $query->whereHas('tag_translation', function ($query) use ($tagWord) {

                                $query->where(function ($query) use ($tagWord) {
                                    $query->where('name', '=', $tagWord);
                                });
                            });
                        }
                    })->orderBy('creation_date', 'desc')->get();
                    break;
                case '#description':

                    $descriptionWords = explode(" ", $searchQuery);

                    $products = Product::whereHas('product_translation', function ($query) use ($descriptionWords) {
                        foreach ($descriptionWords as $descriptionWord) {
                            $query->where('description', 'like', '%' . $descriptionWord . '%');
                        }
                    })->orderBy('creation_date', 'desc')->get();
                    break;
                case '#range':
                    $datesString = explode(" ", $searchQuery);
                    //Convertimos la fecha al formato de la base de datos
                    for ($i = 0; $i < count($datesString); $i++) {
                        $date[$i] = Carbon::createFromFormat('d-m-Y', $datesString[$i])->format('Y-m-d');
                    }

                    $products = Product::whereBetween('creation_date', [$date[0], $date[1]])
                        ->orderBy('creation_date', 'desc')->get();
                    break;

                default:
                    $products = Product::whereHas('product_translation', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })->orderBy('creation_date', 'desc')->get();
                    break;
            }
        } else {
            //Más recientes primeros
            $products = Product::orderBy('creation_date', 'desc')->get();
        }

        if ($products->count() == 0) {
            return view('portfolio', compact('products', 'tagNames', 'locationNames', 'colourNames','searchQuery'))->with('warning', __('No results found'));
        }else {

            return view('portfolio', compact('products', 'tagNames', 'locationNames', 'colourNames','searchQuery'));
        }

    }

    /**
     * Mostramos los detalles de cada producto
     */
    public function vistaDetalles($id = 1)
    {
        $product = Product::with('tags', 'product_translation', 'colours', 'location')->find($id);
        if ($product == null) {
            return redirect()->route('portfolio')->with('error', 'Product not found');
        }
        $productTr = Product_tr::where('product_id', $id)->where('language_code', app()->getLocale())->first();

        //Si no está lo ponemos en el idioma por defecto
        if ($productTr == null) {
            $productTr = Product_tr::where('product_id', $id)->where('language_code', config('app.default_locale'))->first();
        }

        $currentTime = Carbon::now();
        //Usamos la misma zona horaria que la base de datos
        $currentTime->setTimezone('UTC');

        $productDate = Carbon::parse($product->creation_date)->format('d/m/Y');

        return view('product-details', compact('product', 'productTr', 'currentTime', 'productDate'));
    }

    /**
     * Muestra la vista de los productos que están disponibles
     */
    public function vistaTienda()
    {

        $products = Product::where('stock', '>', 0)->orderBy('creation_date', 'desc')->paginate(8);

        $currentTime = Carbon::now();
        //Usamos la misma zona horaria que la base de datos
        $currentTime->setTimezone('UTC');
        return view('shop', compact('products', 'currentTime'));
    }

    public function requestPaintingView()
    {
        return view('request-painting');
    }

    /**
     * Vista de la página About Heden
     */
    public function aboutHeden()
    {
        return view('about-heden');
    }

    /**
     * Vista de exposiciones
     */
    public function exhibitions()
    {
        return view('exhibitions');
    }

    /**
     * Recogemos las obras que tienen como etiqueta la sección espeical
     */
    public function specialSection()
    {

        $products = Product::whereHas(
            'tags',
            function ($query) {
                $query->where('active', true);
            }
        )->get();

        return view('special', compact('products'));
    }

    //Aquí mostramos la vista de la política de privacidad
    public function privacyView($lang = "en")
    {

        switch ($lang) {
            case 'en':
                return view('privacy.privacy-en');
                break;

            default:
                return view('privacy.privacy-en');
                break;
        }
    }


    public function shippingPrivacyView($lang = "en")
    {
        return view('privacy.shipping-en');
    }

    public function cookiesView()
    {
        return view('privacy.cookies');
    }

    public function supportView()
    {
        return view('privacy.support');
    }
}
