<?php

namespace App\Http\Controllers;

use App\Exceptions\CreateProductException;
use App\Models\Colour;
use App\Models\Colour_tr;
use App\Models\Location;
use App\Models\Location_tr;
use App\Models\Product;
use App\Models\Product_tr;
use App\Models\Tag;
use App\Models\Tag_tr;
use Faker\Core\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Psr\Http\Message\RequestInterface;

class AdminController extends Controller {

    public function __construct() {
        $this->middleware('admin'); // Controlador solo para los administradores del sitio
    }

    public function index() {
        return view('admin.control-panel');
    }

    public function createTag() {
        return view('admin.create-tag');
    }

    /**
     * Está función recibirá los datos del formulario de nueva etiqueta y la 
     * insertará en la base de datos
     */
    public function createTagP(Request $request) {

        //Solo será obligatoria la etiqueta en inglés, que es el idioma por defecto.
        $validated = $request->validate([
            'tag_en' => 'required'
        ]);

        $tag = new Tag(); //Generamos una nueva etiqueta para obtener su id
        //Comprobamos si es una etiqueta especial (para luego poder aplicarse en la sección temporal)
        if($request->isSpecial == 'true') {
            $tag->isSpecial = true;
            Log::channel('custom')->debug('La etiqueta tiene un valor isSpecial de ' . $tag->isSpecial);
        }
        $tag->save();

        $tagId = $tag->id;

        $tagEn = new Tag_tr();
        $tagEn->language_code = "en";
        $tagEn->tag_id = $tagId;
        $tagEn->name = $request->tag_en;
        $tagEn->save();

        Log::channel('custom')->debug('Etiqueta en inglés creada ' . $tagEn->name);

        //Las etiquetas en otros idiomas serán opcionales
        if (isset($request->tag_es)) {
            $tagEs = new Tag_tr();
            $tagEs->language_code = "es";
            $tagEs->tag_id = $tagId;
            $tagEs->name = $request->tag_es;
            $tagEs->save();
            Log::channel('custom')->debug('Etiqueta en castellno creada');
        }

        if (isset($request->tag_no)) {
            $tagNo = new Tag_tr();
            $tagNo->language_code = "no";
            $tagNo->tag_id = $tagId;
            $tagNo->name = $request->tag_no;
            $tagNo->save();
            Log::channel('custom')->debug('Etiqueta en noruego creada');
        }

        //Log::channel('custom')->debug('Request' . $request);

        return back()->with('message', 'Tag added!');
    }


    /**
     * Recuperará el nombre de las etiquetas de la base de datos para poder seleccionarlas 
     * y editarlas
     */
    public function editTag() {

        $tags = Tag::all();
        
        return view('admin.edit-tag', compact('tags'));

    }

    public function editTagP(Request $request) {
        //El valor en inglés es obligatorio. El id es obligatorio
        $validated = $request->validate([
            'tag_en' => 'required',
            'tag_id' => 'required'
        ]);

        Log::channel('custom')->debug($request->tag_en . " " . $request->tag_no . " " . $request->tag_es);
        //Recuperamos los valores de la tabla de la traducción
        $tagEn = Tag_tr::where('tag_id', $request->tag_id)->where('language_code', 'en');
        //$tagEn->update('name', $request->tag_en);
        //$tagEn->name = $request->tag_en;
        //$tagEn->save();
        $tagEn->update([
            'name' => $request->tag_en
        ]);


        if(isset($request->tag_es)) {
            Log::channel('custom')->debug("Hay etiqueta en castellano");
            $tagEs = Tag_tr::where('tag_id', $request->tag_id)->where('language_code', 'es');
            //$tagEs->update('name', $request->tag_es);
            //$tagEs->name = $request->tag_es;
            //$tagEs->save();

            $tagEs->update([
                'name' => $request->tag_es
            ]);

        }

        if(isset($request->tag_no)) {
            Log::channel('custom')->debug("Hay etiqueta en noruego");
            $tagNo = Tag_tr::where('tag_id', $request->tag_id)->where('language_code', 'no');
            //$tagNo->update('name', $request->tag_no);
            //$tagNo->name = $request->tag_no;
            //$tagNo->save();

            $tagNo->update([
                'name' => $request->tag_no
            ]);
        }
       
        return back()->with('message', 'Tag ' . $request->tag_en . ' updated!');

    }

