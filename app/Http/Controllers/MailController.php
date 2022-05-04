<?php

namespace App\Http\Controllers;

use App\Mail\RequestPaintingMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    public function requestEmailP(Request $request) {

        $request->validate([
            'email' => 'required',
            'details' => 'required',
            'file' => 'required|max:900',
        ]);

        

        //Ponemos la imagen en un directorio privado
        $path = $request->file->store('', 'paintingRequest');
        Log::channel('custom')->debug("Path " . $path);


        $correo = new RequestPaintingMail;
        $correo->subject = "Hola chavaless, a toda mecha";
        $correo->imagePath = $path;
        $correo->details = $request->details;

        Mail::to('halogeno@outlook.es')->send($correo);
    
        return back()->with('message', 'The request has been submitted');
    }
}
