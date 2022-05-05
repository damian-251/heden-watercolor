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
            'name' => 'required',
            'details' => 'required',
            'file' => 'required|mimes:jpeg,png,webp|max:900',
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
    
        return back()->with('message', 'The request has been submitted');
    }
}
