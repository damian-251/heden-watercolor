<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Tag_tr;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
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
            $tag = new Tag();
            $tag->save();
            
            //Traducción inglés
            $faker = Factory::create();
            $en = new Tag_tr();
            $en->language_code = "en";
            $en->tag_id = $tag->id;
            $en->name = $faker->word();
            $en->save();

            //Traducción español
            $faker = Factory::create('es_ES');
            $es = new Tag_tr();
            $es->language_code = "es";
            $es->tag_id = $tag->id;
            $es->name = $faker->word();
            $es->save();
    
            //Traducción noruego
            $faker = Factory::create('nb_NO');
            $no = new Tag_tr();
            $no->language_code = "no";
            $no->tag_id = $tag->id;
            $no->name = $faker->word();
            $no->save();
        }
    }
}
