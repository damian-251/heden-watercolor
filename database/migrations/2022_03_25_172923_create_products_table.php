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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->float('price_eur')->nullable(); //Precio en euros
            $table->integer('price_nok')->nullable(); //Precio en coronas noruegas, no tiene decimales
            $table->boolean('available')->default(false); //Indica si está a la venta o no
            $table->date('creation_date'); //Fecha en la que se pintó la obra
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->string('img_path_jpg'); //Ruta de la imagen en jpg. Obligatorio por mayor compatibilidad que webp
            $table->string('img_path_webp')->nullable(); //Ruta de la imagen en webp (formato prioritario para la carga)
            $table->bigInteger('location_id')->nullable(); //Id de la tabla de localización (en qué lugar se encuentra la obra ambientada)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
