<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestPaintingMail extends Mailable
{
    use Queueable, SerializesModels;

    //Datos del formulario
    public $subject;
    public $email;
    public $details;
    public $imagePath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $path = storage_path('app/paint-request/');
        $path .= $this->imagePath;
        return $this->view('email.request-painting')->attach($path);
    }
}
