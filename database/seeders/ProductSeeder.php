<?php

namespace Database\Seeders;

use App\Models\Colour;
use App\Models\Location;
use App\Models\Product;
use App\Models\Product_tr;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $numberProducts = 30;

        for ($i = 0 ; $i < $numberProducts ; $i++) {

            $faker = Factory::create();
            $product = new Product();
            $product->price_eur = $faker->randomFloat(15, 0, 70);
            $product->price_nok = $faker->randomFloat(15, 0, 70);
            $product->available = true;
            $product->creation_date = $faker->dateTimeThisDecade(); //Fecha de creación de la acuarela
            $product->img_path_jpg = "test";
            $product->img_path_webp = "test";
            $product->save();
    
            //Añadimos la imagen del producto
            $image_name = $product->id . "-watercolor.jpg";
            $path = public_path() . '/assets/images';
            $image = $faker->image($path, 500, 500, 'watercolor');
            rename($image, public_path() . '/assets/images/' . $image_name);
            $product->img_path_jpg = 'assets/images/' . $image_name;
            $product->img_path_webp = 'assets/images/' . $image_name;
            $product->save();

            //Añadimos etiquetas
            $product->tags(Tag::inRandomOrder()->limit(5)->get());

            //Añadimos la localización
            $product->location_id = Location::inRandomOrder()->limit(1)->get();

            //Añadimos los colores
            $product->colours(Colour::inRandomOrder()->limit(5)->get());
    
            //Tenemos que añadir la traducción
            $translationEn = new Product_tr(); //Tabla de la traducción
            $translationEn->product_id = $product->id;
            $translationEn->language_code = "en";
            $translationEn->name = $faker->sentence();
            $translationEn->description = $faker->sentence();
            $translationEn->save();
    
            $translationEs = new Product_tr(); //Tabla de la traducción
            $translationEs->product_id = $product->id;
            $translationEs->language_code = "es";
            $translationEs->name = $faker->sentence();
            $translationEs->description = $faker->sentence();
            $translationEs->save();
    
            $translationNo = new Product_tr(); //Tabla de la traducción
            $translationNo->product_id = $product->id;
            $translationNo->language_code = "no";
            $translationNo->name = $faker->sentence();
            $translationNo->description = $faker->sentence();
            $translationNo->save();
        }

    }
}
