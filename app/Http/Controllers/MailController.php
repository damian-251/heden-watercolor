<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Mail\RequestPaintingMail;
use App\Models\RequestPainting;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function requestEmailP(Request $request) {

        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'details' => 'required',
            'file' => 'required|mimes:jpeg,png,webp|max:900',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);

        

        //Ponemos la imagen en un directorio privado
        $path = $request->file->store('', 'paintingRequest');
        //Log::channel('custom')->debug("Path " . $path);


        //Recogemos los datos para que aparezcan en el correo electrónico
        $correo = new RequestPaintingMail;
        $correo->imagePath = $path;
        $correo->name = $request->name;
        $correo->email = $request->email;
        $correo->details = $request->details;
        $correo->phone = $request->phone;

        Mail::to(env('EMAIL_REQUEST'))->send($correo);

        DB::beginTransaction();
        //También añadimos los datos a la base de datos por si el correo se pierde
        $requestTable = new RequestPainting();
        $requestTable->name = $request->name;
        $requestTable->email = $request->email;
        $requestTable->description = $request->details;
        $requestTable->img_path = $path;
        $requestTable->save();
        DB::commit();
        return back()->with('message', 'The request has been submitted');
    }

    /**
     * Recibimos el formulario de contacto de la web
     */
    public function contactEmailP(Request $request) {

        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'mensaje' => 'required',
            'g-recaptcha-response' => ['required', new ReCaptcha],
        ]);

        Log::channel('custom')->debug("Petición formulario de contacto: " . $request);

        Log::channel('custom')->debug("Recaptcha response: " . $request['g-recaptcha-response']);


        $correo = new ContactMail;
        $correo->name = $request->name;
        $correo->email = $request->email;
        $correo->mensaje = $request->mensaje;

        Mail::to(env('EMAIL_REQUEST'))->send($correo);

        return back()->with('message', __('The contact form has been submitted'));
    }
}