    /**
     * Carga la página con el formulario para la creación de un nuevo color
     */
    public function createColour() {
        return view('admin.create-colour');
    }

    /**
     * Inserta el nuevo color en la tabla de color y sus traducciones
     */
    public function createColourP(Request $request) {
        
        //Obligatorio el color en inglés
        $validated = $request->validate([
            'colour_en' => 'required'
        ]);

        DB::beginTransaction();

        $colour = new Colour(); //Generamos una nueva etiqueta para obtener su id
        //Comprobamos si es una etiqueta especial (para luego poder aplicarse en la sección temporal)
        $colour->save();

        $colourId = $colour->id;

        $colourEn = new Colour_tr();
        $colourEn->language_code = "en";
        $colourEn->colour_id = $colourId;
        $colourEn->name = $request->colour_en;
        $colourEn->save();

        //Los colores en otros idiomas serán opcionales
        if (isset($request->colour_es)) {
            $colourEn = new Colour_tr();
            $colourEn->language_code = "es";
            $colourEn->colour_id = $colourId;
            $colourEn->name = $request->colour_es;
            $colourEn->save();
        }

        if (isset($request->colour_no)) {
            $colourNo = new Colour_tr();
            $colourNo->language_code = "no";
            $colourNo->colour_id = $colourId;
            $colourNo->name = $request->colour_no;
            $colourNo->save();
        }

        DB::commit();

        return back()->with('message', 'Colour ' . $request->colour_en . " added!");

    }

    public function editColour() {
        $colours = Colour::all();
        return view('admin.edit-colour', compact('colours'));
    }

    public function editColourP(Request $request) {
        //El valor en inglés es obligatorio. El id es obligatorio
        $validated = $request->validate([
            'colour_en' => 'required',
            'colour_id' => 'required'
        ]);

        //Recuperamos los valores de la tabla de la traducción
        $colourEn = Colour_tr::where('colour_id', $request->colour_id)->where('language_code', 'en');
        $colourEn->update([
            'name' => $request->colour_en
        ]);


        if(isset($request->colour_es)) {

            $colourEs = Colour_tr::where('colour_id', $request->colour_id)->where('language_code', 'es');
            $colourEs->update([
                'name' => $request->colour_es
            ]);
        }

        if(isset($request->colour_no)) {
            $tagNo = Colour_tr::where('colour_id', $request->colour_id)->where('language_code', 'no');
            $tagNo->update([
                'name' => $request->colour_no
            ]);
        }
        
        return back()->with('message', 'Colour ' . $request->colour_en . ' updated!');

    }

    public function createProduct(){
        //Para crear el producto necesitamos recuperar la lista de  nombres colores, de localizaciones y de etiquetas

        $colours = Colour::all();
        $locations = Location::all();
        $tags = Tag::where('isSpecial', false)->get();
        $specialTags = Tag::where('isSpecial', true)->get();
        return view('admin.create-product', compact('colours', 'locations', 'tags', 'specialTags'));
    }

