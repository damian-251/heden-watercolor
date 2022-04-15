<?php

namespace Database\Seeders;

use App\Models\Colour;
use App\Models\Colour_tr;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numeroElementos = 8;

        for ($i=0; $i < $numeroElementos ; $i++) { 
            //Es solo para poner otros países, la traducción no estaría bien
            //Generamos la localización para guardar el id
            $colour = new Colour();
            $colour->save();
            
            //Traducción inglés
            $faker = Factory::create();
            $en = new Colour_tr();
            $en->language_code = "en";
            $en->colour_id = $colour->id;
            $en->name = $faker->word();
            $en->save();

            //Traducción español
            $faker = Factory::create();
            $es = new Colour_tr();
            $es->language_code = "es";
            $es->colour_id = $colour->id;
            $es->name = $faker->word();
            $es->save();
    
            //Traducción noruego
            $faker = Factory::create();
            $no = new Colour_tr();
            $no->language_code = "no";
            $no->colour_id = $colour->id;
            $no->name = $faker->word();
            $no->save();
        }
    }
}
