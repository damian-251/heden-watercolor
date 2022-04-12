<?php

namespace App\Http\Controllers;

use App\Models\Colour;
use App\Models\Colour_tr;
use App\Models\Tag;
use App\Models\Tag_tr;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    
}