    public function createProductP(Request $request) {

        $validated = $request->validate([
            'title_en' => 'required',
            'description_en' => 'required',
            'width' => 'required',
            'height' => 'required',
            'stock' => 'required',
            'image_jpg' => 'required|mimes:jpeg|max:200',
            'image_webp' => 'mimes:webp|max:100'
        ]);

        DB::beginTransaction();

        //Creamos el nuevo producto
        $product = new Product();
        $product->sku = Str::random(10);
        //Primero agregamos los datos propios de la tabla producto.

        // ---- PRECIO ----

        if (isset($request->price_nok) && isset($request->price_eur)) {

            if (isset($request->price_nok) && $request->price_nok > 0) {
                $product->price_nok = $request->price_nok;
                $product->stock = $request->stock;
            }else {
                //Si no tiene precio o es 0 significa que no está a la venta
                $product->stock = 0;
            }
    
            if (isset($request->price_eur) && $request->price_eur > 0) {
                $product->price_eur = $request->price_eur;
                //Indicamos el stock
                $product->stock = $request->stock;
            }else {
                //Si no tiene precio o es 0 significa que no está a la venta
                $product->stock = 0;
            }
        }else {
            throw new CreateProductException('You have to specify both eur and nok');
        }


        // ---- Fecha de creación ---- 

        $product->creation_date = $request->creation_date;

        // ---- Localización de la obra ---- 

        if (isset($request->location) && $request->location != "no_location") {
            $product->location()->associate(Location::findOrFail($request->location));
        }
        //Si no se cumple se deja el valor por defecto que es nulo



        //Altura y anchura

        $product->height = $request->height;
        $product->width = $request->width;
        

        // --- IMÁGENES DEL PRODUCTO ----

        $nombre = Str::random(20);

        //jpg
        $image_jpg_name = $nombre . "_jpg.jpg";
        $path = base_path() . '/public/assets/images/jpg';
        $request->file('image_jpg')->move($path,$image_jpg_name);  
        $product->img_path_jpg = 'assets/images/jpg/' .$image_jpg_name;
        Log::channel('custom')->debug("Imagen jpg");

        //webp
        if (isset($request->image_webp)) {
            $image_webp_name = $nombre . "_webp.webp";
            $path = base_path() . '/public/assets/images/webp';
            $request->file('image_webp')->move($path,$image_webp_name);  
            $product->img_path_webp = 'assets/images/webp/' .$image_webp_name;
            Log::channel('custom')->debug("Imagen webp");
        }

        //Guardamos para que se genera la id para poder añadir las etiquetas y lo colores
        $product->save();


        //Etiquetas
        $product->tags()->attach($request->tags);

        //Colores
        $product->colours()->attach($request->tags);

        

        //Ahora rellenamos los datos correspondientes en la tabla de traducciones

        //Traducción al inglés
        $product_en = new Product_tr();
        $product_en->language_code = "en";
        $product_en->name = $request->title_en;
        $product_en->description = $request->description_en;
        $product_en->product_id = $product->id;
        $product_en->save();

        //Traducción al Español

        if (isset($request->title_es)) {
            $product_es = new Product_tr();
            $product_es->language_code = "es";
            $product_es->name = $request->title_es;
            $product_es->description = $request->description_es;
            $product_es->product_id = $product->id;
            $product_es->save();
        }

        //Traducción al noruego

        if (isset($request->title_no)) {
            $product_no = new Product_tr();
            $product_no->language_code = "no";
            $product_no->name = $request->title_no;
            $product_no->description = $request->description_no;
            $product_no->product_id = $product->id;
            $product_no->save();
        }

        DB::commit();

        return back()->with('message', 'Product created!');
    }


    //Edición de productos

    /**
     * Función que editar un producto seleccionado
     */
    public function editProduct($id) {
        //Producto que queremos editar
        $product = Product::findOrFail($id);
        $productEn = Product_tr::where('product_id', $id)->where('language_code', 'en')->first();
        $productEs = Product_tr::where('product_id', $id)->where('language_code', 'es')->first();
        $productNo = Product_tr::where('product_id', $id)->where('language_code', 'no')->first();
        // Log::channel('custom')->debug("Producto tr");
        // Log::channel('custom')->debug($productEn);
        $colours = Colour::all();
        $tags = Tag::where('isSpecial', false)->get();
        $specialTags = Tag::where('isSpecial', true)->get();
        $locations = Location::all();
        //TODO: Completar función 
        return view('admin.edit-product', compact('product', 'productEn', 'productEs', 
        'productNo', 'colours','tags','locations', 'specialTags'));
    }

