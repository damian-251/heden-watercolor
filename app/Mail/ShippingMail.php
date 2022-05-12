<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShippingMail extends Mailable
{

    use Queueable, SerializesModels;

    public $products; //Productos del pedido
    public $address; //Dirección del pedido
    public $country; //País de envio
    public $currency; //Divisa empleada
    public $shipping_price; //Gastos de envío
    public $totalPrice; //Precio total

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
        $this->subject = __('Order confirmation in Heden Watercolor');
        return $this->view('email.shipping');
    }
}
