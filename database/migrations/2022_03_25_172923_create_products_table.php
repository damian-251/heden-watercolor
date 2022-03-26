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
            $table->float('price')->nullable(); //Si no está a la venta no tendrá precio
            $table->boolean('sold'); //Los que no estén a la venta también se marcarán como vendidos
            $table->date('creation_date'); //Fecha en la que se pintó la obra
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->string('img_path'); //Ruta de la imagen
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
        Schema::dropIfExists('products');
    }
};