    /**
     * Muestra una lista de productos con acciones de editar y borrar
     */
    public function productList() {

        $products = Product::all();

        return view('admin.product-list', compact('products'));

    }

    /**
     * Proceso de edición de producto, recibimos los datos procedentes
     * del formulario de edición
     */
    public function  editProductP(Request $request) {
        $validated = $request->validate([
            'title_en' => 'required',
            'description_en' => 'required',
            'width' => 'required',
            'height' => 'required',
        ]);

        $product = Product::findOrFail($request->id);
        //Primero agregamos los datos propios de la tabla producto.

        //Iniciamos la transacción para que si algo falla en el proceso no se realice la edición
        DB::beginTransaction();

        // ---- PRECIO ----

        if (isset($request->price_nok) && isset($request->price_eur)) {

            if (isset($request->price_nok) && $request->price_nok > 0) {
                $product->price_nok = $request->price_nok;
                $product->available = true;
            }else {
                //Si no tiene precio o es 0 significa que no está a la venta
                $product->available = false;
            }
    
            if (isset($request->price_eur) && $request->price_eur > 0) {
                $product->price_eur = $request->price_eur;
                $product->available = true;
            }else {
                //Si no tiene precio o es 0 significa que no está a la venta
                $product->available = false;
            }
        }else {
            throw new CreateProductException('You have to specify both eur and nok');
        }


        // ---- Fecha de creación ---- 

        $product->creation_date = $request->creation_date;

        // ---- Localización de la obra ---- 

        if (isset($request->location) && $request->location != "no_location") {
            $product->location()->associate(Location::findOrFail($request->location));
        }
        //Si no se cumple se deja el valor por defecto que es nulo



        //Altura y anchura

        $product->height = $request->height;
        $product->width = $request->width;
        

        // --- IMÁGENES DEL PRODUCTO ----

        $nombre = Str::random(20);

        if(isset($request->image_jpg)) {

            //jpg
            $image_jpg_name = $nombre . "_jpg.jpg";
            $path = base_path() . '/public/assets/images/jpg';
            $request->file('image_jpg')->move($path,$image_jpg_name);  
            $product->img_path_jpg = 'assets/images/jpg/' .$image_jpg_name;
            Log::channel('custom')->debug("Imagen jpg");
        }

        if (isset($request->image_webp)) {
            $image_webp_name = $nombre . "_webp.webp";
            $path = base_path() . '/public/assets/images/webp';
            $request->file('image_webp')->move($path,$image_webp_name);  
            $product->img_path_webp = 'assets/images/webp/' .$image_webp_name;
            Log::channel('custom')->debug("Imagen webp");
        }
  


        //Ahora rellenamos los datos correspondientes en la tabla de traducciones

        //Traducción al inglés

        $product_en = Product_tr::where('product_id', $product->id)->where('language_code', 'en')->first();
        $product_en->name = $request->title_en;
        $product_en->description = $request->description_en;
        $product_en->save();

        //Traducción al Español

        if (isset($request->title_es)) {
            $product_es = Product_tr::where('product_id', $product->id)->where('language_code', 'es')->first();

            if (!$product_es) { //Si la query no devuelve nada se crea
                $product_es = new Product_tr();
                $product_es->language_code = "es";
                $product_es->product_id = $product->id;
            }

            $product_es->name = $request->title_es;
            $product_es->description = $request->description_es;
            $product_es->save();
        }

        //Traducción al noruego

        if (isset($request->title_no)) {

            $product_no = Product_tr::where('product_id', $product->id)->where('language_code', 'no')->first();

            if (!$product_no) { //Si la query no devuelve nada se crea
                $product_no = new Product_tr();
                $product_no->language_code = "no";
                $product_no->product_id = $product->id;
            }
            $product_no->name = $request->title_no;
            $product_no->description = $request->description_no;
            $product_no->save();
        }

        //Etiquetas
        $product->tags()->detach();
        $product->tags()->attach($request->tags);

        //Colores
        $product->colours()->detach();
        $product->colours()->attach($request->tags);

        $product->save();

        //Guardamos los cambios
        DB::commit();

        return back()->with('message', 'Product updated!');

    }

