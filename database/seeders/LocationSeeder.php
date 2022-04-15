<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Location_tr;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class LocationSeeder extends Seeder
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
            $location = new Location();
            $location->save();
            
            //Traducción inglés
            $faker = Factory::create();
            $en = new Location_tr();
            $en->language_code = "en";
            $en->location_id = $location->id;
            $en->name = $faker->country();
            $en->save();
            //Traducción español
            $faker = Factory::create('es_ES');
            $es = new Location_tr();
            $es->language_code = "es";
            $es->location_id = $location->id;
            $es->name = $faker->country();
            $es->save();
    
            //Traducción noruego
            $faker = Factory::create('nb_NO');
            $no = new Location_tr();
            $no->language_code = "no";
            $no->location_id = $location->id;
            $no->name = $faker->country();
            $no->save();
        }



    }
}
