<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Localizaciones de las pinturas en los idiomas que se desee
     * @return void
     */
    public function up()
    {
        Schema::create('location_trs', function (Blueprint $table) {
            $table->id();
            $table->string('language_code');
            $table->string('name');
            $table->bigInteger('location_id');
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
        Schema::dropIfExists('location_tr');
    }
};