    /**
     * Función que elimina un producto pasándole el id del mismo
     */
    public function deleteProduct($id) {
        $product = Product::findOrFail($id);
        $product->delete(); //Hemos configurado softdelete
        //TODO: Faltaría borrar/modificar las asociaciones que tuviese es producto
        return back()->with('message', 'Product deleted!');
    }


        /**
     * Carga la página con el formulario para la creación de una nueva localización
     */
    public function createLocation() {
        return view('admin.create-location');
    }

    /**
     * Inserta la nueva localización en la tabla de color y sus traducciones
     */
    public function createLocationP(Request $request) {
        
        $validated = $request->validate([
            'location_en' => 'required'
        ]);

        DB::beginTransaction();

        $location = new Location(); //Generamos una nueva etiqueta para obtener su id
        $location->save();

        $locationId = $location->id;

        $locationEn = new Location_tr();
        $locationEn->language_code = "en";
        $locationEn->location_id = $locationId;
        $locationEn->name = $request->location_en;
        $locationEn->save();

        if (isset($request->location_es)) {
            $locationEn = new Location_tr();
            $locationEn->language_code = "es";
            $locationEn->location_id = $locationId;
            $locationEn->name = $request->location_es;
            $locationEn->save();
        }

        if (isset($request->location_no)) {
            $locationNo = new Location_tr();
            $locationNo->language_code = "no";
            $locationNo->location_id = $locationId;
            $locationNo->name = $request->location_no;
            $locationNo->save();
        }

        DB::commit();

        return back()->with('message', 'Location ' . $request->location_en . " added!");

    }

    public function editLocation() {
        $locations = Location::all();
        return view('admin.edit-location', compact('locations'));
    }

    public function editLocationP(Request $request) {
        //El valor en inglés es obligatorio. El id es obligatorio
        $validated = $request->validate([
            'location_en' => 'required',
            'location_id' => 'required'
        ]);

        //Recuperamos los valores de la tabla de la traducción
        $locationEn = Location_tr::where('location_id', $request->location_id)->where('language_code', 'en');
        $locationEn->update([
            'name' => $request->location_en
        ]);


        if(isset($request->location_es)) {

            $locationEs = Location_tr::where('location_id', $request->location_id)->where('language_code', 'es');
            $locationEs->update([
                'name' => $request->location_es
            ]);
        }

        if(isset($request->location_no)) {
            $locationNo = Location_tr::where('location_id', $request->location_id)->where('language_code', 'no');
            $locationNo->update([
                'name' => $request->location_no
            ]);
        }
        
        return back()->with('message', 'Location ' . $request->colour_en . ' updated!');

    }

    public function modifySpecial() {

        //Cargamos las etiquetas que sean especiales
        $specialTags = Tag::where('isSpecial', true)->with(['tag_translation' => function ($query) {
            $query->where('language_code', app()->getLocale())->first();
            //Si no obtenemos resultado usamos el idioma por defecto
        }])->first();

        if ($specialTags == null) {
            $specialTags = Tag::where('isSpecial', true)->with(['tag_translation' => function ($query) {
                $query->where('language_code', config('app.default_locale'))->first();
                //Si no obtenemos resultado usamos el idioma por defecto
            }])->first();
        }
        
        return view('admin.modify-special', compact('specialTags'));
    }
    

    /**
     * Modificamos la sección especial
     */
    public function modifySpecialP(Request $request) {

        //Pasamos al archivo de configuración la nueva etiqueta
        DB::beginTransaction();
        //Primero borramos si hubiese alguna con el valor activo a 1
        Tag::all()->update(['active' => false]);
        $newSpecial = Tag::find($request->specialTag);
        $newSpecial->active = true;
        $newSpecial->save();
        DB::commit();

        return back()->with('message', 'Temporary section changed');


    }
    
}
