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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('line1');
            $table->string('line2')->nullable(); //Línea 2 opcional
            $table->string('postal_code');
            $table->string('city');
            $table->string('country');
            $table->bigInteger('user_id')->nullable(); //Fk
            $table->string('session_id')->nullable(); //Por si un usuario hace la compra sin cuenta
            $table->string('full_name');
            $table->string('email')->nullable(); //Para poder conectar con los visitantes que han realizado pedido
            $table->string('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
