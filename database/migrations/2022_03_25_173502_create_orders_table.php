<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->float('subtotal_price');
            $table->float('shipping_price');
            $table->bigInteger('payment_id'); //Datos que genera al finalizar el pago en la api de Stripe
            //Ahí tendremos el precio total, la divisa y otros datos
            $table->boolean('sent')->default(false); //Indica si el pedido está enviado, el admin lo cambiará cuando lo envíe
            $table->bigInteger('address_id'); //fk tabla address
            $table->bigInteger('address_f_id'); //Dirección de facturación
            $table->float('taxes')->nullable(); //Guardamos los impuestos en la orden por si se cambian en el futuro
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
