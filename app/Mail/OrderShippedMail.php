<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShippedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $address; //Dirección del pedido
    public $country; //País de envio
    public $comment; //Comentarios que ha puesto el administrador

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject = __('Shipping confirmation - Heden Watercolor');
        return $this->view('email.shipped');
    }
}
